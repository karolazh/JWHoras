<form id="form" name="form-inline" enctype="application/x-www-form-urlencoded" action="" method="post">
<input type="hidden" name="id" id="id" value="{$item->id}"/>
    <div class="row">
        <div class="col-md-6 top-spaced">
            <div class="margin-bottom-10"></div>
            <div class="form-group">
                <label for="exampleInputPassword1" class="col-lg-4 control-label">Nombre de la prioridad</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" id="nombre_prioridad" name="nombre_prioridad" value="{$item->gl_descripcion}">
                </div>
            </div>
        </div>
        <div class="col-md-6 top-spaced">
            <div class="margin-bottom-10"></div>
            <div class="form-group">
                <label for="exampleInputPassword1" class="col-lg-4 control-label">Fecha de creación</label>
                <div class="col-lg-8">
                    <input type="text" readonly="true" class="form-control" id="fecha" name="fecha" value='{$item->fc_fecha_creacion}'>
                </div>
            </div>
        </div>
    </div>

    <div class="margin-bottom-10"></div>

    <div class="col-md-12 text-right top-spaced">
        <button type="button" id="guardar" class="btn btn-success btn-sm btn-flat">
            <i class="fa fa-save"></i> Guardar
        </button>
        <button type="button" id="cancelar" onclick="location.href='{$base_url}/Prioridad'"
                class="btn btn-default btn-sm btn-flat">
            <i class="fa fa-remove"></i> Cancelar
        </button>
    </div>
</form>
                
            

           

             