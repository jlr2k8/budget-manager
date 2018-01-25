<?php
/**
 * Created by Josh L. Rogers
 * Copyright (c) 2017 All Rights Reserved.
 * 12/17/2017
 *
 * index.php
 *
 * Projections controller
 *
 */

require_once $_SERVER['WEB_ROOT'] . '/setup/init.php';

$equity_type    = !empty($_GET['equity_type']) ? filter_var($_GET['equity_type'], FILTER_SANITIZE_STRING) : false;
$category_url   = !empty($_GET['category']) ? filter_var($_GET['category'], FILTER_SANITIZE_STRING) : false;
$item_record_id = !empty($_GET['item_record_id']) ? filter_var($_GET['item_record_id'], FILTER_SANITIZE_NUMBER_INT) : false;

$projection = new \Data\Budget\Calc\Projection();
$smarty     = new \View\SmartyLoader();
$category   = \Data\Budget\Utilities\Category::getCategoryLabelByUrl($category_url);

$report             = $projection->getReport($_SESSION['report_month'], $equity_type, $category, $item_record_id);
$projection_report  = \View\Budget\Projections::show($smarty, $report);

$projected_income   = $projection->getProjection($_SESSION['report_month'], 'income');
$projected_expenses = $projection->getProjection($_SESSION['report_month'], 'expense');
$remaining          = $projection->getIncomeMinusExpenses($projected_income, $projected_expenses);

$smarty->assign('transactions', $projection_report);
$smarty->assign('projected_income', \View\Formatting\Currency::dollarCents($projected_income));
$smarty->assign('projected_expenses', \View\Formatting\Currency::dollarCents($projected_expenses));
$smarty->assign('difference', \View\Formatting\Currency::dollarCents($remaining));

if ($equity_type && $category && $item_record_id) {

    ob_start();

    $smarty->assign('date_field', $projection->date_field);

    require_once $_SERVER['WEB_ROOT'] . '/include/edit_transaction.php';

    $main = ob_get_clean();

} else {

    $main = $smarty->fetch('projections.tpl');
}


$find_replace = [
    'page_title'    => 'Projections for ' . date('F, Y', strtotime($_SESSION['report_month'])),
    'main'          => $main,
];

echo \View\SmartyLoader::displayPage($smarty, $find_replace);