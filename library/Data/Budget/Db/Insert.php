<?php
/**
 * Created by Josh L. Rogers
 * Copyright (c) 2017 All Rights Reserved.
 * 12/17/2017
 *
 * Insert.php
 *
 * Insert items into budget
 *
 **/

namespace Data\Budget\Db;

class Insert extends \Data\Budget\Db
{
    public $table;

    public function __construct()
    {
    }


    /**
     * Invoke from a child class
     *
     * @param array $record
     * @return bool|string
     * @throws \Exception
     */
    protected function item(array $record)
    {
        $insert['category']             = !empty($record['category']) ? filter_var($record['category'], FILTER_SANITIZE_NUMBER_FLOAT) : false;
        $insert['item']                 = !empty($record['item']) ? $record['item'] : false;
        $insert['transaction_date']     = !empty($record['transaction_date']) ? \View\Formatting\MySql::DbDate($record['transaction_date']) : date('Y-m-d');
        $insert['budget_month']         = !empty($record['budget_month']) ? \View\Formatting\MySql::DbDate($record['budget_month']) : date('Y-m-d');
        $insert['amount']               = !empty($record['amount']) ? filter_var($record['amount'], FILTER_SANITIZE_STRING) : false;
        $insert['notes']                = !empty($record['notes']) ? filter_var($record['notes'], FILTER_SANITIZE_STRING) : null;

        $insert = parent::validate($insert);

        $sql = '
            INSERT INTO item (_category_id, item)
            VALUES(?, ?) ON DUPLICATE KEY UPDATE __id=LAST_INSERT_ID(__id), item=item;
        ';

        $bind = [
            $insert['category'],
            $insert['item']
        ];

        $db = new \Data\PdoMySql($sql, $bind);

        if ($db->run()) {

            $insert['item_id'] = $db->con->lastInsertId();

            return $this->itemRecord($insert);
        }

        return false;
    }


    /**
     * @param array $record
     * @return bool
     */
    protected function itemRecord(array $record)
    {
        return false;
    }
}