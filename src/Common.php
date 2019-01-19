<?php

/**
 *
 * File:  Common.php
 * Author: Skiychan <dev@skiy.net>
 * Created: 2019/01/19
 */

declare(strict_types=1);

namespace Skiy\Payment;

class Common
{
    /**
     * 创建随机字符串
     * @param    string    type of random string.  basic, alpha, alnum, numeric, nozero, unique, md5, encrypt and sha1
     * @param    int    长度
     * @return    string
     */
    public static function randomString($type = 'alnum', $len = 8) : string
    {
        switch ($type) {
            case 'basic':
                return mt_rand();
            case 'alnum':
            case 'numeric':
            case 'nozero':
            case 'alpha':
            case 'hex':
                switch ($type) {
                    case 'alpha':
                        $pool = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        break;
                    case 'alnum':
                        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        break;
                    case 'numeric':
                        $pool = '0123456789';
                        break;
                    case 'nozero':
                        $pool = '123456789';
                        break;
                    case 'hex':
                        $pool = '0123456789abcdefABCDEF';
                        break;
                }
                $ceil = (string)ceil($len / strlen($pool));
                return substr(str_shuffle(str_repeat($pool, $ceil)), 0, $len);
            case 'unique': // todo: remove in 3.1+
            case 'md5':
                return md5(uniqid(mt_rand()));
            case 'encrypt': // todo: remove in 3.1+
            case 'sha1':
                return sha1(uniqid(mt_rand(), true));
        }
    }
}