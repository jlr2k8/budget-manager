{$is_grand_total = false}
<table class="table table-striped table-bordered table-responsive">
    <thead>
        <tr>
            <th class="text-center" colspan="5">Income</th>
        </tr>
        <tr>
            <th>Category</th>
            <th>Projected</th>
            <th>Actual</th>
            <th>Rolled Over</th>
            <th>Remaining</th>
        </tr>
    </thead>
    <tbody>
        {foreach from=$income item=row}
            {$row_class = ''}
            {$equity_type_url = $row.equity_type_url}
            {$category_url = $row.category_url}
            {$category_label = $row.category_label}
            {$projection_amount_formatted = $row.projection_amount_formatted}
            {$actual_amount_formatted = $row.actual_amount_formatted}
            {$rollover_amount_formatted = $row.rollover_amount_formatted}
            {$remaining_amount_formatted = $row.remaining_amount_formatted}
            {$remaining_amount_is_positive = $row.remaining_amount_is_positive}

            {include file='totals/monthly/category_row.tpl'}
        {/foreach}

        {$row_class = 'font-weight-bold'}
        {$equity_type_url = 'income'}
        {$category_url = ''}
        {$category_label = 'Totals'}
        {$projection_amountS_formatted = $total_income.projected_amount_formatted}
        {$actual_amount_formatted = $total_income.actual_amount_formatted}
        {$rollover_amount_formatted = $total_income.rollover_amount_formatted}
        {$remaining_amount_formatted = $total_income.remaining_amount_formatted}
        {$remaining_amount_is_positive = $total_income.remaining_amount_is_positive}
        {include file='totals/monthly/category_row.tpl'}
    </tbody>
    <thead>
        <tr>
            <th class="text-center" colspan="5">Expenses</th>
        </tr>
        <tr>
            <th>Category</th>
            <th>Projected</th>
            <th>Actual</th>
            <th>Rolled Over</th>
            <th>Remaining</th>
        </tr>
    </thead>
    <tbody>
        {foreach from=$expense item=row}
            {$row_class = ''}
            {$equity_type_url = $row.equity_type_url}
            {$category_url = $row.category_url}
            {$category_label = $row.category_label}
            {$projection_amount_formatted = $row.projection_amount_formatted}
            {$actual_amount_formatted = $row.actual_amount_formatted}
            {$rollover_amount_formatted = $row.rollover_amount_formatted}
            {$remaining_amount_formatted = $row.remaining_amount_formatted}
            {$remaining_amount_is_positive = $row.remaining_amount_is_positive}

            {include file='totals/monthly/category_row.tpl'}
        {/foreach}

        {$row_class = 'font-weight-bold'}
        {$equity_type_url = 'expense'}
        {$category_url = ''}
        {$category_label = 'Totals'}
        {$projection_amount_formatted = $total_expenses.projected_amount_formatted}
        {$actual_amount_formatted = $total_expenses.actual_amount_formatted}
        {$rollover_amount_formatted = $total_expenses.rollover_amount_formatted}
        {$remaining_amount_formatted = $total_expenses.remaining_amount_formatted}
        {$remaining_amount_is_positive = $total_expenses.remaining_amount_is_positive}
        {include file='totals/monthly/category_row.tpl'}
    </tbody>
    <thead>
        <tr>
            <th class="text-center" colspan="5">Total (Income - Expenses)</th>
        </tr>
        <tr>
            <th>&#160;</th>
            <th>Projected</th>
            <th>Actual</th>
            <th>Rolled Over</th>
            <th>Remaining</th>
        </tr>
        {$row_class = 'font-weight-bold'}
        {$equity_type_url = ''}
        {$category_url = ''}
        {$category_label = 'Totals'}
        {$projection_amount_formatted = $grand_total.projected_grand_total_formatted}
        {$actual_amount_formatted = $grand_total.actual_grand_total_formatted}
        {$rollover_amount_formatted = $grand_total.rollover_amount_formatted}
        {$remaining_amount_formatted = $grand_total.remaining_amount_formatted}
        {$projected_amount_is_positive = $grand_total.projected_grand_total_is_positive}
        {$actual_amount_is_positive = $grand_total.actual_grand_total_is_positive}
        {$rollover_amount_is_positive = $grand_total.rollover_amount_is_positive}
        {$remaining_amount_is_positive = $grand_total.remaining_amount_is_positive}
        {$is_grand_total = true}
        {include file='totals/monthly/category_row.tpl'}
    </thead>
</table>