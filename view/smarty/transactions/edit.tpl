{if !isset($classes)}
    {$classes = 'boogers'}
{/if}

{foreach from=$transactions item=t}
    <div class="{$classes}">
        <form method="post" action="/{strtolower($transaction_type)}/submit/{$submit_type}/{$t.id}/">
            <div class="form-group">
                <div class="form-group">
                    {$select_options}
                </div>
                <div class="form-group">
                    <input name="{$date_field}" type="date" class="form-control" required="required" value="{$t.$date_field}" />
                </div>
                <div class="form-group">
                    <input name="item" type="text" class="form-control" required="required" value="{$t.item}" />
                </div>
                <div class="form-group">
                    <input name="amount" type="number" class="form-control" required="required" step=".01" value="{$t.amount}" />
                </div>
                <div class="form-group">
                    <input name="notes" type="text" class="form-control" value="{$t.notes}" />
                </div>
                <div class="form-group">
                    <input type="submit" value="Edit" class="form-control" />
                </div>
            </div>
        </form>
    </div>
{/foreach}