<?php
/**
 * Created by PhpStorm.
 * User: mark
 * Date: 7/7/16
 * Time: 5:14 PM
 */

namespace Wienkit\BeslistShopitemClient\Entities;


class AuthenticationResult
{
    public $sites;

    /**
     * AuthenticationResult constructor.
     * @param $response
     */
    public function __construct($response)
    {
        $this->sites = $response;
    }
}