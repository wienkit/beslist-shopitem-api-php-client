<?php

namespace Wienkit\BeslistShopitemClient\Entities;

/**
 * Class ShippingField.
 *
 * @package Wienkit\BeslistShopitemClient\Entities
 */
class ShippingField implements \JsonSerializable
{
    /**
     * @var string
     */
    protected $destinationCountry;

    /**
     * @var ValueField
     */
    protected $price;

    /**
     * @var ValueField
     */
    protected $deliveryTime;

    /**
     * ShippingField constructor.
     * @param string $destinationCountry
     * @param ValueField $price
     * @param ValueField $deliveryTime
     */
    public function __construct($destinationCountry, ValueField $price, ValueField $deliveryTime)
    {
        $this->destinationCountry = $destinationCountry;
        $this->price = $price;
        $this->deliveryTime = $deliveryTime;
    }

    /**
     * Creates a new ShippingField instance.
     * @param array $response
     * @return ShippingField
     */
    public static function fromArray(array $response)
    {
        $destinationCountry = $response['destinationCountry'];
        $price = ValueField::fromArray($response['price']);
        $deliveryTime = ValueField::fromArray($response['deliveryTime']);
        return new static($destinationCountry, $price, $deliveryTime);
    }

    /**
     * @return string
     */
    public function getDestinationCountry()
    {
        return $this->destinationCountry;
    }

    /**
     * @param string $destinationCountry
     */
    public function setDestinationCountry($destinationCountry)
    {
        $this->destinationCountry = $destinationCountry;
    }

    /**
     * @return ValueField
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param ValueField $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return ValueField
     */
    public function getDeliveryTime()
    {
        return $this->deliveryTime;
    }

    /**
     * @param ValueField $deliveryTime
     */
    public function setDeliveryTime($deliveryTime)
    {
        $this->deliveryTime = $deliveryTime;
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return [
            'destinationCountry' => $this->destinationCountry,
            'price' => $this->price->getValue(),
            'deliveryTime' => $this->deliveryTime->getValue(),
        ];
    }
}
