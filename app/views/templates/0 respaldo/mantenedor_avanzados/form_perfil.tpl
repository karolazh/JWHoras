<form id="formPerfil" name="form-inline" enctype="application/x-www-form-urlencoded" action="" method="post">
    <div class="row">
        <div class="col-md-6 top-spaced">
            <div class="margin-bottom-10"></div>
           
            
            <div class="form-group">
                <label for="exampleInputPassword1" class="col-lg-4 control-label">Nombre del perfil</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" id="nombre_perfil" name="nombre_perfil" placeholder="">
                    <input type="hidden" class="form-control" id="fecha" name="fecha" value="{$fecha_creacion_controller}">
                </div>
            </div>
        </div>

        <div class="col-md-6 top-spaced">
            <div class="margin-bottom-10"></div>

            <div class="form-group">
                <label for="exampleInputPassword1" class="col-lg-4 control-label">Descripción</label>
                <div class="col-lg-7">
                    <textarea class="form-control" id="descripcion" name="descripcion" placeholder=""></textarea>
                </div>
            </div>
           
        </div>
    </div>

    <div class="margin-bottom-10 top-spaced" ></div>
    <div id="g">
        <button id="" type="button" class="btn btn-success pull-right btn-flat" onclick="Perfiles.guardarNuevoPerfil(this.form,this)">
            Guardar perfil
        </button>
    </div>
</form>
                
            


             