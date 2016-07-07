# Beslist.nl Shopitem API PHP Client
This is an open source PHP client for the [Beslist.nl Shopitem API](http://www.beslist.nl/).

## Installation
Get it with [composer](https://getcomposer.org)

Run the command:
```
composer require wienkit/beslist-shopitem-api-php-client
```

## Example: get shopitem
```php
<?php

require __DIR__ . '/vendor/autoload.php';

$apiKey = '-- ENTER YOUR SHOPITEM API KEY --';

$this->client = new Wienkit\BeslistShopitemClient\BeslistShopitemClient($apiKey);
$this->client->setTestMode(TRUE);

// Authenticate with the API
$shops = $this->client->authenticate();
var_dump($shops);

// Get a shopitem
$shopId = 12345;
$itemId = '12abcd13';
$shopItem = $this->client->getShopItem($shopId, $itemId);
var_dump($shopItem);

// Update a shopitem
$shopId = 12345;
$itemId = '12abcd13';
$update = [
    'price' => 12.00,
    'discount_price' => 10.00,
    'delivery_cost_nl' => 5.00,
    'delivery_cost_be' => 6.00,
    'delivery_time_nl' => '24 uur',
    'delivery_time_be' => '48 uur',
    'stock' => 5
];
$this->client->updateShopItem($shopId, $itemId, $update);
```

See the tests folder for more information
