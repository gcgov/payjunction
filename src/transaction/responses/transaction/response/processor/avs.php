<?php
namespace gcgov\payjunction\transaction\responses\response\transaction\response\processor;

use gcgov\payjunction\transaction\responses\response\transaction\response\processor\avs\avsMatch;

class avs extends \andrewsauder\jsonDeserialize\jsonDeserialize {

	public string $status = '';
	public string $requested = '';
	public ?avsMatch $match = null;

}
