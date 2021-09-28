<?php
namespace gcgov\payjunction\smartTerminal\responses;

/**
 * @method requestSignature static jsonDeserialize()
 */
class requestSignature extends \gcgov\jsonDeserialize\jsonDeserialize {

	public string $requestId = '';

}