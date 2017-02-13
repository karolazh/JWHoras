<form id="form" name="form-inline" enctype="application/x-www-form-urlencoded" action="" method="post">
    <div class="row">
        <div class="col-md-6 top-spaced">
            <div class="margin-bottom-10"></div>
            <div class="form-group">
                <?php 
                    $fecha=date('Y-m-d H:i:s');echo $fecha;
                ?>
                <label for="exampleInputPassword1" class="col-lg-4 control-label">Nombre de la prioridad</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" id="nombre_prioridad" name="nombre_prioridad" value="{$item->gl_descripcion}">
                    <span class="help-block hidden"></span>
                    <input type="hidden" class="form-control" id="fecha" name="fecha" value='{$fecha_creacion_controller}'>
                </div>
            </div>
        </div>
    </div>

    <div class="margin-bottom-10"></div>
    
     <div id="form-error" class="alert alert-danger hidden ">
        <i class="fa fa-warning fa-2x"></i> &nbsp; <strong> ¡Error! </strong> Existen problemas en los datos, revise los
        campos en rojo.
    </div>

    <div class="col-md-12 text-right">
        <button type="button" class="btn btn-success pull-right btn-flat" onclick="Prioridades.guardarNuevaPrioridad(this.form,this);">
                Guardar prioridad
        </button>
        
    </div>
</form>
                
            

           

             