<?php
namespace gcgov\payjunction\smartTerminal\responses;

class status extends \andrewsauder\jsonDeserialize\jsonDeserialize {

	public string $status        = '';

	public string $signatureId   = '';

	public string $transactionId = '';

	public string $paymentId     = '';

	public string $promptButton  = '';

}
