<section class="content-header">
    <h1><i class="fa fa-user"></i> <span>Cuenta</span></h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12 col-md-6">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Datos de Usuario</h3>
                </div>
                <div class="box-body">
                    <label class="control-label required">Nombre</label><br>
                    {$nombre}
                    <br/><br/>
                    <label class="control-label required">RUT</label><br>
                    {$rut}
                    <br/><br/>
                    <label class="control-label required">Email</label><br>
                    {$mail}
                    <br/><br/>
                    <label class="control-label required">Fono</label><br>
                    {$fono}
                    <br/><br/>
                    <label class="control-label required">Celular</label><br>
                    {$celular}
                    <br/><br/>
                    <label class="control-label required">Comuna</label><br>
                    {$comuna}
                    <br/><br/>
                    <label class="control-label required">Provincia</label><br>
                    {$provincia}
                    <br/><br/>
                    <label class="control-label required">Regi&oacute;n</label><br>
                    {$region}
                    <br/><br/>
                </div>
            </div>
        </div>
        
        <div class="col-xs-12 col-md-6">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Actualización de Contraseña</h3>
                </div>
                <div class="box-body">
                    <div class="col-sm-12">
                        <div class="alert alert-warning">
                            <i class="fa fa-info-circle"></i> No ha actualizado su contraseña inicial.
                        </div>
                    </div>
                    
                    <form  id="form" name="form" enctype="application/x-www-form-urlencoded" action="" method="post">
                        <input type="hidden" name="id" id="id" value="{$item->id}"/>
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
                            <i class="fa fa-warning fa-2x"></i> &nbsp; 
                            <strong> ¡Error! </strong> Existen problemas en los datos, revise los campos en rojo.
                        </div>
                        <div id="form-ok" class="alert alert-warning hidden">
                            <i class="fa fa-info-circle"></i> &nbsp; 
                            La contraseña ha sido actualizada.
                        </div>
                        <div class="col-md-12 text-right">
                            <button type="button" id="guardar" class="btn btn-success btn-sm">
                                <i class="fa fa-save"></i> Guardar
                            </button>
                            <button type="button" id="cancelar" onclick="location.href='{$base_url}/Home/dashboard'" class="btn btn-default btn-sm">
                                <i class="fa fa-remove"></i> Cancelar 
                            </button>
                            <br/><br/>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</section>