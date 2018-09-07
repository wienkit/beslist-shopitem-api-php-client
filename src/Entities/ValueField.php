<?php

namespace Wienkit\BeslistShopitemClient\Entities;

/**
 * Class ValueField.
 *
 * @package Wienkit\BeslistShopitemClient\Entities
 */
class ValueField
{

    /**
     * @var string
     */
    protected $value;

    /**
     * @var string
     */
    protected $lastUpdate;

    /**
     * ValueField constructor.
     * @param string $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * Creates a new instance of a value.
     *
     * @param array $response
     * @return ValueField
     */
    public static function fromArray(array $response)
    {
        $value = new static($response['value']);
        if (array_key_exists('lastUpdate', $response)) {
            $value->setLastUpdate($response['lastUpdate']);
        }
        return $value;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getLastUpdate()
    {
        return $this->lastUpdate;
    }

    /**
     * @param string $lastUpdate
     */
    public function setLastUpdate($lastUpdate)
    {
        $this->lastUpdate = $lastUpdate;
    }
}
