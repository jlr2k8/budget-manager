<?php
/**
 * Created by Josh L. Rogers
 * Copyright (c) 2017 All Rights Reserved.
 * 12/17/2017
 *
 * Projections.php
 *
 *
 **/

namespace View\Budget;

class Projections
{
    public function __construct()
    {
    }


    /**
     * @param \View\SmartyLoader $smarty
     * @param array $report
     * @return string
     */
    public static function show(\View\SmartyLoader $smarty, $report = array())
    {
        if (empty($report)) {

            $projection  = new \Data\Budget\Calc\Projection();
            $report      = $projection->getReport($_SESSION['report_month']);
        }

        $projection_transactions = $report;
        $formatted_row          = [];

        foreach ($projection_transactions as $key => $val) {

            $formatted['id']                            = $val['id'];
            $formatted['category_label']                = $val['category_label'];
            $formatted['category_id']                   = !empty($val['category_id']) ? (int)$val['category_id'] : null;
            $formatted['date_formatted']                = !empty($val['budget_month']) ? date('F d, Y', strtotime($val['budget_month'])) : null;
            $formatted['item']                          = $val['item'];
            $formatted['amount_formatted']              = \View\Formatting\Currency::dollarCents($val['amount']);
            $formatted['notes']                         = $val['notes'];
            $formatted['show_edit']                     = true;
            $formatted['show_delete']                   = true;
            $formatted['equity_type_url']               = \View\Formatting\Url::transform($val['equity_type']);
            $formatted['category_url']                  = \View\Formatting\Url::transform($val['category_label']);

            $category_id = \Data\Budget\Utilities\Category::getCategoryIdByLabel($val['category_label']);
            $smarty->assign('select_options', Categories::selectOptions($smarty, $category_id));

            $formatted_row[] = $formatted;
        }

        $smarty->assign('date_field_label', 'Budget Month');
        $smarty->assign('date_field_name', 'budget_month');
        $smarty->assign('transaction_type', 'Projection');
        $smarty->assign('report_month', date('F, Y', strtotime($_SESSION['report_month'])));
        $smarty->assign('transactions', $formatted_row);
        $smarty->assign('select_options_blank', Categories::selectOptions($smarty));

        return $smarty->fetch('transactions/table_wrapper.tpl');
    }
}