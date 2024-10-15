<?php
namespace gcgov\payjunction\transaction\responses\transaction\response;

use gcgov\payjunction\transaction\responses\transaction\response\processor\avs;
use gcgov\payjunction\transaction\responses\transaction\response\processor\cvv;

class processor extends \andrewsauder\jsonDeserialize\jsonDeserialize {

	public bool $authorized = false;
	public string $approvalCode = '';
	public ?avs $avs = null;
	public ?cvv $cvv = null;

}
