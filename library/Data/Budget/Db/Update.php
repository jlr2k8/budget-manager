<?php
/**
 * Created by Josh L. Rogers
 * Copyright (c) 2017 All Rights Reserved.
 * 12/17/2017
 *
 * Update.php
 *
 * Update budget items
 *
 **/

namespace Data\Budget\Db;

class Update extends \Data\Budget\Db
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
        $update['category']             = !empty($record['category']) ? filter_var($record['category'], FILTER_SANITIZE_NUMBER_FLOAT) : false;
        $update['item']                 = !empty($record['item']) ? $record['item'] : false;
        $update['id']                   = !empty($record['id']) ? $record['id'] : false;
        $update['transaction_date']     = !empty($record['transaction_date']) ? \View\Formatting\MySql::DbDate($record['transaction_date']) : date('Y-m-d');
        $update['budget_month']         = !empty($record['budget_month']) ? \View\Formatting\MySql::DbDate($record['budget_month']) : date('Y-m-d');
        $update['amount']               = !empty($record['amount']) ? filter_var($record['amount'], FILTER_SANITIZE_STRING) : false;
        $update['notes']                = !empty($record['notes']) ? filter_var($record['notes'], FILTER_SANITIZE_STRING) : null;

        $update = parent::validate($update);

        $sql = '
            UPDATE item SET
              _category_id = ?,
              item = ?
            WHERE __id = ?
        ';

        $bind = [
            $update['category'],
            $update['item'],
            $record['item_id'],
        ];

        $db                 = new \Data\PdoMySql($sql, $bind);
        $update['item_id']  = $record['item_id'];

        if ($db->run()) {

            return $this->itemRecord($update);
        }

        return false;
    }


    /**
     * @param $item
     * @return array|bool
     */
    private static function getUpdateIdByItem($item)
    {
        $sql = '
            SELECT __id AS id FROM item WHERE item = ?
        ';

        $bind[] = $item;

        $db = new \Data\PdoMySql($sql, $bind);

        return $db->fetch();
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