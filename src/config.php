<?php

namespace gcgov\payjunction;


class config {

	private string $terminalId  = '';

	private string $merchantId  = '';

	private bool   $development = false;

	private string $username    = '';

	private string $password    = '';

	private string $apiKey      = '';


	/**
	 * @return string
	 */
	public function getUsername() : string {
		return $this->username;
	}


	/**
	 * @param  string  $username
	 */
	public function setUsername( string $username ) : void {
		$this->username = $username;
	}


	/**
	 * @return string
	 */
	public function getPassword() : string {
		return $this->password;
	}


	/**
	 * @param  string  $password
	 */
	public function setPassword( string $password ) : void {
		$this->password = $password;
	}


	/**
	 * @return string
	 */
	public function getApiKey() : string {
		return $this->apiKey;
	}


	/**
	 * @param  string  $apiKey
	 */
	public function setApiKey( string $apiKey ) : void {
		$this->apiKey = $apiKey;
	}


	/**
	 * @return bool
	 */
	public function isDevelopment() : bool {
		return $this->development;
	}


	/**
	 * @param  bool  $development
	 */
	public function setDevelopment( bool $development ) : void {
		$this->development = $development;
	}


	/**
	 * @return string
	 */
	public function getTerminalId() : string {
		return $this->terminalId;
	}


	/**
	 * @param  string  $terminalId
	 */
	public function setTerminalId( string $terminalId ) : void {
		$this->terminalId = $terminalId;
	}


	/**
	 * @return string
	 */
	public function getMerchantId() : string {
		return $this->merchantId;
	}


	/**
	 * @param  string  $merchantId
	 */
	public function setMerchantId( string $merchantId ) : void {
		$this->merchantId = $merchantId;
	}

}