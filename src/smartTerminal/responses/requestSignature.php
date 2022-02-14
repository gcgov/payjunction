<?php
namespace gcgov\payjunction\smartTerminal\responses;

/**
 * @method requestSignature static jsonDeserialize()
 */
class requestSignature extends \andrewsauder\jsonDeserialize\jsonDeserialize {

	public string $requestId = '';

}