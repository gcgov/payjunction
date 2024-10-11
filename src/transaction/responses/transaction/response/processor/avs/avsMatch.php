<?php
namespace gcgov\payjunction\transaction\responses\response\transaction\response\processor\avs;

class avsMatch extends \andrewsauder\jsonDeserialize\jsonDeserialize {

	public bool $ZIP = false;
	public bool $ADDRESS = false;

}
