<?php

namespace Wienkit\BeslistShopitemClient\Entities;

use Wienkit\BeslistShopitemClient\Exceptions\BeslistFormatException;

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
    public function __construct(ValueField $regularPrice, ValueField $previousPrice = null)
    {
        $this->regularPrice = $regularPrice;
        $this->previousPrice = $previousPrice;
    }

    /**
     * Instantiates a new PriceField instance.
     *
     * @param array $response
     * @return PriceField
     *
     * @throws BeslistFormatException
     */
    public static function fromArray($response)
    {
        $previousPrice = null;
        if (isset($response['previousPrice'])) {
            $previousPrice = ValueField::fromArray($response['previousPrice']);
        }
        if (!isset($response['regularPrice']) || !is_array($response['regularPrice'])) {
            throw new BeslistFormatException('Could not create regularPrice on pricefield');
        }
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
        $result = [
            'regularPrice' => $this->regularPrice->getValue(),
        ];
        if ($this->previousPrice) {
            $result['previousPrice'] = $this->previousPrice->getValue();
        }
        return $result;
    }
}
