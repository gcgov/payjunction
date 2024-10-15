<?php
namespace gcgov\payjunction\transaction\responses\transaction;

use gcgov\payjunction\transaction\responses\transaction\response\processor;

class response extends \andrewsauder\jsonDeserialize\jsonDeserialize {

	public bool       $approved  = false;
	public string     $code      = '';
	public string     $message   = '';
	public ?processor $processor = null;

}
