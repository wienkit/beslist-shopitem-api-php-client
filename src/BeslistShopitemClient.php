<?php

namespace Wienkit\BeslistShopitemClient;

use Wienkit\BeslistShopitemClient\Entities\ShopItem;
use Wienkit\BeslistShopitemClient\Exceptions\BeslistShopitemException;

class BeslistShopitemClient
{
    const BASE_URL = 'https://shopitem.api.beslist.nl/';

    const API_VERSION = 'v3';
    const API_PREFIX = '/offer/shops/';

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
            'base_url' => self::BASE_URL . self::API_VERSION . self::API_PREFIX,
            'headers' => ['apiKey' => $apiKey],
        ]);
        $this->api->register_decoder('json', function ($data){
            return json_decode($data, TRUE);
        });
    }

    /**
     * @param $shopId
     * @param $productId
     * @param ShopItem $shopItem
     * @return boolean success
     * @throws BeslistShopitemException
     */
    public function updateShopItem($shopId, $productId, ShopItem $shopItem)
    {
        try {
            $body = json_encode($shopItem);
            $result = $this->api->put($shopId . '/offers/' . $productId, $body);
            if ($result->info->http_code == 200) {
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
     * @throws Exceptions\BeslistFormatException
     */
    public function getShopItem($shopId, $productId)
    {
        try {
            $result = $this->api->get($shopId . '/offers/' . $productId);
            if($result->info->http_code == 200) {
                return ShopItem::fromArray($result->decode_response());
            } else {
                throw new BeslistShopitemException(NULL, $result);
            }
        } catch (\RestClientException $exception) {
            throw new BeslistShopitemException($exception);
        }
    }
}
