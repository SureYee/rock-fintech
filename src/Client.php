<?php
/**
 * Created by PhpStorm.
 * User: sure
 * Date: 2018-07-27
 * Time: 12:15
 */

namespace Sureyee\RockFinTech;

use Sureyee\RockFinTech\Exceptions\DecryptException;
use Sureyee\RockFinTech\Exceptions\ResponseException;
use Sureyee\RockFinTech\Exceptions\RsaKeyNotFoundException;

class Client
{
    const ROCK_PC_CLIENT = '000002';

    /**
     * @var string $key rft_key
     */
    private $key;

    /**
     * @var string $secret $rft_secret
     */
    private $secret;

    private $org;

    /**
     * @var string $pub_key
     */
    private $pub_key;

    private $pri_key;

    /**
     * @var \GuzzleHttp\Client
     */
    protected $http;

    /**
     * Client constructor.
     * @param $rft_key
     * @param $rft_secret
     * @param $rft_org string 商户号
     * @param string $pub_key
     * @param string $pri_key
     */
    public function __construct($rft_key, $rft_secret, $rft_org, $pub_key = './public.key', $pri_key = './private.key')
    {
        $this->key = $rft_key;
        $this->secret = $rft_secret;
        $this->org = $rft_org;
        $this->pub_key = $pub_key;
        $this->pri_key = $pri_key;
        $this->http = new \GuzzleHttp\Client();
    }

    /**
     * @param Request $request
     * @return Response
     * @throws DecryptException
     * @throws ResponseException
     * @throws RsaKeyNotFoundException
     */
    public function request(Request $request)
    {
        $request->setClient(self::ROCK_PC_CLIENT);
        $request->setHeaders([
            'rft-key' => $this->key,
            'rft-token' => $this->secret,
            'rft-org' => $this->org,
        ]);

        // 生成sign
        $request->setSign($this->makeSign($request->getParams()));


        // 生成request
        $httpRequest = new \GuzzleHttp\Psr7\Request($request->method, $request->getUri(), $request->headers, $this->encrypt($request) );


        // 发送http请求
        $response = $this->http->send($httpRequest, ['debug' => true]);



        if ($response->getStatusCode() !== 200) {
            throw new ResponseException($response->getStatusCode(), $response->getReasonPhrase());
        }

        if ($array = json_decode($this->decrypt($response->getBody()), true)) {
            // 发送请求并返回响应
            return new Response($array);
        }

        throw new DecryptException('返回结果解密失败!');
    }

    /**
     * 生成Sign
     * @param $params
     * @return string
     */
    protected function makeSign($params)
    {
        kSortRecursive($params);
        unset($params['sign']);
        $paramsString = $this->paramsToString($params);

        return md5($paramsString . md5($this->key . $this->secret));
    }

    /**
     * 按照钜石科技的要求组合字符串结构
     * @param array $params
     * @param bool $assoc
     * @return string
     */
    public function paramsToString(array $params, $assoc = true)
    {
        $string = [];
        foreach ($params as $key => $param) {
            if (is_array($param)) {
                $string[] = $key . '=' . $this->paramsToString($param, isAssocArray($param));
            } else {
                $string[] = $assoc ? $key . '=' . $param : $param;
            }
        }
        return join('&', $string);
    }

    /**
     * @param $path
     * @return bool|string
     * @throws RsaKeyNotFoundException
     */
    protected function getRsaKey($path)
    {
        if (file_exists($path) && $content = file_get_contents($path))
            return $content;
        throw new RsaKeyNotFoundException($path . '文件不存在或不可读！');
    }

    /**
     * 加密
     * @param string $string
     * @return string
     * @throws RsaKeyNotFoundException
     */
    protected function encrypt(string $string)
    {
        $pub_key = openssl_pkey_get_public($this->getRsaKey($this->pub_key));

        $length = openssl_pkey_get_details($pub_key)['bits'];

        $string = str_split($string, $length / 8 - 11);
        $encryptedString = '';

        foreach ($string as $value) {
            openssl_public_encrypt($value, $encrypted, $pub_key);
            $encryptedString .= $encrypted;
        }

        return base64_encode($encryptedString);
    }

    /**
     * 解密
     * @param string $string
     * @return string
     * @throws RsaKeyNotFoundException
     */
    protected function decrypt(string $string)
    {
        $pri_key = openssl_pkey_get_private($this->getRsaKey($this->pri_key));

        $length = openssl_pkey_get_details($pri_key)['bits'];

        $splits = str_split(base64_decode($string), $length / 8);

        $decryptedString = '';

        foreach ($splits as $split) {
            openssl_private_decrypt($split, $decrypted, $pri_key);
            $decryptedString .= $decrypted;
        }

        return $decryptedString;
    }

    public function setPubKey($pub_key)
    {
        $this->pub_key = $pub_key;
    }

    public function setPriKey($pri_key)
    {
        $this->pri_key = $pri_key;
    }
}