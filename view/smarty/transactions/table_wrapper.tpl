<table class="table table-striped table-bordered table-responsive">
    <thead>
        <tr>
            <th class="text-center" colspan="6">{$transaction_type} for {$report_month}</th>
        </tr>
        <tr>
            <th>Category</th>
            <th>{$date_field_label}</th>
            <th>Item</th>
            <th>Amount</th>
            <th>Notes</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        {include file="transactions/transactions.tpl"}
    </tbody>
    <thead>
        <tr>
            <th class="text-center" colspan="6">New Record</th>
        </tr>
        <tr>
            <th>Category</th>
            <th>{$date_field_label}</th>
            <th>Item</th>
            <th>Amount</th>
            <th>Notes</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        {$submit_type = 'new'}
        {include file="transactions/new.tpl"}
    </tbody>
</table>