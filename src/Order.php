<?php

/**
 *
 * File:  Order.php
 * Author: Skiychan <dev@skiy.net>
 * Created: 2019/01/19
 */

declare(strict_types=1);

namespace Skiy\Payment;

class Order
{
    public $prefix = '';
    public $number = '';

    public function __construct()
    {
    }

    /**
     * 订单号前缀 - 填充
     * @param string $pre 前缀
     * @param string $fill 填充内容
     * @param int $length 长度
     * @param int $pos 方向 0左侧, 1右侧, 其它双向
     */
    public function setPrefix(string $pre, string $fill = '0', int $length = 1, int $pos = 1)
    {
        if (strlen($pre) >= $length) {
            $this->prefix = $pre;
            return;
        }

        switch ($pos) {
            case 1:
                $this->prefix = str_pad($pre, $length, $fill, STR_PAD_RIGHT);
                break;

            case 0:
                $this->prefix = str_pad($pre, $length, $fill, STR_PAD_LEFT);
                break;

            default:
                $this->prefix = str_pad($pre, $length, $fill, STR_PAD_BOTH);
        }
    }

    /**
     * 生成订单号
     * @param int $length 订单长度
     * @param int $random_len 随机数长度
     */
    public function makeNumber(int $length = 32, int $random_len = 5)
    {
        $str_length = strlen($this->prefix) + $random_len;
        $excess_length = $length - $str_length;

        $fill_str = '';
        if ($excess_length >= 14) {
            $fill_str = str_pad(date('YmdHis'), $excess_length, '0', STR_PAD_LEFT);
        } else if ($excess_length > 12) {
            $fill_str = str_pad(date('ymdHis'), $excess_length, '0', STR_PAD_LEFT);
        } else if ($excess_length > 10) {
            $fill_str = str_pad(date('ymdHi'), $excess_length, '0', STR_PAD_LEFT);
        } else if ($excess_length > 8) {
            $fill_str = str_pad(date('Ymd'), $excess_length, '0', STR_PAD_LEFT);
        } else if ($excess_length > 6) {
            $fill_str = str_pad(date('ymd'), $excess_length, '0', STR_PAD_LEFT);
        } else {
            $random_len += $excess_length;
        }

        $this->number = $this->prefix . $fill_str . Common::randomString('alnum', $random_len);
    }
}