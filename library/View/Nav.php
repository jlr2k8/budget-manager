<?php
/**
 * Created by Josh L. Rogers
 * Copyright (c) 2017 All Rights Reserved.
 * 12/17/2017
 *
 * Nav.php
 *
 * Nav bar
 *
 **/

namespace View;

class Nav
{
    public function __construct()
    {
    }


    /**
     * @param SmartyLoader $smarty
     * @return string
     */
    public static function show(\View\SmartyLoader $smarty)
    {
        $smarty->assign('date_select', (new \View\Nav\DateSelect)->show((new \Data\Nav\DateSelect)));

        return $smarty->fetch('common/nav.tpl');
    }
}