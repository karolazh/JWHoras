
<ol class="breadcrumb">
	<li><a href="{$smarty.const.BASE_URI}/home/dashboard"> Inicio </a></li>
	<li class="active"> Mantenedor Usuario </a></li>
</ol>

<div class="row">
	<div class="col-lg-12 col-xs-12">
		<div class="panel panel-info">
		    <div class="panel-heading" style="overflow: hidden;line-height: 30px">
				<strong>Listado de Usuarios</strong>
				{*}<button type="button" class="btn btn-success btn-xs pull-right" onclick="xModal.open('{$smarty.const.BASE_URI}/mantenedor/agregarUsuario','Agregar Usuario','70');">Agregar Usuario</button>{*}
		  	</div>
		  	<div class="panel-body">
				<div id="contenedor-tabla">
					{include file="mantenedor_usuario/grilla.tpl"}
				</div>
		  	</div>
		</div>
	</div>
</div>