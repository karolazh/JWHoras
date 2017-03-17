
<ol class="breadcrumb">
	<li><a href="{$smarty.const.BASE_URI}/home/dashboard"> Inicio </a></li>
	<li class="active"> Mantenedor Perfil </a></li>
</ol>

<div class="row">
	<div class="col-lg-12 col-xs-12">
		<div class="panel panel-info">
		    <div class="panel-heading" style="overflow: hidden;line-height: 30px">
				<strong>Listado de Perfiles</strong>
				<button type="button" class="btn btn-success btn-xs pull-right" onclick="xModal.open('{$smarty.const.BASE_URI}/Mantenedor/agregarPerfil','Agregar Perfil','70');">Agregar Perfil</button>
		  	</div>
		  	<div class="panel-body">
				<div id="contenedor-tabla">
					{include file="mantenedor_perfil/grilla.tpl"}
				</div>
		  	</div>
		</div>
	</div>
</div>