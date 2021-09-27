<?php
namespace gcgov\payjunction\core;


use gcgov\payjunction\exceptions\connectException;
use gcgov\payjunction\exceptions\payjunctionException;
use JetBrains\PhpStorm\Pure;


class api {

	protected \gcgov\payjunction\config $config;

	private string                      $url = 'https://api.payjunction.com';


	#[Pure]
	public function __construct( \gcgov\payjunction\config $config ) {
		$this->config = $config;

		if( $this->config->isDevelopment() ) {
			$this->url = 'https://api.payjunctionlabs.com';
		}
	}


	/**
	 * @throws \gcgov\payjunction\exceptions\connectException
	 * @throws \gcgov\payjunction\exceptions\payjunctionException
	 */
	protected function call( string $urlPath, $method='GET', $options = [] ) : \Psr\Http\Message\ResponseInterface {
		$client = new \GuzzleHttp\Client( [ 'timeout' => 5 ] );

		$url = rtrim( $this->url, '/' ) . '/' . ltrim( $urlPath, '/' );

		//add required basic auth
		$options[ 'auth' ] = [
			$this->config->getUsername(),
			$this->config->getPassword()
		];

		//add application key to headers
		//generate headers if none provided
		if( !isset( $options[ 'headers' ] ) ) {
			$options[ 'headers' ] = [];
		}
		$options[ 'headers' ][ 'X-PJ-Application-Key' ] = $this->config->getApiKey();

		try {
			return $client->request( $method, $url, $options );
		}
		catch( \GuzzleHttp\Exception\ConnectException $e ) {
			throw new connectException( 'There was a problem connecting to the gateway.', $e->getCode(), $e );
		}
		catch( \GuzzleHttp\Exception\RequestException $e ) {
			if( $e->hasResponse() ) {
				$responseJson = json_decode( $e->getResponse()->getBody() );
				if( isset( $responseJson->errors ) && count( $responseJson->errors ) > 0 ) {
					$exception = new payjunctionException( $responseJson->errors[ 0 ]->message, $e->getCode(), $e );
					foreach( $responseJson->errors as $error ) {
						$exception->addError( $error->message, $error->parameter, $error->type );
					}
					throw $exception;
				}
			}
			throw new payjunctionException( $e->getMessage(), $e->getCode(), $e );
		}
		catch( \GuzzleHttp\Exception\GuzzleException $e ) {
			throw new payjunctionException( $e->getMessage(), $e->getCode(), $e );
		}
	}

}