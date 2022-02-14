<?php
namespace gcgov\payjunction\smartTerminal\responses;

/**
 * @method status static jsonDeserialize()
 */
class status extends \andrewsauder\jsonDeserialize\jsonDeserialize {

	public string $status        = '';

	public string $signatureId   = '';

	public string $transactionId = '';

	public string $paymentId     = '';

	public string $promptButton  = '';

}