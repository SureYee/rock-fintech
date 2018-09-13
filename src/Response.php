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

    protected $allSuccess = null;

    protected $successItems = [];

    protected $errorItems = [];


    public function __construct(array $response)
    {
        if (array_key_exists('items', $response)) {
            $this->items = array_map(function ($item) {
                $itemResponse =  new ItemResponse($item);
                $itemResponse->isSuccess()
                    ? array_push($this->successItems, $itemResponse)
                    : array_push($this->errorItems, $itemResponse);
                $this->allSuccess = empty($this->errorItems) ? true : false;
                return $itemResponse;
            }, $response['items']);
        }
        $this->response = $response;
    }

    public function isSuccess()
    {
        return $this->getCode() === static::ROCK_REQUEST_SUCCESS;
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

    public function allSuccess()
    {
        return $this->allSuccess ?? $this->isSuccess();
    }

    public function getErrorItems()
    {
        return $this->errorItems;
    }

    public function getSuccessItems()
    {
        return $this->successItems;
    }
}