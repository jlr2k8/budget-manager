<?php
/**
 * Created by Josh L. Rogers
 * Copyright (c) 2017 All Rights Reserved.
 * 12/17/2017
 *
 * Checkbook.php
 *
 * Caculate checkbook by year/month
 *
 **/

namespace Data\Budget\Calc;

class Checkbook extends \Data\Budget\Calc
{
    public $table               = 'item_checkbook';
    public $table_alias         = 'ic';
    public $date_field          = 'transaction_date';
    public $date_field_format   = 'Y-m-d';


    public function __construct()
    {
        parent::__construct();

        $this->report_query_base_sql = '
            SELECT ' . $this->table_alias . '.__id AS id, ' . $this->table_alias . '.transaction_date, ic.amount, i.item, c.label AS category_label, ' . $this->table_alias . '.notes, c.equity_type
            FROM item_checkbook AS ' . $this->table_alias . '
            INNER JOIN item AS i ON ' . $this->table_alias . '._item_id = i.__id
            INNER JOIN category AS c ON i._category_id = c.__id
        ';
    }


    /**
     * @param $month_of
     * @param $equity_type
     * @param $category
     * @return array|bool
     */
    public function getCheckbook($month_of, $equity_type, $category = false)
    {
        return parent::getAmount($month_of, $equity_type, $category);
    }


    /**
     * @param $month_of
     * @param $equity_type
     * @param $category
     * @param $item_record_id
     * @return array|bool
     */
    public function getReport($month_of, $equity_type = false, $category = false, $item_record_id = false)
    {
        return parent::getReport($month_of, $equity_type, $category, $item_record_id);
    }
}