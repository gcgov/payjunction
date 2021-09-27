<?php
namespace gcgov\payjunction\responses;


final class error {

	public string $message   = '';

	public string $parameter = '';

	public string $type      = '';


	public function __construct( string $message = '', string $parameter = '', string $type = '' ) {
		$this->message   = $message;
		$this->parameter = $parameter;
		$this->type      = $type;
	}

}