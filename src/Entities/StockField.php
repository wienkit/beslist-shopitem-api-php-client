<?php

namespace Wienkit\BeslistShopitemClient\Entities;

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
     */
    public static function fromArray(array $response)
    {
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
