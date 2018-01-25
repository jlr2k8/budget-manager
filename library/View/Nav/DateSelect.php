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

namespace View\Nav;

class DateSelect
{
    public function __construct()
    {
    }


    /**
     * @param \Data\Nav\DateSelect $date_select
     * @return string
     */
    public function show(\Data\Nav\DateSelect $date_select)
    {
        $dates = $date_select->getRange();

        $html[] = '
            <span class="pointer nav-link dropdown-toggle" id="month" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                ' . date('F, Y', strtotime($_SESSION['report_month'])) . '
            </span>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
        ';

        foreach ($dates as $date) {

            $date = strtotime($date);

            $html[] = '
                <a class="dropdown-item" href="/' . date('Y', $date) . '/'. strtolower(date('m', $date)) . '/?return=' . urlencode($_SERVER['REQUEST_URI']) . '">
                ' . date('F, Y', $date) . '</a>
            ';
        }

        $html[] = '</div>';

        return implode($html);
    }
}