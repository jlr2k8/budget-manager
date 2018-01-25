<?php
/**
 * Created by Josh L. Rogers
 * Copyright (c) 2017 All Rights Reserved.
 * 12/17/2017
 *
 * Delete.php
 *
 * Delete items from budget
 *
 **/

namespace Data\Budget\Db;

class Delete extends \Data\Budget\Db
{
    public $table;

    public function __construct()
    {
    }


    /**
     * Invoke from a child class
     *
     * @param $id
     * @return bool|string
     */
    protected function itemRecord($id)
    {
        $id     = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        $sql    = '
            DELETE FROM ' . $this->table . ' WHERE __id = ?;
        ';

        $db = new \Data\PdoMySql($sql, [$id]);

        return (int)$db->run();
    }
}