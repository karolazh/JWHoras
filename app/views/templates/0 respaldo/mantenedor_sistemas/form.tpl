<form  id="form" name="form" enctype="application/x-www-form-urlencoded" action="" method="post">
    <input type="hidden" name="id" id="id" value="{$sistema->id}"/>
		<div class="row">
			<div class="col-md-6 text-left">
				<div class="form-group clearfix">
					<label for="nombre" class="control-label required">Nombre (*)</label>
					<input type="text" name="nombre" id="nombre" value="{$sistema->nombre}" class="form-control"/>
					<span class="help-block hidden"></span>
				</div>
			</div>
		</div>
		<div class="row">		
			<div class="col-md-6 text-left">
				<div class="form-group clearfix">
					<label for="descripcion" class="control-label required">Descripción</label>
					<input type="text" name="descripcion" id="descripcion" value="{$sistema->descripcion}" class="form-control"/>
					<span class="help-block hidden"></span>
				</div>
			</div>
		</div>
		<div class="row">		
			<div class="col-md-6 text-left">
				<div class="form-group clearfix">
					<label for="url_produccion" class="control-label required">Url Produccion</label>
					<input type="text" name="url_produccion" id="url_produccion" value="{$sistema->url_produccion}" class="form-control"/>
					<span class="help-block hidden"></span>
				</div>
			</div>
			<div class="col-md-6 text-left">
				<div class="form-group clearfix">
					<label for="url_desarrollo" class="control-label required">Url Desarrollo</label>
					<input type="text" name="url_desarrollo" id="url_desarrollo" value="{$sistema->url_desarrollo}" class="form-control"/>
					<span class="help-block hidden"></span>
				</div>
			</div>
			
			<div class="col-md-3 text-left">
				<div class="form-group clearfix">
					<label for="gl_color" class="control-label required">Color</label>
					<input type="text" name="gl_color" id="gl_color" value="{$sistema->gl_color}" class="form-control"/>
					<span class="help-block hidden"></span>
				</div>
			</div>
			<div class="col-md-3 text-left">
				<div class="form-group clearfix">
					<label for="gl_icono" class="control-label required">&Iacute;cono</label>
					<input type="text" name="gl_icono" id="gl_icono" value="{$sistema->gl_icono}" class="form-control"/>
					<span class="help-block hidden"></span>
				</div>
			</div>		
			<div class="col-md-3 text-left">
				<div class="form-group clearfix">
					<label for="gl_icono" class="control-label required">Activo</label>
					<select class="form-control" id="gl_activo" name="gl_activo">
						<option value="0" >Seleccione</option>
						<option value="SI" {if $sistema->gl_activo == "SI"}SELECTED{/if} >SI</option>
						<option value="NO" {if $sistema->gl_activo == "NO"}SELECTED{/if} >NO</option>
					</select>
					<span class="help-block hidden"></span>
				</div>
			</div>					
		</div>	
        <div class="clearfix"></div>
        <div id="form-error" class="alert alert-danger hidden">
            <strong> ¡Error! </strong> Existen problemas en los datos, revise los campos en rojo.
        </div>
        <div class="col-md-12 text-right">
            <button type="button" id="guardar" class="btn btn-success btn-sm">
                <i class="fa fa-save"></i> Guardar 
            </button>
            <button type="button" id="cancelar" onclick="location.href='{$base_url}/MantenedorSistemas/index'" class="btn btn-default btn-sm">
                <i class="fa fa-remove"></i> Cancelar 
            </button>
        </div>

</form>