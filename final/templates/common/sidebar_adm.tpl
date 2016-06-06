
<div class="col-sm-3 col-md-2 sidebar-offcanvas" id="sidebar" role="navigation" >
    <ul class="nav nav-sidebar">
        <li {if $selected==='visaogeral' }class="active" {/if}><a href="{$BASE_URL}pages/homepage.php">Visão Geral</a></li>
        <li {if $selected==='gerirpessoal' }class="active" {/if}><a href="{$BASE_URL}pages/gerirpessoal.php">Gerir Pessoal</a></li>
        <li {if $selected==='gerirmercha' }class="active" {/if}><a href="{$BASE_URL}pages/gerirmercha.php">Gerir Merchandising</a></li>
        <li {if $selected==='gerireventos' }class="active" {/if}><a href="{$BASE_URL}pages/gerireventos.php">Gerir Eventos</a></li>
    </ul>
</div>
<!--toggle sidebar button-->
<p class="visible-xs">
    <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">
        <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
</p>
