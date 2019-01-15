<?php

/**
 *
 * File:  Pay.php
 * Author: Skiychan <dev@skiy.net>
 * Created: 2018/12/21
 */

declare(strict_types=1);

namespace Payment;

class Pay
{
    public $options = [];

    public function __construct(array $options = [])
    {
        $this->options = $options;
    }
}