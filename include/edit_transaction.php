<?php
/**
 * Created by Josh L. Rogers
 * Copyright (c) 2018 All Rights Reserved.
 * 12/17/2017
 *
 * edit_transaction.php
 *
 * Simple PHP form partial for editing checkbook and projection transactions
 *
 */

require_once $_SERVER['WEB_ROOT'] . '/setup/init.php';

$smarty->assign('transactions', $report);
$smarty->assign('submit_type', 'edit');

echo $smarty->fetch('transactions/edit.tpl');