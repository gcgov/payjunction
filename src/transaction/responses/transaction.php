<?php
namespace gcgov\payjunction\transaction\responses;

use gcgov\payjunction\transaction\responses\transaction\billingShipping;
use gcgov\payjunction\transaction\responses\transaction\response;
use gcgov\payjunction\transaction\responses\transaction\settlement;
use gcgov\payjunction\transaction\responses\transaction\surcharge;
use gcgov\payjunction\transaction\responses\transaction\vault;

class transaction extends \andrewsauder\jsonDeserialize\jsonDeserialize {

	public string              $transactionId       = '';
	public string              $uri                 = '';
	public string              $terminalId          = '';
	public string              $action              = '';
	public ?float              $amountBase          = 0;
	public ?float              $amountShipping      = 0;
	public ?float              $amountTip           = 0;
	public ?float              $amountSurcharge     = 0;
	public ?float              $amountTotal         = 0;
	public ?surcharge          $surcharge           = null;
	public string              $custom1             = '';
	public string              $invoiceId           = '';
	public string              $invoiceNumber       = '';
	public string              $purchaseOrderNumber = '';
	public string              $method              = '';
	public string              $service             = '';
	public string              $status              = '';
	public string              $signatureStatus     = '';
	public ?\DateTimeImmutable $created             = null;
	public ?\DateTimeImmutable $lastModified        = null;
	public ?response           $response            = null;
	public ?settlement         $settlement          = null;
	public ?vault              $vault               = null;
	public ?billingShipping    $billing             = null;
	public ?billingShipping    $shipping            = null;

}
