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

require_once $_SERVER['WEB_ROOT'] . '/setup/constants.php';

// Initialize projection rollovers for new month (defined behavior)
\Data\Budget\Utilities\ProjectionRollovers::handle();