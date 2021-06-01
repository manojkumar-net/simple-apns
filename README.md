# SimpleApns 

## _Apple Push Notification_

Needs
- Config
- Message
- Device Token

## Install

via Composer

``` bash
composer require manojkumarlinux/simple-apns
```

##Usage

```php
<?php 

require __DIR__ . '/vendor/autoload.php';

use SimpleApns\Apns;

$config =[
    'environment' => true,
    'keyPath' => './key.pem',
    'secretKey' => 'secret Key',
    'buildId' = 'build id'
];

$message = [
    'title' => ' title ',
    'body' => 'body of message',
    'sound' => 'default' // optional
];

$deviceToken = '64-bit token';

Apns::send($config, $message, $deviceToken);

```

Return response
```php
// success message 
array(2) {
  ["response"]=>
  string(8) "Success."
  ["code"]=>
  int(200)
}

// fail
array(2) {
  ["response"]=>
  string(12) "Bad request."
  ["code"]=>
  int(400)
}
```
## License
MIT
