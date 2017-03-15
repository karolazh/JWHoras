
<ol class="breadcrumb">
	<li><a href="{$smarty.const.BASE_URI}/home/dashboard"> Inicio </a></li>
	<li class="active"> Mantenedor Menú </a></li>
</ol>

<div class="row">
	<div class="col-lg-12 col-xs-12">
		<div class="panel panel-info">
		    <div class="panel-heading" style="overflow: hidden;line-height: 30px">
				<strong>Listado de Opción Menú</strong>	
					<button type="button" class="btn btn-primary btn-xs pull-right" onclick="xModal.open('{$smarty.const.BASE_URI}/mantenedor/agregarMenuOpcion','Agregar Menú Opción','70');"> Agregar Menú Opción </button>
					<button type="button" class="btn btn-success btn-xs pull-right" style="margin-right:10px;" onclick="xModal.open('{$smarty.const.BASE_URI}/mantenedor/agregarMenuPadre','Agregar Menú Padre','70');"> Agregar Menú Padre </button>
			</div>
		  	<div class="panel-body">
				<div id="contenedor-tabla">
					{include file="mantenedor_menu/grilla.tpl"}
				</div>
		  	</div>
		</div>
	</div>
</div>