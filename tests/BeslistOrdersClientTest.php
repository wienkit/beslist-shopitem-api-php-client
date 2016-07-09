<?php
class BeslistShopitemClientTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Wienkit\BeslistShopitemClient\BeslistShopitemClient
     */
    private $client;

    private $shopId = 12345;
    private $itemId = '12abcd13';

    public function setUp()
    {
        $apiKey = '-- YOUR SHOPITEM API KEY --';
        $this->client = new Wienkit\BeslistShopitemClient\BeslistShopitemClient($apiKey);
        $this->client->setTestMode(TRUE);
    }

    public function testAuthentication()
    {
        $authenticationResult = $this->client->authenticate();
        $this->assertNotEmpty($authenticationResult);
        $this->assertGreaterThan(0, count($authenticationResult->sites));
    }

    public function testGetShopItem()
    {
        $shopItem= $this->client->getShopItem($this->shopId, $this->itemId);
        $this->assertNotEmpty($shopItem);
    }

    public function testUpdateShopItem()
    {
        $update = [
            'price' => 12.00,
            'discount_price' => 10.00,
            'delivery_cost_nl' => 5.00,
            'delivery_cost_be' => 6.00,
            'delivery_time_nl' => '24 uur',
            'delivery_time_be' => '48 uur',
            'stock' => 5
        ];
        $updateResult = $this->client->updateShopItem($this->shopId, $this->itemId, $update);
        $this->assertTrue($updateResult);
    }
}
