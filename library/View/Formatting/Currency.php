<?php
/**
 * Created by Josh L. Rogers
 * Copyright (c) 2017 All Rights Reserved.
 * 12/17/2017
 *
 * Currency.php
 *
 * Currency formatter utility class
 *
 * -- STATIC METHODS --
 *
 **/

namespace View\Formatting;

class Currency
{
    public function __construct()
    {
    }


    /**
     * @param $value
     * @param bool $thousands_separator
     * @return string
     */
    public static function dollarCents($value, $dollar_sign = true, $thousands_separator = false)
    {
        $thousands_separator = $thousands_separator !== false ? ',' : null;

        return ($dollar_sign ? '$' : null) . number_format($value, (int)2, '.', $thousands_separator);
    }

    public static function is_zero($value)
    {
        return (empty($value) || $value == ZERO_AMOUNT);
    }
}

