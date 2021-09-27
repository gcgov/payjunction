<?php

namespace gcgov\payjunction\exceptions;


class configException
	extends
	payjunctionException {

	public function __construct( $message, $code = 0, \Exception $previous = null ) {
		parent::__construct( $message, $code, $previous );
	}

}