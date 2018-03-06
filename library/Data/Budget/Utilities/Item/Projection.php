<?php
/**
 * Created by Josh L. Rogers
 * Copyright (c) 2018 All Rights Reserved.
 * 3/5/2018
 *
 * Projection.php
 *
 **/

namespace Data\Budget\Utilities\Item;

class Projection extends \Data\Budget\Utilities\Item
{
    public $table = 'item_projection';

    public function __construct()
    {
    }

    public function getItemIdFromId($id)
    {
        return parent::getItemIdFromId($id);
    }
}