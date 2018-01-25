<?php
/**
 * Created by Josh L. Rogers
 * Copyright (c) 2017 All Rights Reserved.
 * 12/17/2017
 *
 * IncomeExpenseTable.php
 *
 *
 **/


namespace View\Budget;

class IncomeExpenseTable
{
    public function __construct()
    {
    }


    /**
     * @param \View\SmartyLoader $smarty
     * @return string
     * @throws \Exception
     * @throws \SmartyException
     */
    public static function show(\View\SmartyLoader $smarty)
    {
        $calc           = new \Data\Budget\Calc();
        $projection     = new \Data\Budget\Calc\Projection();
        $checkbook      = new \Data\Budget\Calc\Checkbook();

        $formatted_income       = self::showEquityGroup('income', $projection, $checkbook, $calc);
        $formatted_expense      = self::showEquityGroup('expense', $projection, $checkbook, $calc);

        $smarty->assign('income', $formatted_income);
        $smarty->assign('expense', $formatted_expense);


        $total_income['projected_amount']   = $projection->getProjection($_SESSION['report_month'], 'income');
        $total_income['actual_amount']      = $checkbook->getCheckbook($_SESSION['report_month'], 'income');
        $total_income['rollover_amount']    = $calc->getRollOver('income');
        $total_income['remaining_amount']   = ($total_income['rollover_amount']+$calc->getRemaining($total_income['projected_amount'], $total_income['actual_amount'], 'income'));

        foreach($total_income as $key => $val)
            $total_income[$key . '_formatted'] = \View\Formatting\Currency::dollarCents($val, true);

        $total_expenses['projected_amount'] = $projection->getProjection($_SESSION['report_month'], 'expense');
        $total_expenses['actual_amount']    = $checkbook->getCheckbook($_SESSION['report_month'], 'expense');
        $total_expenses['rollover_amount']  = $calc->getRollOver('expense');
        $total_expenses['remaining_amount'] = ($total_expenses['rollover_amount']+$calc->getRemaining($total_expenses['projected_amount'], $total_expenses['actual_amount'], 'expense'));

        foreach($total_expenses as $key => $val)
            $total_expenses[$key . '_formatted'] = \View\Formatting\Currency::dollarCents($val, true);

        $grand_total['projected_grand_total']   = $calc->getIncomeMinusExpenses($total_income['projected_amount'], $total_expenses['projected_amount']);
        $grand_total['actual_grand_total']      = $calc->getIncomeMinusExpenses($total_income['actual_amount'], $total_expenses['actual_amount']);
        $grand_total['rollover_amount']         = ($calc->getRollOver('income')+$calc->getRollOver('expense'));
        $grand_total['remaining_amount']        = ($grand_total['rollover_amount']+$calc->getRemaining($grand_total['projected_grand_total'], $grand_total['actual_grand_total']));

        foreach($grand_total as $key => $val)
            $grand_total[$key . '_formatted'] = \View\Formatting\Currency::dollarCents($val, true);

        // TODO - gte operator not working within template for the *_amount (typecasting?), so doing the check here in PHP then passing that into the template...
        $total_income['remaining_amount_is_positive']   = ($total_income['remaining_amount'] >= (int)0);
        $total_expenses['remaining_amount_is_positive'] = ($total_expenses['remaining_amount'] >= (int)0);

        $grand_total['projected_grand_total_is_positive']   = ($grand_total['projected_grand_total'] >= (int)0);
        $grand_total['actual_grand_total_is_positive']      = ($grand_total['actual_grand_total'] >= (int)0);
        $grand_total['rollover_amount_is_positive']         = ($grand_total['rollover_amount'] >= (int)0);
        $grand_total['remaining_amount_is_positive']        = ($grand_total['remaining_amount'] >= (int)0);

        $smarty->assign('total_income', $total_income);
        $smarty->assign('total_expenses', $total_expenses);
        $smarty->assign('grand_total', $grand_total);

        return $smarty->fetch('totals/monthly.tpl');
    }


    /**
     * @param $equity_type
     * @param \Data\Budget\Calc\Projection $projection
     * @param \Data\Budget\Calc\Checkbook $checkbook
     * @return array
     */
    private static function showEquityGroup($equity_type, \Data\Budget\Calc\Projection $projection, \Data\Budget\Calc\Checkbook $checkbook, \Data\Budget\Calc $calc)
    {
        $categories = \Data\Budget\Utilities\Category::getCategories($equity_type);
        $formatted  = $formatted_row = [];

        foreach ($categories as $category) {

            $projection_amount    = $projection->getProjection($_SESSION['report_month'], $equity_type, $category['category_label']);
            $checkbook_amount     = $checkbook->getCheckbook($_SESSION['report_month'], $equity_type, $category['category_label']);
            $rollover_amount      = $calc->getRollOver($equity_type, $category['category_label']);
            $remaining_amount     = ($rollover_amount+$calc->getRemaining($projection_amount, $checkbook_amount, $equity_type));

            $formatted['equity_type_url']               = \View\Formatting\Url::transform($equity_type);
            $formatted['category_url']                  = \View\Formatting\Url::transform($category['category_label']);
            $formatted['category_label']                = $category['category_label'];
            $formatted['projection_amount_formatted']   = \View\Formatting\Currency::dollarCents($projection_amount, true);
            $formatted['actual_amount_formatted']       = \View\Formatting\Currency::dollarCents($checkbook_amount, true);
            $formatted['rollover_amount_formatted']     = \View\Formatting\Currency::dollarCents($rollover_amount, true);
            $formatted['remaining_amount_formatted']    = \View\Formatting\Currency::dollarCents($remaining_amount, true);
            $formatted['remaining_amount_is_positive']  = ((int)$remaining_amount >= (int)0); // TODO - gte operator not working within template for above assignment (typecasting?)

            $formatted_row[] = $formatted;
        }

        return $formatted_row;
    }
}