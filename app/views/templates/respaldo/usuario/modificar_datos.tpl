<legend>Modificar datos personales</legend>
<ol class="breadcrumb">
    <li><i class="fa fa-angle-right"></i> <strong>Modificar cuenta</strong></li>
    
    <li class="active">Datos personales</li>   
    <div class="pull-right">(*) Campos requeridos</div>
</ol>

<div id="form-success" class="hidden">
    <div class="alert alert-success">
        <div class="row">
            <div class="col-sm-1">
                <i class="fa fa-info-circle fa-2x"></i> 
            </div>
            <div class="col-sm-11">
                Los datos se modificaron correctamente.
            </div>
        </div>
    </div>
    <div class="col-md-12 text-right">
        <button type="button" onclick="location.href='{$base_url}/Home/dashboard'" class="btn btn-primary btn-sm">
            Continuar <i class="fa fa-forward"></i> 
        </button>
    </div>
</div>
<div id="form-contenedor"> 
    <form  id="form" name="form" enctype="application/x-www-form-urlencoded" action="" class="form" method="post">
        <div class="row">
            <div class="col-md-6 text-left">
                <div class="form-group clearfix">
                    <label for="rut" class="control-label required">Rut (*)</label>
                    <input type="text" name="rut" id="rut" value="{$item->rut}" class="form-control rut disabled" disabled=""/>
                    <span class="help-block hidden"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 text-left">
                <div class="form-group clearfix">
                    <label for="nombre" class="control-label required">Nombres (*)</label>
                    <input type="text" name="nombre" id="nombre" value="{$item->nombres}" class="form-control"/>
                    <span class="help-block hidden"></span>
                </div>
            </div>
            <div class="col-md-6 text-left">
                <div class="form-group clearfix">
                    <label for="apellido" class="control-label required">Apellidos (*)</label>
                    <input type="text" name="apellido" id="apellido" value="{$item->apellidos}" class="form-control"/>
                    <span class="help-block hidden"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 text-left">
                <div class="form-group clearfix">
                    <label for="email" class="control-label required">Email (*)</label>
                    <input type="text" name="email" id="email" value="{$item->email}" class="form-control"/>
                    <span class="help-block hidden"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 text-left">
                <div class="form-group clearfix">
                    <label for="gl_anexo" class="control-label required">Anexo (*)</label>
                    <input type="text" name="gl_anexo" id="gl_anexo" value="{$item->gl_anexo}" class="form-control"/>
                    <span class="help-block hidden"></span>
                </div>
            </div>
            <div class="col-md-6 text-left">
                <div class="form-group clearfix">
                    <label for="gl_celular" class="control-label required">Celular (*)</label>
                    <input type="text" name="gl_celular" id="gl_celular" value="{$item->gl_celular}" class="form-control"/>
                    <span class="help-block hidden"></span>
                </div>
            </div>			
        </div>		
        <div class="row">
            <div class="col-md-6 text-left">
                <div class="form-group clearfix">
                    <label for="gl_cargo" class="control-label required">Cargo (*)</label>
                    <input type="text" name="gl_cargo" id="gl_cargo" value="{$item->gl_cargo}" class="form-control"/>
                    <span class="help-block hidden"></span>
                </div>
            </div>
            <div class="col-md-6 text-left">
                <div class="form-group clearfix">
                    <label for="gl_localidad" class="control-label required">Localidad (*)</label>
                    <input type="text" name="gl_localidad" id="gl_localidad" value="{$item->gl_localidad}" class="form-control"/>
                    <span class="help-block hidden"></span>
                </div>
            </div>			
        </div>				
		<div class="row">
			<div class="col-md-6 text-left">
				<div class="form-group clearfix">
					<label for="email" class="control-label required">Región</label>
					{selectRegion nombre="region" class="form-control" default=$region}
					<span class="help-block hidden"></span>
				</div>
			</div>
			<div class="col-md-6 text-left">
				<div class="form-group clearfix">
					<label for="email" class="control-label required">Oficinas</label>
					{selectOficina nombre="oficinas" class="form-control" default=$oficinas}
					<span class="help-block hidden"></span>
				</div>
			</div>		
		</div>	
        <div class="clearfix"></div>
        <div id="form-error" class="alert alert-danger hidden">
            <i class="fa fa-warning fa-2x"></i> &nbsp; <strong> ¡Error! </strong> Existen problemas en los datos, revise los campos en rojo.
        </div>
        <div class="col-md-12 text-right">
            <button type="button" id="guardar" class="btn btn-success btn-sm">
                <i class="fa fa-save"></i> Guardar 
            </button>
            <button type="button" id="cancelar" onclick="location.href='{$base_url}/Home/dashboard'" class="btn btn-default btn-sm">
                <i class="fa fa-remove"></i> Cancelar 
            </button>
        </div>
    </form>
</div>