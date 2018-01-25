<?php
/**
 * Created by Josh L. Rogers
 * Copyright (c) 2017 All Rights Reserved.
 * 12/17/2017
 *
 * Url.php
 *
 *
 *
 **/

namespace View\Formatting;

class Url
{
    public function __construct()
    {
    }


    /**
     * @param $str
     * @return bool|string
     */
    public static function transform($str)
    {
        $str = trim($str);
        $str = preg_replace('~([^a-zA-Z0-9 ]+)~', ' ', $str);
        $str = preg_replace('~(\s)+~', '-', $str);
        $str = preg_replace('~-+~', '-', $str);
        $str = preg_replace('~\+~', '-', $str);
        $str = trim($str, '-');

        return strtolower($str);
    }
}