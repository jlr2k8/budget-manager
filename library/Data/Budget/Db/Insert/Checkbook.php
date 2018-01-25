<?php
/**
 * Created by Josh L. Rogers
 * Copyright (c) 2017 All Rights Reserved.
 * 12/17/2017
 *
 * Checkbook.php
 *
 * Checkbook inserting
 *
 **/

namespace Data\Budget\Db\Insert;

class Checkbook extends \Data\Budget\Db\Insert
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
            INSERT INTO item_checkbook (_item_id, transaction_date, amount, notes)
            
            VALUES(
              ?, ?, ?, ?
            );
        ';

        $bind = [
            $record['item_id'],
            $record['transaction_date'],
            $record['amount'],
            $record['notes']
        ];

        $db = new \Data\PdoMySql($sql, $bind);

        return $db->run();
    }
}