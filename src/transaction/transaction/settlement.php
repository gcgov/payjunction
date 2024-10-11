<?php
namespace gcgov\payjunction\transaction\responses;

class settlement extends \andrewsauder\jsonDeserialize\jsonDeserialize {

	public bool $settled      = false;
	public ?int $settlementId = null;

}
