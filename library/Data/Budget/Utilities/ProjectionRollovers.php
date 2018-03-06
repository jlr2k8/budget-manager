<?php
/**
 * Created by Josh L. Rogers.
 * Copyright (c) 2018 All Rights Reserved.
 * 2/11/2018
 *
 * ProjectionRollovers.php
 *
 * Check and roll over projections from last month, if empty
 *
 */

namespace Data\Budget\Utilities;

class ProjectionRollovers
{
    public $projection;

    public function __construct()
    {
        $this->projection = new \Data\Budget\Calc\Projection();
    }


    /**
     * @return bool
     */
    private function currentMonthIsNotProjected()
    {
        $projected_income   = $this->projection->getProjection(CURRENT_MONTH, 'income');
        $projected_expenses = $this->projection->getProjection(CURRENT_MONTH, 'expense');

        return ($projected_income == '0.00' && $projected_expenses == '0.00');
    }


    /**
     *
     */
    private function copyLastMonthToCurrentMonth()
    {
        $sql = '
              INSERT INTO item_projection (_item_id, budget_month, amount, notes)
                SELECT _item_id, ?, amount, notes
                FROM item_projection
                WHERE YEAR(budget_month) = YEAR(?)
                AND MONTH(budget_month) = MONTH(?)
        ';

        $bind = [
            date($this->projection->date_field_format, strtotime(CURRENT_MONTH)),
            date($this->projection->date_field_format, strtotime(LAST_MONTH)),
            date($this->projection->date_field_format, strtotime(LAST_MONTH)),
        ];

        $db = new \Data\PdoMySql($sql, $bind);

        return $db->run();
    }


    /**
     * @return bool
     */
    public static function handle()
    {
        $projection_rollovers           = new self();
        $current_month_is_not_projected = $projection_rollovers->currentMonthIsNotProjected();

        $result = false;

        if ($current_month_is_not_projected && ROLLOVER_PROJECTIONS_ON_NEW_MONTH_LOAD)
            $result = $projection_rollovers->copyLastMonthToCurrentMonth();

        return $result;
    }
}