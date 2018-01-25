<a class="navbar-brand" href="/index.html">Budget Manager</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="navbar">
    <ul class="navbar-nav mr-auto">
        <li class="nav-item {*active*}">
            <a class="nav-link" href="/index.html">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/projection/">Projections</a>
        </li>
        <li class="nav-item dropdown">
            {$date_select}
        </li>
        <li class="nav-item">
           {* <a class="nav-link" href="/settings/">Settings <i class="fa fa-cog"></i></a> - TODO *}
        </li>
    </ul>
</div>