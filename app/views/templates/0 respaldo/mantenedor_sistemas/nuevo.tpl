<legend>
    Mantenedor de sistemas
    <button class="btn btn-xs btn-link" onClick="location.href='{$base_url}/MantenedorSistemas/index'" style="float: right">
        <i class="fa fa-backward"></i> Ir Atras
    </button>
</legend>
        
<ol class="breadcrumb">
    <li><i class="fa fa-angle-right"></i> <strong>Mantenedor</strong></li>
    <li>Sistemas</li>
    <li class="active">Nuevo</li>      
</ol>
        
<div class="table-responsive" id="div_tabla_usuarios">
    {include file="mantenedor_sistemas/form.tpl"}
</div>
