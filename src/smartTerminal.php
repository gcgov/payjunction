<?php

namespace gcgov\payjunction;


use andrewsauder\jsonDeserialize\exceptions\jsonDeserializeException;
use gcgov\payjunction\exceptions\configException;
use gcgov\payjunction\exceptions\payjunctionException;
use gcgov\payjunction\smartTerminal\params;
use gcgov\payjunction\smartTerminal\responses;


class smartTerminal
	extends
	core\api {

	/**
	 * @param  \gcgov\payjunction\config  $config
	 *
	 * @throws \gcgov\payjunction\exceptions\configException
	 */
	public function __construct( \gcgov\payjunction\config $config ) {
		parent::__construct( $config );

		if( $this->config->getTerminalId() == '' && $this->config->getMerchantId() == '' ) {
			throw new configException( 'Terminal and merchant ids are required in the PayJunction config to use the smart terminals module', 400 );
		}
		else {
			if( $this->config->getTerminalId() == '' ) {
				throw new configException( 'Terminal id is required in the PayJunction config to use the smart terminals module', 400 );
			}
			else {
				if( $this->config->getMerchantId() == '' ) {
					throw new configException( 'Merchant id is required in the PayJunction config to use the smart terminals module', 400 );
				}
			}
		}
	}


	/**
	 * @return bool
	 *
	 * @throws \gcgov\payjunction\exceptions\connectException
	 * @throws \gcgov\payjunction\exceptions\payjunctionException
	 */
	public function reset() : bool {
		$guzzleResponse = $this->call( '/smartterminals/' . $this->config->getTerminalId() . '/main', 'POST' );

		return true;
	}


	/**
	 * @param  string  $terms
	 *
	 * @return \gcgov\payjunction\smartTerminal\responses\requestSignature
	 * @throws \gcgov\payjunction\exceptions\connectException
	 * @throws \gcgov\payjunction\exceptions\payjunctionException
	 */
	public function requestSignature( string $terms ) : responses\requestSignature {
		$options = [
			'form_params' => [
				'terminalId' => $this->config->getMerchantId(),
				'terms'      => $terms
			]
		];

		$guzzleResponse = $this->call( '/smartterminals/' . $this->config->getTerminalId() . '/request-signature', 'POST', $options );

		try {
			return responses\requestSignature::jsonDeserialize( $guzzleResponse->getBody()->getContents() );
		}
		catch( jsonDeserializeException $e ) {
			throw new payjunctionException( $e->getMessage(), $e->getCode(), $e );
		}
	}


	/**
	 * @param  string  $text
	 * @param  string[]   $buttons
	 *
	 * @return \gcgov\payjunction\smartTerminal\responses\requestPrompt
	 */
	public function requestPrompt( string $text, array $buttons ) : responses\requestPrompt {
		$options = [
			'body' => 'terminalId='.$this->config->getMerchantId().'&text='.htmlspecialchars($text)
		];
		foreach($buttons as $button) {
			$options['body'] .= '&buttons[]='.$button;
		}

		$guzzleResponse = $this->call( '/smartterminals/' . $this->config->getTerminalId() . '/request-prompt', 'POST', $options );

		try {
			return responses\requestPrompt::jsonDeserialize( $guzzleResponse->getBody()->getContents() );
		}
		catch( jsonDeserializeException $e ) {
			throw new payjunctionException( $e->getMessage(), $e->getCode(), $e );
		}
	}


	/**
	 * @param  float                                                        $amountBase
	 * @param  \gcgov\payjunction\smartTerminal\params\requestPayment|null  $params Optional params
	 *
	 * @return \gcgov\payjunction\smartTerminal\responses\requestPayment
	 */
	public function requestPayment( float $amountBase, ?params\requestPayment $params=null ) : responses\requestPayment {
		$options = [
			'form_params' => [
				'terminalId' => $this->config->getMerchantId(),
				'amountBase' => $amountBase
			]
		];

		//add optional params
		$paramsArray = $params->toArray();
		if(count($paramsArray)>0) {
			$options['form_params'] = array_merge( $options['form_params'], $paramsArray );
		}

		$guzzleResponse = $this->call( '/smartterminals/' . $this->config->getTerminalId() . '/request-payment', 'POST', $options );

		try {
			return responses\requestPayment::jsonDeserialize( $guzzleResponse->getBody()->getContents() );
		}
		catch( jsonDeserializeException $e ) {
			throw new payjunctionException( $e->getMessage(), $e->getCode(), $e );
		}
	}


	/**
	 * @param  string  $requestId
	 *
	 * @return \gcgov\payjunction\smartTerminal\responses\status
	 *
	 * @throws \gcgov\payjunction\exceptions\connectException
	 * @throws \gcgov\payjunction\exceptions\payjunctionException
	 */
	public function status( string $requestId ) : responses\status {
		$guzzleResponse = $this->call( '/smartterminals/requests/' . $requestId );

		try {
			return responses\status::jsonDeserialize( $guzzleResponse->getBody()->getContents() );
		}
		catch( jsonDeserializeException $e ) {
			throw new payjunctionException( $e->getMessage(), $e->getCode(), $e );
		}
	}


	/**
	 * @param  string  $signatureId
	 *
	 * @return string Base 64 encoded data URI of image
	 *
	 * @throws \gcgov\payjunction\exceptions\connectException
	 * @throws \gcgov\payjunction\exceptions\payjunctionException
	 */
	public function signatureImage( string $signatureId ) : string {
		$guzzleResponse = $this->call( '/smartterminals/signatures/' . $signatureId . '/image' );

		$rawImageData = $guzzleResponse->getBody()->getContents();

		return 'data:image/png;base64,' . base64_encode( $rawImageData );
	}

}