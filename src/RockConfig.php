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

    // 主副卡绑定类型
    const CARD_TYPE_MAIN = 0; // 主卡
    const CARD_TYPE_ADDITIONAL = 1; // 副卡
    const CARD_TYPE_UNSET = 2; // 已注销

    // 绑卡状态
    const CARD_BIND = 0 ;// 已绑卡

    // 营销户类型
    const MARKETING_SERVICE_TYPE = 1; // 服务费账户类型
    const MARKETING_RED_ENVELOPE_TYPE = 2; //红包账户类型

    // 账户类型
    const ACCOUNT_STATE_NORMAL = 0; // 正常
    const ACCOUNT_STATE_FREEZE = 1; // 冻结
    const ACCOUNT_STATE_UNSET = 2; // 注销

    // 证件类型
    const CERT_TYPE_ID_CARD = 15; // 身份证

    // 查询的记录状态
    const SEARCH_STATE_ALL = 0; // 所有状态
    const SEARCH_STATE_BIDDING = 0; // 投标中
    const SEARCH_STATE_PAYING = 0; // 放款中
    const SEARCH_STATE_ACCRUAL = 0; // 计息中
    const SEARCH_STATE_OVER = 0; // 本息已返回完

    // 翻页标志
    const PAGE_FLAG_TRUE = 1; // 翻页
    const PAGE_FLAG_FALSE = null; // 不翻页

    // 冲正标志位
    const RECORD_FLAG_TRUE = 'Y'; // 冲正
    const RECORD_FLAG_FALSE = 'N'; // 未冲正

    // 交易类型
    const TRANSACT_TYPE_ALL = null; // 所有流水
    const TRANSACT_TYPE_FINANCIAL = 'B'; // 金融流水
    const TRANSACT_TYPE_NON_FINANCIAL = 'N'; // 非金融流程

    // 流水类型
    const SERIAL_ALL = 0; // 所有交易
    const SERIAL_IN = 1; // 转入
    const SERIAL_OUT = 2; // 转出

    // 排序
    const ORDER_ASC = 1; // 正序
    const ORDER_DESC = 2; // 倒序


}