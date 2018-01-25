<form method="post" action="/{strtolower($transaction_type)}/submit/{$submit_type}/">
    <tr class="form-group">
        <td>
            {$select_options}
        </td>
        <td>
            <input name="{$date_field_name}" type="date" class="form-control" required="required" />
        </td>
        <td>
            <input name="item" type="text" class="form-control" required="required" />
        </td>
        <td>
            <input name="amount" type="number" class="form-control" required="required" step=".01" />
        </td>
        <td>
            <input name="notes" type="text" class="form-control" />
        </td>
        <td>
            <input type="submit" value="Add" class="form-control" />
        </td>
    </tr>
</form>