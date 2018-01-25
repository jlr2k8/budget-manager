<?php
/**
 * Created by Josh L. Rogers
 * Copyright (c) 2017 All Rights Reserved.
 * 12/17/2017
 *
 * Dates.php
 *
 * Date formatter utility class
 *
 * -- STATIC METHODS --
 *
 **/

namespace View\Formatting;

class MySql
{
    public function __construct()
    {
    }


    /**
     * @param $date
     * @return false|string
     * @throws \Exception
     */
    public static function DbDate($date)
    {
        if (!strtotime($date))
            throw new \Exception('"' . $date . '" is an invalid date format.');

        return date('Y-m-d', strtotime($date));
    }


    /**
     * @param $time
     * @return false|string
     * @throws \Exception
     */
    public static function DbDateTime($time)
    {
        if (!strtotime($time))
            throw new \Exception('"' . $time . '" is an invalid time format.');

        return date('Y-m-d H:i:s', strtotime($time));
    }
}