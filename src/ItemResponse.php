<?php
/**
 * Created by PhpStorm.
 * User: sure
 * Date: 2018-07-29
 * Time: 15:47
 */

namespace Sureyee\RockFinTech;


use Sureyee\RockFinTech\Contracts\ResponseInterface;

class ItemResponse implements ResponseInterface
{
    /**
     * @var array $response 钜石接口返回数据
     */
    protected $response;

    public function __construct(array $response)
    {
        $this->response = $response;
    }

    public function isSuccess()
    {
        return $this->result === self::ROCK_RESULT_SUCCESS;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function toArray()
    {
        return $this->response;
    }

    public function __get($name)
    {
        return array_key_exists($name, $this->response) ? $this->response[$name] : null;
    }
}