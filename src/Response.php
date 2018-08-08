<?php
/**
 * Created by PhpStorm.
 * User: sure
 * Date: 2018-07-27
 * Time: 12:16
 */

namespace Sureyee\RockFinTech;


use Sureyee\RockFinTech\Contracts\ResponseInterface;

class Response implements ResponseInterface
{
    /**
     * @var array $response 钜石接口返回数据
     */
    protected $response;

    protected $items = [];


    public function __construct(array $response)
    {
        if (array_key_exists('items', $response)) {
            $this->items = array_map(function ($item) {
                return new ItemResponse($item);
            }, $response['items']);
        }
        $this->response = $response;
    }

    public function isSuccess()
    {
        return $this->code === static::ROCK_REQUEST_SUCCESS;
    }

    public function getMessage()
    {
        return $this->msg;
    }

    public function toArray()
    {
        return $this->response;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function __get($name)
    {
        return array_key_exists($name, $this->response) ? $this->response[$name] : null;
    }

    public function getItems()
    {
        return $this->items;
    }
}