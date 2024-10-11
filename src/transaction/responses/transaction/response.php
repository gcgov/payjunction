<?php
namespace gcgov\payjunction\transaction\responses;

class response extends \andrewsauder\jsonDeserialize\jsonDeserialize {

	public bool       $approved  = false;
	public string     $code      = '';
	public string     $message   = '';
	public ?processor $processor = null;

}
