<?php
/**
 * Created by Josh L. Rogers
 * Copyright (c) 2017 All Rights Reserved.
 * 12/17/2017
 *
 * init.php
 *
 * Core configuration for application
 *
 **/

require $_SERVER['WEB_ROOT'] . '/library/Autoload.php';

session_name('budget_manager_sess');
session_start();

// MySQL
define ('MYSQL_SERVER', 'shaw-dev.lan');
define ('MYSQL_PORT', '3306');
define ('MYSQL_USER', 'bm_user');
define ('MYSQL_PASSWORD', '3V3rY$$c0UnT5');
define ('MYSQL_DB', 'budget_manager');

// Smarty
define ('ENABLE_SMARTY_CACHE', false);
define ('SMARTY_CACHE_DIR', null);

// Development and debugging
define ('DEBUG_MODE', (isset($_COOKIE['debug']) && $_COOKIE['debug'] == '1'));

// Session
if (!isset($_SESSION['report_month']))
    $_SESSION['report_month'] = date('Y-m-d', strtotime('first day of this month'));