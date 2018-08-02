<?php
/**
 * Created by PhpStorm.
 * User: sure
 * Date: 2018-08-01
 * Time: 15:42
 */

namespace Sureyee\RockFinTech;


class RockConfig
{
    // 账户类型 普通户 企业户
    const ACCOUNT_TYPE_COMMON = 200201;
    const ACCOUNT_TYPE_COMPANY = 200204;

    // 用户角色 出借角色 借款角色 代偿角色
    const ROLE_TYPE_LENDER = 1;
    const ROLE_TYPE_BORROWER = 2;
    const ROLE_TYPE_UNDERWRITER = 3;

    // 业务类别
    const BATCH_TYPE_PAY = '001';  //放款
    const BATCH_TYPE_REPAY = '002'; // 到期还款
    const BATCH_TYPE_UNDERWRITER = '003'; // 平台逾期代偿/担保公司代偿

    // 币种
    const CNY = 156; // 人民币

    // 结束位标识
    const FINISHED = 1; // 结束
    const UNFINISHED = 0; // 未结束



}