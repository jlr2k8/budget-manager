<?php
/**
 * Created by Josh L. Rogers
 * Copyright (c) 2017 All Rights Reserved.
 * 12/17/2017
 *
 * Projection.php
 *
 * Projection inserting
 *
 **/

namespace Data\Budget\Db\Insert;

class Projection extends \Data\Budget\Db\Insert
{
    public function __construct()
    {
    }


    /**
     * @param array $record
     * @return bool|string
     * @throws \Exception
     */
    public function item(array $record)
    {
        return parent::item($record);
    }


    /**
     * @param array $record
     * @return bool
     */
    protected function itemRecord(array $record)
    {
        $sql = '
            INSERT INTO item_projection (_item_id, budget_month, amount, notes)
            
            VALUES(
              ?, ?, ?, ?
            );
        ';

        $bind = [
            $record['item_id'],
            $record['budget_month'],
            $record['amount'],
            $record['notes']
        ];

        $db = new \Data\PdoMySql($sql, $bind);

        return $db->run();
    }
}