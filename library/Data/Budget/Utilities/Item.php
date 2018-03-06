<?php
/**
 * Created by Josh L. Rogers
 * Copyright (c) 2018 All Rights Reserved.
 * 3/5/2018
 *
 * Item.php
 *
 **/


namespace Data\Budget\Utilities;

class Item
{
    public $table;

    public function __construct()
    {
    }


    /**
     * @param $id
     * @return array|bool
     */
    public function getItemIdFromId($id)
    {
        $sql = '
            SELECT _item_id AS item_id FROM ' . $this->table . ' item WHERE __id = ?;
        ';

        $db = new \Data\PdoMySql($sql, [$id]);

        return $db->fetch();
    }
}