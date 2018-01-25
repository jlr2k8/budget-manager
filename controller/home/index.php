<?php
/**
 * Created by Josh L. Rogers
 * Copyright (c) 2017 All Rights Reserved.
 * 12/17/2017
 *
 * index.php
 *
 * Show totals and checkbook form
 *
 **/

require_once $_SERVER['WEB_ROOT'] . '/setup/init.php';

$smarty     = new \View\SmartyLoader();
$checkbook  = new \Data\Budget\Calc\Checkbook();

$smarty->assign('monthly', \View\Budget\IncomeExpenseTable::show($smarty));
$smarty->assign('checkbook', \View\Budget\Checkbook::show($smarty));

$main = $smarty->fetch('home.tpl');

$find_replace = [
    'page_title'    => 'Monthly Budget - ' . date('F, Y', strtotime($_SESSION['report_month'])),
    'main'          => $main,
];

echo \View\SmartyLoader::displayPage($smarty, $find_replace);