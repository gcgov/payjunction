<?php
namespace gcgov\payjunction\transaction\responses\transaction;

class vault extends \andrewsauder\jsonDeserialize\jsonDeserialize {

	public string $type = '';
	public string $accountType = '';
	public string $lastFour = '';

}
