<?php

namespace gcgov\payjunction\exceptions;


use gcgov\payjunction\responses\error;
use JetBrains\PhpStorm\Pure;


class payjunctionException
	extends
	\LogicException {

	#[Pure]
	public function __construct( $message, $code = 0, \Exception $previous = null ) {
		parent::__construct( $message, $code, $previous );
	}


	/**
	 * @var \gcgov\payjunction\responses\error[]
	 */
	protected array $errors = [];


	/**
	 * @return \gcgov\payjunction\responses\error[]
	 */
	public function getErrors() : array {
		return $this->errors;
	}


	/**
	 * @param  string  $message
	 * @param  string  $parameter
	 * @param  string  $type
	 */
	public function addError( string $message, string $parameter, string $type ) : void {
		$error = new error( $message, $parameter, $type );
		$this->errors[] = $error;
	}

}