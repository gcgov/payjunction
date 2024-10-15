<?php
namespace gcgov\payjunction\transaction\responses\transaction;

use gcgov\payjunction\transaction\responses\transaction\billingShipping\address;

class billingShipping extends \andrewsauder\jsonDeserialize\jsonDeserialize {

	public string   $firstName   = '';
	public string   $middleName  = '';
	public string   $lastName    = '';
	public string   $companyName = '';
	public string   $email       = '';
	public string   $phone       = '';
	public string   $phone2      = '';
	public string   $jobTitle    = '';
	public string   $identifier  = '';
	public string   $website     = '';
	public ?address $address     = null;

}
