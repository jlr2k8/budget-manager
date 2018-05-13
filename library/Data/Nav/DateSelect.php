<?php
/**
 * Created by Josh L. Rogers
 * Copyright (c) 2017 All Rights Reserved.
 * 12/17/2017
 *
 * DateSelect.php
 *
 * Nav dropdown for budget report dates
 *
 **/

namespace Data\Nav;

class DateSelect
{
    public function __construct()
    {
    }


    /**
     * @param int $n
     * @return array
     */
    public function getRange($n = PREVIOUS_MONTH_SELECT_RANGE)
    {
        $dates = [];

        for ($i = 0; $i < $n; $i++)
            $dates[] = date('Y-m-d', strtotime('first day of ' . $i . ' months ago'));

        return $dates;
    }


}