# PayJunction PHP SDK
See https://developer.payjunction.com/ for full PayJunction API documentation. This package is not affiliated with or supported by PayJunction.

## SmartTerminals
```php
$config = new \gcgov\payjunction\config( 'username', 'password', 'apiKey', 'terminalId', 'merchantId' );
$smartTerminalApi = new \gcgov\payjunction\smartTerminal( $config );

//Methods available for interacting with Smart Terminal
$smartTerminalApi->reset();
$smartTerminalApi->status( 'request-id-from-response');
$smartTerminalApi->requestPayment( 100.25 );
$smartTerminalApi->requestSignature( 'Terms and conditions to display on screen');
$smartTerminalApi->signatureImage( 'signature-id-from-response');
```


## Transactions
### Get One
```php
$config = new \gcgov\payjunction\config( 'username', 'password', 'apiKey', 'terminalId', 'merchantId' );
$transactionApi = new \gcgov\payjunction\smartTerminal( $config );

//Methods available for interacting with Smart Terminal
$transactionApi->getTransaction( $transactionId );
```
