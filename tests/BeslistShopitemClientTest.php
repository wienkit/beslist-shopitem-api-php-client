<?php

use Wienkit\BeslistShopitemClient\BeslistShopitemClient;
use Wienkit\BeslistShopitemClient\Entities\PriceField;
use Wienkit\BeslistShopitemClient\Entities\ShippingField;
use Wienkit\BeslistShopitemClient\Entities\ShopItem;
use Wienkit\BeslistShopitemClient\Entities\StockField;
use Wienkit\BeslistShopitemClient\Entities\ValueField;

class BeslistShopitemClientTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Wienkit\BeslistShopitemClient\BeslistShopitemClient
     */
    private $client;

    /**
     * @var int
     */
    private $shopId;

    public function setUp()
    {
        $apiKey = 'DL2scMwuWQrBmplS4DCcAN5elRQTabTkva2Bk7nYcPfcaFgDUxKxa1pWkgpaSDxKMOI5bhFd';
        $this->shopId = 565155; // -- YOUR SHOP ID --
        $this->client = new BeslistShopitemClient($apiKey);
    }

    public function testArrayParsing()
    {
        $price = new PriceField(new ValueField(12), new ValueField(16));
        $shipping = [
            new ShippingField('nl', new ValueField(0), new ValueField('2 days')),
            new ShippingField('be', new ValueField(6), new ValueField('6 days')),
        ];
        $stock = new StockField(new ValueField(0));
        $shopItem = new ShopItem($price, $shipping, $stock);
        $shopItem2 = $this->getShopItemFromArray();
        $this->assertEquals($shopItem, $shopItem2);
    }

    public function testGetShopItem()
    {
        $shopItem = $this->client->getShopItem($this->shopId, '1-1');
        $this->assertNotEmpty($shopItem);
    }

    public function testUpdateShopItem()
    {
        $shopItem = $this->getShopItemFromArray();
        $updateResult = $this->client->updateShopItem($this->shopId, '1-1', $shopItem);
        $this->assertTrue($updateResult);
    }

    public function testJsonEncoding()
    {
        $shopItem = $this->getShopItemFromArray();
        $encoded = json_encode($shopItem);
        $expectedResult = "{\"price\":{\"regularPrice\":12,\"previousPrice\":16},\"shipping\":[{\"destinationCountry\":\"nl\",\"price\":0,\"deliveryTime\":\"2 days\"},{\"destinationCountry\":\"be\",\"price\":6,\"deliveryTime\":\"6 days\"}],\"stock\":{\"level\":0}}";
        $this->assertJsonStringEqualsJsonString($expectedResult, $encoded);
    }

    /**
     * @return ShopItem
     */
    private function getShopItemFromArray()
    {
        return ShopItem::fromArray([
            'price' => [
                'regularPrice' => [
                    'value' => 12.00
                ],
                'previousPrice' => [
                    'value' => 16.00
                ],
            ],
            'shipping' => [
                [
                    'destinationCountry' => 'nl',
                    'price' => [
                        'value' => 0,
                    ],
                    'deliveryTime' => [
                        'value' => '2 days',
                    ],
                ],
                [
                    'destinationCountry' => 'be',
                    'price' => [
                        'value' => 6,
                    ],
                    'deliveryTime' => [
                        'value' => '6 days',
                    ],
                ]
            ],
            'stock' => [
                'level' => [
                    'value' => 0
                ],
            ],
        ]);
    }
}
