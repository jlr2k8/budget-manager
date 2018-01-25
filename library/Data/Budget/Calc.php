<?php
/**
 * Created by Josh L. Rogers
 * Copyright (c) 2017 All Rights Reserved.
 * 12/17/2017
 *
 * Calc.php
 *
 * Caculate incomes, expenses etc by year/month
 *
 **/

namespace Data\Budget;

class Calc
{
    public $report_query_base_sql, $base_join_sql;
    public $table;
    public $date_field;
    public $date_field_format;

    public function __construct()
    {
    }


    /**
     * @param $month_of (Y-m-d)
     * @param $equity_type
     * @param $category
     * @return array|bool
     */
    protected function getAmount($month_of, $equity_type = false, $category = false, $item_record_id = false)
    {
        $this->generateBaseJoin();

        $sql = $this->base_join_sql . '
            WHERE 1=1
            AND YEAR(' . $this->date_field . ') = YEAR(?)
            AND MONTH(' . $this->date_field . ') = MONTH(?)
        ';

        $bind = [
            date($this->date_field_format, strtotime($month_of)),
            date($this->date_field_format, strtotime($month_of)),
        ];

        if (!empty($category)) {

            $sql .= '
                AND c.__id = ?
            ';

            $bind[] = \Data\Budget\Utilities\Category::getCategoryIdByLabel($category);
        }

        if (!empty($equity_type)) {

            $sql .= '
                AND c.equity_type = ?
            ';

            $bind[] = $equity_type;
        }

        if (!empty($item_record_id)) {

            $sql .= '
                AND tt._item_id = ?
            ';

            $bind[] = $item_record_id;
        }

        $db = new \Data\PdoMySql($sql, $bind);

        $result = $db->fetch();

        return empty($result) ? '0.00' : $result;
    }


    /**
     * @return string
     */
    public function getIncomeMinusExpenses($income, $expense)
    {
        return $income-$expense;
    }


    /**
     * @param string $projected
     * @param string $actual
     * @param string $equity_type
     * @return string
     */
    public function getRemaining($projected = '0.00', $actual = '0.00', $equity_type = 'income')
    {
        $remaining = $projected-$actual;

        if ($equity_type == 'income')
            return -$remaining;
        else
            return $remaining;
    }


    /**
     * @param bool $equity_type
     * @param bool $category
     * @return string
     */
    public function getRollOver($equity_type = false, $category = false)
    {
        $date       = date('Y-m-d', strtotime($_SESSION['report_month']));
        $last_month = date('Y-m-d', strtotime($date . ' first day of previous month'));

        $projection = new Calc\Projection();
        $checkbook  = new Calc\Checkbook();

        $last_month_projected   = $projection->getAmount($last_month, $equity_type, $category);
        $last_month_actual      = $checkbook->getAmount($last_month, $equity_type, $category);

        $result                 = $this->getRemaining($last_month_projected, $last_month_actual, $equity_type);

        return empty($result) ? '0.00' : $result;
    }


    /**
     * @param $table
     * @return bool
     */
    protected function generateBaseJoin($table = false)
    {
        $table = !empty($table) ? $table : $this->table;

        $this->base_join_sql = '
            SELECT SUM(amount) AS summed_amount
            FROM ' . $table . ' AS tt
            INNER JOIN item AS i ON i.__id = tt._item_id
            INNER JOIN category AS c ON c.__id = i._category_id
        ';

        return true;
    }


    /**
     * @param $month_of
     * @param $equity_type
     * @param $category
     * @param $item_record_id
     * @return array|bool
     */
    protected function getReport($month_of, $equity_type = false, $category = false, $item_record_id = false )
    {
        $sql = $this->report_query_base_sql . '
            WHERE 1=1
            AND YEAR(' . $this->date_field . ') = YEAR(?)
            AND MONTH(' . $this->date_field . ') = MONTH(?)
        ';

        $bind = [
            date($this->date_field_format, strtotime($month_of)),
            date($this->date_field_format, strtotime($month_of)),
        ];

        if (!empty($equity_type)) {

            $sql .= '
                AND c.equity_type = ?
            ';

            $bind[] = $equity_type;
        }

        if (!empty($category)) {

            $sql .= '
                AND c.__id = ?
            ';

            $bind[] = \Data\Budget\Utilities\Category::getCategoryIdByLabel($category);
        }

        if (!empty($item_record_id)) {

            $sql .= '
                AND ' . $this->table_alias . '.__id = ?
            ';

            $bind[] = $item_record_id;
        }

        $sql .= 'ORDER BY ' . $this->date_field . ' ASC';

        $db = new \Data\PdoMySql($sql, $bind);

        return $db->fetchAllAssoc();
    }
}