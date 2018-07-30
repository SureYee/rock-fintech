<?php
/**
 * Created by PhpStorm.
 * User: sure
 * Date: 2018-07-27
 * Time: 15:47
 */
use PHPUnit\Framework\TestCase;

class HelperTest extends TestCase
{
    public function testIsAssocArray()
    {
        $array = ['a' => 10];
        $this->assertTrue(isAssocArray($array));

        $array = [10, 20];
        $this->assertFalse(isAssocArray($array));
    }
}