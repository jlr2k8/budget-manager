<?php
/**
 * Created by Josh L. Rogers
 * Copyright (c) 2017 All Rights Reserved.
 * 12/17/2017
 *
 * set_report_month.php
 *
 * Set the session based on params, redirect back to original page (if specified)
 *
 */

require_once $_SERVER['WEB_ROOT'] . '/setup/init.php';

$year   = $_GET['year'];
$month  = $_GET['month'];
$day    = '01';

$redir  = urldecode($_GET['return']);

$_SESSION['report_month'] =  date('Y-m-d', strtotime($year . '-' . $month . '-' . $day));

header('Location: ' . $redir);