<?php
/**
 * Created by Josh L. Rogers
 * Copyright (c) 2017 All Rights Reserved.
 * 12/17/2017
 *
 * index.php
 *
 * Checkbook controller
 *
 */

require_once $_SERVER['WEB_ROOT'] . '/setup/init.php';

$equity_type    = !empty($_GET['equity_type']) ? filter_var($_GET['equity_type'], FILTER_SANITIZE_STRING) : false;
$category_url   = !empty($_GET['category']) ? filter_var($_GET['category'], FILTER_SANITIZE_STRING) : false;
$item_record_id = !empty($_GET['item_record_id']) ? filter_var($_GET['item_record_id'], FILTER_SANITIZE_NUMBER_INT) : false;

$checkbook  = new \Data\Budget\Calc\Checkbook();
$smarty     = new \View\SmartyLoader();
$category   = \Data\Budget\Utilities\Category::getCategoryLabelByUrl($category_url);

$report             = $checkbook->getReport($_SESSION['report_month'], $equity_type, $category, $item_record_id);
$checkbook_report   = \View\Budget\Checkbook::show($smarty, $report);

$smarty->assign('transactions', $checkbook_report);

if ($equity_type && $category && $item_record_id) {

    ob_start();

    $smarty->assign('date_field', $checkbook->date_field);
    $smarty->assign('equity_type_url', \View\Formatting\Url::transform($equity_type));
    $smarty->assign('category_url', \View\Formatting\Url::transform($category));

    require_once $_SERVER['WEB_ROOT'] . '/include/edit_transaction.php';

    $main = ob_get_clean();

} else {

    $main = $smarty->fetch('checkbook.tpl');
}


$find_replace = [
    'page_title'    => 'Checkbook for ' . date('F, Y', strtotime($_SESSION['report_month'])),
    'main'          => $main,
];

echo \View\SmartyLoader::displayPage($smarty, $find_replace);