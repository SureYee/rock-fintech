<?php
/**
 * Created by PhpStorm.
 * User: sure
 * Date: 2018-07-29
 * Time: 15:44
 */

namespace Sureyee\RockFinTech\Contracts;


interface ResponseInterface
{
    const ROCK_REQUEST_SUCCESS = 'RD000000';

    const ROCK_RESULT_SUCCESS = '00';

    public function isSuccess();

    public function getMessage();
}