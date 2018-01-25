<?php
/**
 * Created by Josh L. Rogers
 * Copyright (c) 2017 All Rights Reserved.
 * 12/17/2017
 *
 * Checkbook.php
 *
 * Checkbook updating
 *
 **/

namespace Data\Budget\Db\Update;

class Checkbook extends \Data\Budget\Db\Update
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
            UPDATE item_checkbook
            SET
              _item_id = ?,
              transaction_date = ?,
              amount = ?,
              notes = ?
            WHERE
              __id = ?;
        ';

        $bind = [
            $record['item_id'],
            $record['transaction_date'],
            $record['amount'],
            $record['notes'],
            $record['id'],
        ];

        $db = new \Data\PdoMySql($sql, $bind);

        return $db->run();
    }
}