<?php
namespace gcgov\payjunction\transaction\responses;

class surcharge extends \andrewsauder\jsonDeserialize\jsonDeserialize {

	public ?float $percentage = null;
	public string $status     = '';

}
