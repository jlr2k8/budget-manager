<?php
/**
 * Created by Josh L. Rogers
 * Copyright (c) 2017 All Rights Reserved.
 * 12/17/2017
 *
 * projection_submit.php
 *
 **/

require_once $_SERVER['WEB_ROOT'] . '/setup/init.php';

$submit_type                    = !empty($_GET['submission']) ? (string)filter_var($_GET['submission'], FILTER_SANITIZE_STRING) : 'new';

$record['category']             = !empty($_POST['category']) ? (string)filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT) : false;
$record['budget_month']         = !empty($_POST['budget_month']) ? date('Y-m-d', strtotime($_POST['budget_month'])) : date('Y-m-d');
$record['item']                 = !empty($_POST['item']) ? filter_var($_POST['item'], FILTER_SANITIZE_STRING) : false;
$record['amount']               = !empty($_POST['amount']) ? filter_var($_POST['amount'], FILTER_SANITIZE_STRING) : false;
$record['notes']                = !empty($_POST['notes']) ? filter_var($_POST['notes'], FILTER_SANITIZE_STRING) : null;
$record['id']                   = !empty($_GET['id']) ? filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT) : null;

$record['item_id']              = \Data\Budget\Utilities\Item::getItemIdFromItem($record['item']);


if ($submit_type == 'new') {

    $insert = new \Data\Budget\Db\Insert\Projection();

    try {

        $insert->item($record);
        header('Location: /index.html');

    } catch (\Exception $e) {

        throw $e;
    }
}


if ($submit_type == 'edit') {

    $update = new \Data\Budget\Db\Update\Projection();

    try {

        $update->item($record);
        header('Location: /index.html');

    } catch (\Exception $e) {

        throw $e;
    }

}


if ($submit_type == 'delete') {

    $delete = new \Data\Budget\Db\Delete\Projection();

    try {

        $delete->item($record['id']);
        header('Location: /index.html');

    } catch (\Exception $e) {

        throw $e;
    }
}