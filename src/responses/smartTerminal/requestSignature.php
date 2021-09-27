<?php
namespace gcgov\payjunction\responses\smartTerminal;

/**
 * @method requestSignature static jsonDeserialize()
 */
class requestSignature extends \gcgov\jsonDeserialize\jsonDeserialize {

	public string $requestId = '';

}