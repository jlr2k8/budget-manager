<select name="category" class="form-control" required="required">
    <option value=""></option>
    {foreach from=$options item=option}
        <option value="{$option.category_id}">{$option.category_label}</option>
    {/foreach}
</select>