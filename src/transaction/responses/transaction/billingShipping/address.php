<?php
namespace gcgov\payjunction\transaction\responses\transaction\billingShipping;

class address extends \andrewsauder\jsonDeserialize\jsonDeserialize {

	public string $address = '';
	public string $city    = '';
	public string $state   = '';
	public string $country = '';
	public string $zip     = '';

}
