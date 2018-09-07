<?php

namespace Wienkit\BeslistShopitemClient\Entities;

/**
 * Class PriceField.
 *
 * @package Wienkit\BeslistShopitemClient\Entities
 */
class PriceField implements \JsonSerializable
{
    /**
     * @var ValueField
     */
    protected $regularPrice;

    /**
     * @var ValueField
     */
    protected $previousPrice;

    /**
     * PriceField constructor.
     * @param ValueField $regularPrice
     * @param ValueField $previousPrice
     */
    public function __construct(ValueField $regularPrice, ValueField $previousPrice)
    {
        $this->regularPrice = $regularPrice;
        $this->previousPrice = $previousPrice;
    }

    /**
     * Instantiates a new PriceField instance.
     *
     * @param $response
     * @return PriceField
     */
    public static function fromArray($response)
    {
        $previousPrice = ValueField::fromArray($response['previousPrice']);
        $regularPrice = ValueField::fromArray($response['regularPrice']);
        return new static($regularPrice, $previousPrice);
    }

    /**
     * @return ValueField
     */
    public function getRegularPrice()
    {
        return $this->regularPrice;
    }

    /**
     * @param ValueField $regularPrice
     */
    public function setRegularPrice($regularPrice)
    {
        $this->regularPrice = $regularPrice;
    }

    /**
     * @return ValueField
     */
    public function getPreviousPrice()
    {
        return $this->previousPrice;
    }

    /**
     * @param ValueField $previousPrice
     */
    public function setPreviousPrice($previousPrice)
    {
        $this->previousPrice = $previousPrice;
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return [
            'regularPrice' => $this->regularPrice->getValue(),
            'previousPrice' => $this->previousPrice->getValue(),
        ];
    }
}