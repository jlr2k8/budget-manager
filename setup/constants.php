<?php
/**
 * Created by Josh L. Rogers.
 * Copyright (c) 2018 All Rights Reserved.
 * 2/11/2018
 *
 * constants.php
 *
 * Configuration and database constants (included within init.php)
 *
 */

define('CURRENT_MONTH', date('Y-m-d', strtotime('first day of this month')));
define('LAST_MONTH', date('Y-m-d', strtotime('first day of previous month')));
define('ZERO_AMOUNT', '0.00');

// MySQL
define ('MYSQL_SERVER', $_SERVER['MYSQL_SERVER']);
define ('MYSQL_PORT', $_SERVER['MYSQL_PORT']);
define ('MYSQL_USER', $_SERVER['MYSQL_USER']);
define ('MYSQL_PASSWORD', $_SERVER['MYSQL_PASSWORD']);
define ('MYSQL_DB', $_SERVER['MYSQL_DB']);

// Smarty
define ('ENABLE_SMARTY_CACHE', false);
define ('SMARTY_CACHE_DIR', null);

// Development and debugging
define ('DEBUG_MODE', (isset($_COOKIE['debug']) && $_COOKIE['debug'] == '1'));

// Session
if (!isset($_SESSION['report_month']))
    $_SESSION['report_month'] = CURRENT_MONTH;

// Projection rollover
define('ROLLOVER_PROJECTIONS_ON_NEW_MONTH_LOAD', true);

// Nav previous month select range
define('PREVIOUS_MONTH_SELECT_RANGE', 4);