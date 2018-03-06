<select name="category" class="form-control" required="required">
    <option value=""></option>
    {foreach from=$options item=option}
        <option {if $option.selected_category_id == $option.category_id}selected="selected"{/if} value="{$option.category_id}">
            {$option.category_label}
        </option>
    {/foreach}
</select>