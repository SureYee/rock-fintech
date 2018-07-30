<?php
/**
 * Created by PhpStorm.
 * User: sure
 * Date: 2018-07-29
 * Time: 15:20
 */

namespace Sureyee\RockFinTech\Exceptions;


class ResponseException extends \Exception
{

    public function __construct($status, $reasonPhrase)
    {

        $message = "服务器返回错误：[status: $status, reason: $reasonPhrase]";

        parent::__construct($message);
    }

}