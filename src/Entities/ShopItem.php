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

    public $response;

    /**
     * ShopItem constructor.
     * @param $response
     */
    public function __construct($response)
    {
        $this->response = $response;
    }
}