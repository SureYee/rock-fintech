# 钜石接口API

#### 项目介绍
钜石api接口

#### 软件架构
软件架构说明


#### 安装教程

1. `composer require sureyee/rock-fintech:~1.0`

#### 使用说明

```php

// 实例化Client，传入配置信息
$clinet = new Sureyee\RockFinTech\Client($rft_key, $rft_secret, $rft_org, $pub_key, $pri_key)

// 实例化请求对象
$request = new Request('create_account_p');

$userinfo = [
    // ...
];

//设定参数，发起请求。
$response = $client->request($request->setParams($userinfo));

if ($response->isSuccess()) {
    // [ItemResponse]
    $items = $response->getItems();
} else {
    echo $reponse->getMessage();
}

```

#### 生产环境和测试环境

所有的 `Request` 默认调用测试环境的api，
如果切换到正式环境，需要在发送请求之前执行 `Request::setEnv('production')`,
将所有`Request` 对象的环境设置成 `production`。

#### 接口调用

接口调用时，公共参数已经进行了封装，直接调用 `setParams` 方法传入接口对应字段即可。
如果需要修改公共参数，通过`setParam()` 或在 `setParams()` 中传入相应的字段信息即可替换原有的数据。

