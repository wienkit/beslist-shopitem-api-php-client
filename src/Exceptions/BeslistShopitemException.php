<?php
/**
 * Created by PhpStorm.
 * User: mark
 * Date: 7/7/16
 * Time: 6:13 PM
 */

namespace Wienkit\BeslistShopitemClient\Exceptions;


class BeslistShopitemException extends \Exception
{

    public function __construct(\Exception $previous = null, $result = null)
    {
        if($result != null) {
            $message = "Error (" . $result->info->http_code . "): " . $result->response_status_lines[0];
            parent::__construct($message);
        }
        else if($previous != null) {
            $message = $previous->getMessage();
            $code = $previous->getCode();
            parent::__construct($message, $code, $previous);
        } else {
            parent::__construct("Error in Beslist connection");
        }
    }
}