<?php
/**
 * Created by Josh L. Rogers
 * Copyright (c) 2017 All Rights Reserved.
 * 12/17/2017
 *
 * Checkbook.php
 *
 *
 **/

namespace View\Budget;

class Checkbook
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

            $checkbook  = new \Data\Budget\Calc\Checkbook();
            $report     = $checkbook->getReport($_SESSION['report_month']);
        }

        $checkbook_transactions = $report;
        $formatted_row          = [];

        foreach ($checkbook_transactions as $key => $val) {

            $formatted['id']                            = $val['id'];
            $formatted['equity_type_url']               = \View\Formatting\Url::transform($val['equity_type']);
            $formatted['category_label']                = !empty($val['category_label']) ? (string)$val['category_label'] : null;
            $formatted['category_url']                  = \View\Formatting\Url::transform($val['category_label']);
            $formatted['date_formatted']                = !empty($val['transaction_date']) ? date('F d, Y', strtotime($val['transaction_date'])) : null;
            $formatted['item']                          = $val['item'];
            $formatted['amount_formatted']              = \View\Formatting\Currency::dollarCents($val['amount']);
            $formatted['notes']                         = $val['notes'];
            $formatted['show_edit']                     = true;
            $formatted['show_delete']                   = true;

            $category_id = \Data\Budget\Utilities\Category::getCategoryIdByLabel($val['category_label']);
            $smarty->assign('select_options', Categories::selectOptions($smarty, $category_id));

            $formatted_row[] = $formatted;
        }

        $smarty->assign('date_field_label', 'Transaction Date');
        $smarty->assign('date_field_name', 'transaction_date');
        $smarty->assign('transaction_type', 'Checkbook');
        $smarty->assign('report_month', date('F, Y', strtotime($_SESSION['report_month'])));
        $smarty->assign('transactions', $formatted_row);
        $smarty->assign('select_options_blank', Categories::selectOptions($smarty));

        return $smarty->fetch('transactions/table_wrapper.tpl');
    }
}