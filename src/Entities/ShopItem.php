<?php
/**
 * Created by PhpStorm.
 * User: mark
 * Date: 7/7/16
 * Time: 6:09 PM
 */

namespace Wienkit\BeslistShopitemClient\Entities;


class ShopItem
{

    /**
     * @var float
     */
    public $price;

    /**
     * @var string
     */
    public $price_updated;

    /**
     * @var float
     */
    public $discount_price;

    /**
     * @var string
     */
    public $discount_price_updated;

    /**
     * @var float
     */
    public $delivery_cost_nl;

    /**
     * @var string
     */
    public $delivery_cost_nl_updated;

    /**
     * @var float
     */
    public $delivery_cost_be;

    /**
     * @var string
     */
    public $delivery_cost_be_updated;

    /**
     * @var string
     */
    public $delivery_time_nl;

    /**
     * @var string
     */
    public $delivery_time_nl_updated;

    /**
     * @var string
     */
    public $delivery_time_be;

    /**
     * @var string
     */
    public $delivery_time_be_updated;

    /**
     * @var int
     */
    public $stock;

    /**
     * @var string
     */
    public $stock_updated;

    /**
     * ShopItem constructor.
     * @param $response
     */
    public function __construct($response)
    {
        $this->price = $response['price']['value'];
        $this->price_updated = $response['price']['last_update'];
        $this->discount_price = $response['discount_price']['value'];
        $this->discount_price_updated = $response['discount_price']['last_update'];
        $this->delivery_cost_nl = $response['delivery_cost_nl']['value'];
        $this->delivery_cost_nl_updated = $response['delivery_cost_nl']['last_update'];
        $this->delivery_cost_be = $response['delivery_cost_be']['value'];
        $this->delivery_cost_be_updated = $response['delivery_cost_be']['last_update'];
        $this->delivery_time_nl = $response['delivery_time_nl']['commercial'];
        $this->delivery_time_nl_updated = $response['delivery_time_nl']['last_update'];
        $this->delivery_time_be = $response['delivery_time_be']['commercial'];
        $this->delivery_time_be_updated = $response['delivery_time_be']['last_update'];
        $this->stock = $response['stock']['value'];
        $this->stock_updated= $response['stock']['last_update'];
    }
}