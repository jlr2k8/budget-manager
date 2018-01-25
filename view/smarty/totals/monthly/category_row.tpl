<tr class="{$row_class}">
    <td>
        {$category_label}
    </td>
    <td class="{if $is_grand_total && $projected_amount_is_positive}bg-success{elseif $is_grand_total}bg-danger{/if}">
        <a href="/projection/{$equity_type_url}{if !empty($equity_type_url)}/{/if}{$category_url}{if !empty($category_url)}/{/if}">{$projection_amount_formatted}</a>
    </td>
    <td class="{if $is_grand_total && $actual_amount_is_positive}bg-success{elseif $is_grand_total}bg-danger{/if}">
        <a href="/checkbook/{$equity_type_url}{if !empty($equity_type_url)}/{/if}{$category_url}{if !empty($category_url)}/{/if}">{$actual_amount_formatted}</a>
    </td>
    <td class="{if $is_grand_total && $rollover_amount_is_positive}bg-success{elseif $is_grand_total}bg-danger{/if}">
        {$rollover_amount_formatted}
    </td>
    <td class="{if $remaining_amount_is_positive}bg-success{else}bg-danger{/if}">
        {$remaining_amount_formatted}
    </td>
</tr>