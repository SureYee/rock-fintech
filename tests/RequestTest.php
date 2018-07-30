<?php
/**
 * Created by PhpStorm.
 * User: sure
 * Date: 2018-07-27
 * Time: 14:18
 */
use Sureyee\RockFinTech\Request;

class RequestTest extends \PHPUnit\Framework\TestCase
{

    public function requestProvider()
    {
        $request = new Request('test_service');
        $request->setParams([
            'a' => 10,
            'b' => 'mm'
        ]);
        return [[$request]];
    }

    /**
     * @dataProvider requestProvider
     */
    public function testToJson(Request $request)
    {
        $this->assertJson($request->toJson());
    }
}