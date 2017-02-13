<form id="form" name="form-inline" enctype="application/x-www-form-urlencoded" action="" method="post">
<input type="hidden" name="id_estado" id="id_estado" value="{$item->id_estado}"/>
    <div class="row">
        <div class="col-md-6 top-spaced">
            <div class="margin-bottom-10"></div>
           
            
            <div class="form-group">
                <label for="exampleInputPassword1" class="col-lg-4 control-label">Nombre del estado</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" id="nombre_estado" name="nombre_estado" value="{$item->gl_descripcion}">
                </div>
            </div>

          
        </div>

        <div class="col-md-6 ">
            <div class="margin-bottom-10"></div>
              <div class="form-group top-spaced">
                <label for="exampleInputPassword1" class="col-lg-4 control-label">Fecha creación</label>
                <div class="col-lg-8">
                    <input type="text" readonly="true" class="form-control" id="fecha" name="fecha" value="{$item->fc_fecha_creacion}">
                </div>
            </div>
            
           
        </div>
    </div>

      <div class="row">
        <div class="col-md-6 top-spaced">
            <div class="margin-bottom-10"></div>
            <div class="form-group">
                <label for="exampleInputPassword1" class="col-lg-4 control-label">Descripción</label>
                <div class="col-lg-7">
                    <textarea  class="form-control" id="descripcion" name="descripcion" placeholder="">{$item->gl_descripcion_estado}</textarea>
                </div>
            </div>  
        </div>
    </div>

    <div class="margin-bottom-10"></div>
    <div class="col-md-12 text-right">
        <button type="button" id="guardar" class="btn btn-success btn-sm btn-flat">
            <i class="fa fa-save"></i> Guardar
        </button>
        <button type="button" id="cancelar" onclick="location.href='{$base_url}/Estados'"
                class="btn btn-default btn-sm btn-flat">
            <i class="fa fa-remove"></i> Cancelar
        </button>
    </div>

</form>
        