<?php
/**
 * Created by PhpStorm.
 * User: sure
 * Date: 2018-07-27
 * Time: 12:16
 */

namespace Sureyee\RockFinTech;


class Request
{
    protected static $prod_uri = 'https://deposit.srbank.cn/2.0.0/deposit';

    protected static $dev_uri = 'https://depositapiuat.rockfintech.com/2.0.0/deposit';

    protected static $env = 'development';

    protected $version = '2.0.0';

    public $method = 'POST';

    public $headers = [];


    /**
     * @var array $params
     */
    protected $params = [];

    /**
     * Request constructor.
     * @param $service string
     * @param $custom mixed
     */
    public function __construct(string $service, $custom = null)
    {
        $this->params['service'] = $service;
        $this->params['version'] = $this->version;
        $this->params['uuid'] = uuid();
        $this->params['sign_type'] = 'MD5';
        $this->params['encode'] = 'UTF-8';
        $this->params['custom'] = $custom;
        $this->params['timestamp'] = time();
    }

    public function setParams(array $params)
    {
        $this->params = array_merge($this->params, $params);
    }

    public function getParams()
    {
        return $this->params;
    }

    /**
     * 设置签名
     * @param $sign
     * @return $this
     */
    public function setSign($sign)
    {
        $this->params['sign'] = $sign;
        return $this;
    }

    public function setClient($client)
    {
        $this->params['client'] = $client;
        return $this;
    }

    /**
     * @param $ip
     * @return $this
     */
    public function setIp($ip)
    {
        $this->params['client_ip'] = $ip;
        return $this;
    }

    /**
     * @param $mac
     * @return $this
     */
    public function setMac($mac)
    {
        $this->params['client_service'] = $mac;
        return $this;
    }

    /**
     * @param array $headers
     * @return $this
     */
    public function setHeaders(array $headers)
    {
        $this->headers = array_merge($this->headers, $headers);
        return $this;
    }

    /**
     * 将对象转换为严格的json
     * @return string
     */
    public function toJson()
    {
        array_walk_recursive($this->params, function (&$value) {
            $value = (string) $value;
        });
        return json_encode($this->params);
    }

    /**
     * 设置当前请求环境
     * @param string $env
     */
    public static function setEnv(string $env)
    {
        static::$env = $env;
    }

    /**
     * 获取请求接口地址
     * @return string
     */
    public function getUri()
    {
        if (self::$env === 'production' || self::$env === 'prod') {
            return self::$prod_uri;
        }
        return self::$dev_uri;
    }

    public function __set($name, $value)
    {
        $this->params[$name] = $value;
    }

    public function __get($param)
    {
        if (array_key_exists($param, $this->params)) {
            return $this->params[$param];
        }
        return null;
    }

    public function __toString()
    {
        return $this->toJson();
    }
}