<?php
namespace gcgov\payjunction\responses\smartTerminal;


/**
 * @method status static jsonDeserialize()
 */
class status extends \gcgov\jsonDeserialize\jsonDeserialize {

	public string $status        = '';

	public string $signatureId   = '';

	public string $transactionId = '';

	public string $paymentId     = '';

	public string $promptButton  = '';

}