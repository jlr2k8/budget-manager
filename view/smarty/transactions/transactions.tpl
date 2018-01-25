{foreach from=$transactions item=t}
    <tr>
        <td>
            {$t.category_label}
        </td>
        <td>{$t.date_formatted}</td>
        <td>{$t.item}</td>
        <td>{$t.amount_formatted}</td>
        <td>{$t.notes}</td>
        <td>
            {if $t.show_edit}
                <a href="/{strtolower($transaction_type)}/{$t.equity_type_url}/{$t.category_url}/{$t.id}/">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                </a>
            {/if}
            {if $t.show_delete}
                <a onclick="return confirm('Are you sure you want to delete?');" href="/{strtolower($transaction_type)}/submit/delete/{$t.id}/">
                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                </a>
            {/if}
        </td>
    </tr>
{/foreach}