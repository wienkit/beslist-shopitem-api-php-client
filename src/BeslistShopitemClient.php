<?php

namespace Wienkit\BeslistShopitemClient;

use Wienkit\BeslistShopitemClient\Entities\AuthenticationResult;
use Wienkit\BeslistShopitemClient\Entities\ShopItem;
use Wienkit\BeslistShopitemClient\Exceptions\BeslistShopitemException;

require_once dirname(__FILE__).'/../vendor/autoload.php';

class BeslistShopitemClient
{
    const BASE_URL = 'https://shopitem.api.beslist.nl/';
    const TEST_URL = 'https://test-shopitem.api.beslist.nl/';

    /**
     * The Query to run against the FileSystem
     * @var \RestClient;
     */
    private $api;


    /**
     * BeslistShopitemClient constructor.
     * @param $apiKey
     */
    public function __construct($apiKey)
    {
        $this->api = new \RestClient([
            'base_url' => self::BASE_URL,
            'headers' => ['apikey' => $apiKey],
        ]);
        $this->api->register_decoder('json', function($data){
            return json_decode($data, TRUE);
        });
    }

    /**
     * Enable or disable testmode (default disabled)
     * @param bool $testMode
     */
    public function setTestMode($testMode)
    {
        if($testMode) {
            $this->api->set_option('base_url', self::TEST_URL);
        } else {
            $this->api->set_option('base_url', self::BASE_URL);
        }
    }


    /**
     * Authenticate with the Beslist Shopitem API
     * @return AuthenticationResult
     * @throws BeslistShopitemException
     */
    public function authenticate()
    {
        try {
            $result = $this->api->get("auth/v1/shops");
            if($result->info->http_code == 200) {
                return new AuthenticationResult($result->decode_response());
            } else {
                throw new BeslistShopitemException(null, $result);
            }
        } catch (\RestClientException $exception) {
            throw new BeslistShopitemException($exception);
        }
    }

    /**
     * @param $shopId
     * @param $productId
     * @param $options
     * @return boolean success
     * @throws BeslistShopitemException
     */
    public function updateShopItem($shopId, $productId, $options)
    {
        try {
            $result = $this->api->put("product/v2/shops/" . $shopId . "/items/" . $productId, $options);
            if($result->info->http_code == 200) {
                return true;
            } else {
                throw new BeslistShopitemException(NULL, $result);
            }
        } catch (\RestClientException $exception) {
            throw new BeslistShopitemException($exception);
        }
    }

    /**
     * Retrieve a ShopItem
     * @param $shopId
     * @param $productId
     * @return ShopItem
     * @throws BeslistShopitemException
     */
    public function getShopItem($shopId, $productId)
    {
        try {
            $result = $this->api->get("product/v1/shops/" . $shopId . "/items/" . $productId);
            if($result->info->http_code == 200) {
                return new ShopItem($result->decode_response());
            } else {
                throw new BeslistShopitemException(NULL, $result);
            }
        } catch (\RestClientException $exception) {
            throw new BeslistShopitemException($exception);
        }
    }
}
