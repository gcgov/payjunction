<?php

namespace gcgov\payjunction;


use gcgov\jsonDeserialize\exceptions\jsonDeserializeException;
use gcgov\payjunction\exceptions\configException;
use gcgov\payjunction\exceptions\payjunctionException;
use gcgov\payjunction\responses\smartTerminal\requestPayment;
use gcgov\payjunction\responses\smartTerminal\requestSignature;
use gcgov\payjunction\responses\smartTerminal\status;


class smartTerminal
	extends
	core\api {

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


	public function reset() : bool {
		$guzzleResponse = $this->call( '/smartterminals/' . $this->config->getTerminalId() . '/main', 'POST' );

		return true;
	}


	public function requestSignature( string $terms ) : requestSignature {
		$options = [
			'form_params' => [
				'terminalId' => $this->config->getMerchantId(),
				'terms'      => $terms
			]
		];

		$guzzleResponse = $this->call( '/smartterminals/' . $this->config->getTerminalId() . '/request-signature', 'POST', $options );

		try {
			return requestSignature::jsonDeserialize( $guzzleResponse->getBody()->getContents() );
		}
		catch( jsonDeserializeException $e ) {
			throw new payjunctionException( $e->getMessage(), $e->getCode(), $e );
		}
	}


	public function requestPayment( float $amountBase ) : requestPayment {
		$options = [
			'form_params' => [
				'terminalId' => $this->config->getMerchantId(),
				'amountBase' => $amountBase
			]
		];

		$guzzleResponse = $this->call( '/smartterminals/' . $this->config->getTerminalId() . '/request-payment', 'POST', $options );

		try {
			return requestPayment::jsonDeserialize( $guzzleResponse->getBody()->getContents() );
		}
		catch( jsonDeserializeException $e ) {
			throw new payjunctionException( $e->getMessage(), $e->getCode(), $e );
		}
	}


	public function status( string $requestId ) : status {
		$guzzleResponse = $this->call( '/smartterminals/requests/' . $requestId );

		try {
			return status::jsonDeserialize( $guzzleResponse->getBody()->getContents() );
		}
		catch( jsonDeserializeException $e ) {
			throw new payjunctionException( $e->getMessage(), $e->getCode(), $e );
		}
	}


	/**
	 * @param  string  $signatureId
	 *
	 * @return string Base 64 encoded data URI of image
	 */
	public function signatureImage( string $signatureId ) : string {
		$guzzleResponse = $this->call( '/smartterminals/signatures/' . $signatureId . '/image' );

		$rawImageData = $guzzleResponse->getBody()->getContents();

		return 'data:image/png;base64,' . base64_encode( $rawImageData );
	}

}