<legend>Actualizar contraseña</legend>
<ol class="breadcrumb">
    <li><i class="fa fa-angle-right"></i> <strong>Login</strong></li>
    <li class="active">Actualización de contraseña</li>      
</ol>

<div id="form-success" class="hidden">
    <div class="alert alert-success">
        <div class="row">
            <div class="col-sm-1">
                <i class="fa fa-info-circle fa-2x"></i> 
            </div>
            <div id="mensaje-modificacion" class="col-sm-11">
                
            </div>
        </div>
    </div>
    <div class="col-md-12 text-right">
        <button type="button" onclick="location.href='{$base_url}/Login'" class="btn btn-primary btn-sm">
            Continuar <i class="fa fa-forward"></i> 
        </button>
    </div>
</div>


<div id="form-contenedor"> 
    <div class="col-sm-12">
        <div class="alert alert-warning">
            <i class="fa fa-info-circle"></i> Ingrese los datos a continuación para modificar su contraseña.
        </div>
    </div>

    <div class="col-sm-12">
        <form  id="form" name="form" enctype="application/x-www-form-urlencoded" action="" method="post">
            <input type="hidden" name="id" id="id" value="{$codigo}"/>
            <div class="col-md-6 text-left">
                <div class="form-group clearfix">
                    <label for="password" class="control-label required">Nueva contraseña (*)</label>
                    <input type="password" name="password" id="password" value="" class="form-control"/>
                    <span class="help-block hidden"></span>
                </div>
            </div>
            <div class="col-md-6 text-left">
                <div class="form-group clearfix">
                    <label for="password_repetido" class="control-label required">Repita la nueva contraseña (*)</label>
                    <input type="password" name="password_repetido" id="password_repetido" value="" class="form-control"/>
                    <span class="help-block hidden"></span>
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
                    <i class="fa fa-remove"></i> Omitir 
                </button>
            </div>
        </form>
    </div>
</div>