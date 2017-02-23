<legend>Modificar contraseña</legend>
<ol class="breadcrumb">
    <li><i class="fa fa-angle-right"></i> <strong>Modificar cuenta</strong></li>
    <li class="active">Contraseña</li>   
</ol>

<div id="form-success" class="hidden">
    <div class="alert alert-success">
        <div class="row">
            <div class="col-sm-1">
                <i class="fa fa-info-circle fa-2x"></i> 
            </div>
            <div id="mensaje-email-enviado" class="col-sm-11">
                
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
    <form  id="form" name="form" enctype="application/x-www-form-urlencoded" action="" method="post">
        <div class="row">
            <div class="col-md-6 text-left">
                <div class="form-group clearfix">
                    <h4>
                        ¿Desea modificar su contraseña?
                    </h4>
                </div>
            </div>
        </div>
        <div class="col-md-12 text-center">
            <button type="button" id="guardar" class="btn btn-success btn-sm">
                <i class="fa fa-thumbs-up"></i> Si
            </button>
            <button type="button" id="cancelar" onclick="location.href='{$base_url}/Home/dashboard'" class="btn btn-default btn-sm">
                <i class="fa fa-thumbs-down"></i> No 
            </button>
        </div>
    </form>
</div>