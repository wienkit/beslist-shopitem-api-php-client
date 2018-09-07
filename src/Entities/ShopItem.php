<?php

namespace Wienkit\BeslistShopitemClient\Entities;

/**
 * Class ShopItem
 *
 * @package Wienkit\BeslistShopitemClient\Entities
 */
class ShopItem implements \JsonSerializable
{
    /**
     * @var int
     */
    protected $shopId;

    /**
     * @var string
     */
    protected $externalId;

    /**
     * @var PriceField
     */
    protected $price;

    /**
     * @var ShippingField[]
     */
    protected $shipping;

    /**
     * @var StockField
     */
    protected $stock;

    /**
     * Instantiates a new Offer/ShopItem from an array
     * @param array $values
     * @return ShopItem
     */
    public static function fromArray(array $values)
    {
        $price = PriceField::fromArray($values['price']);
        $shipping = [];
        foreach ($values['shipping'] as $destination) {
            $shipping[] = ShippingField::fromArray($destination);
        }
        $stock = StockField::fromArray($values['stock']);
        return new static($price, $shipping, $stock);
    }

    /**
     * Returns a full ShopItem from the http response.
     * @param array $response
     * @return ShopItem
     */
    public static function fromResponse(array $response)
    {
        $item = self::fromArray($response);
        $item->setShopId($response['shopId']);
        $item->setExternalId($response['externalId']);
        return $item;
    }

    /**
     * ShopItem constructor.
     * @param PriceField $price
     * @param array $shipping
     * @param StockField $stock
     */
    public function __construct(PriceField $price, array $shipping, StockField $stock)
    {
        $this->price = $price;
        $this->shipping = $shipping;
        $this->stock = $stock;
    }

    /**
     * @return int
     */
    public function getShopId()
    {
        return $this->shopId;
    }

    /**
     * @param int $shopId
     */
    public function setShopId($shopId)
    {
        $this->shopId = $shopId;
    }

    /**
     * @return string
     */
    public function getExternalId()
    {
        return $this->externalId;
    }

    /**
     * @param string $externalId
     */
    public function setExternalId($externalId)
    {
        $this->externalId = $externalId;
    }

    /**
     * @return PriceField
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param PriceField $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return array|ShippingField[]
     */
    public function getShipping()
    {
        return $this->shipping;
    }

    /**
     * @param array|ShippingField[] $shipping
     */
    public function setShipping($shipping)
    {
        $this->shipping = $shipping;
    }

    /**
     * @return StockField
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * @param StockField $stock
     */
    public function setStock($stock)
    {
        $this->stock = $stock;
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return [
            'price' => $this->price,
            'shipping' => $this->shipping,
            'stock' => $this->stock,
        ];
    }

}
