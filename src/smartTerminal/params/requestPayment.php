<?php
namespace gcgov\payjunction\smartTerminal\params;


class requestPayment
	implements
	\JsonSerializable {

	public ?string $action              = null;

	public ?float  $amountShipping      = null;

	public ?float  $amountSurcharge     = null;

	public ?bool   $showReceiptPrompt   = null;

	public ?bool   $showSignaturePrompt = null;

	public ?bool   $allowTips           = null;

	public ?string $keyed               = null;

	public ?int    $invoiceNumber       = null;

	public ?string $purchaseOrderNumber = null;

	public ?string $billingIdentifier   = null;

	public ?string $billingEmail        = null;

	public ?string $shippingIdentifier  = null;

	public ?string $shippingEmail       = null;

	public ?string $note                = null;


	public function toArray() : array {
		$exp = [];

		//TODO: replace with attributes
		if( is_string( $this->purchaseOrderNumber ) && strlen( $this->purchaseOrderNumber ) > 32 ) {
			$this->purchaseOrderNumber = substr( $this->purchaseOrderNumber, 0, 32 );
		}
		if( is_string( $this->billingIdentifier ) && strlen( $this->billingIdentifier ) > 64 ) {
			$this->billingIdentifier = substr( $this->billingIdentifier, 0, 64 );
		}
		if( is_string( $this->billingEmail ) && strlen( $this->billingEmail ) > 125 ) {
			$this->billingEmail = substr( $this->billingEmail, 0, 125 );
		}
		if( is_string( $this->shippingIdentifier ) && strlen( $this->shippingIdentifier ) > 64 ) {
			$this->shippingIdentifier = substr( $this->shippingIdentifier, 0, 64 );
		}
		if( is_string( $this->shippingEmail ) && strlen( $this->shippingEmail ) > 128 ) {
			$this->shippingEmail = substr( $this->shippingEmail, 0, 128 );
		}
		if( is_string( $this->note ) && strlen( $this->note ) > 2048 ) {
			$this->note = substr( $this->note, 0, 2048 );
		}

		foreach( get_object_vars( $this ) as $key => $value ) {
			if( $value !== null ) {
				$exp[ $key ] = $value;
			}
		}

		return $exp;
	}


	public function jsonSerialize() : array {
		return $this->toArray();
	}

}