<?php

namespace Wienkit\BeslistShopitemClient\Entities;

use Wienkit\BeslistShopitemClient\Exceptions\BeslistFormatException;

/**
 * Class StockField.
 *
 * @package Wienkit\BeslistShopitemClient\Entities
 */
class StockField implements \JsonSerializable
{
    /**
     * @var ValueField
     */
    protected $level;

    /**
     * StockField constructor.
     * @param $level
     */
    public function __construct(ValueField $level)
    {
        $this->level = $level;
    }

    /**
     * Creates a new StockField from an array.
     *
     * @param array $response
     * @return StockField
     *
     * @throws BeslistFormatException
     */
    public static function fromArray(array $response)
    {
        if (!isset($response['price']) || !is_array($response['price'])) {
            throw new BeslistFormatException('Could not create level on StockField');
        }
        $level = ValueField::fromArray($response['level']);
        return new static($level);
    }

    /**
     * @return ValueField
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @param ValueField $level
     */
    public function setLevel(ValueField $level)
    {
        $this->level = $level;
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return [
            'level' => $this->level->getValue(),
        ];
    }

}
