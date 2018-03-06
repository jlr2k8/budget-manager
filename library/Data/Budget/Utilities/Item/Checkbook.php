<?php
/**
 * Created by Josh L. Rogers
 * Copyright (c) 2018 All Rights Reserved.
 * 3/5/2018
 *
 * Checkbook.php
 *
 **/

namespace Data\Budget\Utilities\Item;

class Checkbook extends \Data\Budget\Utilities\Item
{
    public $table = 'item_checkbook';

    public function __construct()
    {
    }

    public function getItemIdFromId($id)
    {
        return parent::getItemIdFromId($id);
    }
}