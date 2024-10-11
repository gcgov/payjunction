<?php

namespace gcgov\payjunction;

use andrewsauder\jsonDeserialize\exceptions\jsonDeserializeException;
use gcgov\payjunction\exceptions\configException;
use gcgov\payjunction\exceptions\payjunctionException;
use gcgov\payjunction\transaction\responses;

class transaction
	extends
	core\api {

	/**
	 * @param \gcgov\payjunction\config $config
	 *
	 * @throws \gcgov\payjunction\exceptions\configException
	 */
	public function __construct( \gcgov\payjunction\config $config ) {
		parent::__construct( $config );

		if( $this->config->getMerchantId()=='' ) {
			throw new configException( 'Merchant id is required in the PayJunction config to use the transactions module', 400 );
		}
	}


	/**
	 * @param string|int $transactionId
	 *
	 * @return \gcgov\payjunction\transaction\responses\transaction
	 * @throws \gcgov\payjunction\exceptions\connectException
	 * @throws \gcgov\payjunction\exceptions\payjunctionException
	 */
	public function getTransaction( string|int $transactionId ): responses\transaction {

		$guzzleResponse = $this->call( '/transactions/' . $transactionId, 'GET' );

		try {
			return responses\transaction::jsonDeserialize( $guzzleResponse->getBody()->getContents() );
		}
		catch( jsonDeserializeException $e ) {
			throw new payjunctionException( $e->getMessage(), $e->getCode(), $e );
		}
	}

}
