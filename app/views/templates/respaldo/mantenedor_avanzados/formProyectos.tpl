<form id="form" name="form-inline" enctype="application/x-www-form-urlencoded" action="" method="post">
<input type="hidden" name="id_proyecto" id="id_proyecto" value="{$item->id_proyecto}"/>
    <div class="row">
        <div class="col-md-6 top-spaced">
            <div class="margin-bottom-10"></div>
           
            
            <div class="form-group">
                <label for="exampleInputPassword1" class="col-lg-4 control-label">Nombre del proyecto</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" id="nombre_proyecto" name="nombre_proyecto" value="{$item->gl_nombre_proyecto}">
                </div>
            </div>
        </div>

        <div class="col-md-6 top-spaced">
            <div class="margin-bottom-10"></div>

            <div class="form-group">
                <label for="exampleInputPassword1" class="col-lg-4 control-label">Descripción</label>
                <div class="col-lg-7">
                    <textarea class="form-control" id="descripcion" name="descripcion">{$item->gl_descripcion_proyecto}</textarea>
                </div>
            </div>
           
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 top-spaced">
            <div class="margin-bottom-10"></div>
           
            
            <div class="form-group">
                <label for="exampleInputPassword1" class="col-lg-4 control-label">Cliente</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" id="cliente" name="cliente" value="{$item->gl_cliente}">
                </div>
            </div>
        </div>

        
    </div>

    <div class="margin-bottom-10"></div>
     <div class="col-md-12 text-right">
        <button type="button" id="guardar" class="btn btn-success btn-sm btn-flat">
            <i class="fa fa-save"></i> Guardar
        </button>
        <button type="button" id="cancelar" onclick="location.href='{$base_url}/Proyecto'"
                class="btn btn-default btn-sm btn-flat">
            <i class="fa fa-remove"></i> Cancelar
        </button>
    </div>
</form>