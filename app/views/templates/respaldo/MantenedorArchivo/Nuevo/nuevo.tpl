<link href="{$static}template/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css"/>

<section class="content-header">
    <h1>Crear nueva Carpeta</h1>
     <ol class="breadcrumb">
        <li><a href="{$base_url}/MantenedorArchivos"><i class="fa fa-folder-open"></i>Información Documentada</a></li>
        <li class="active">Crear nueva Carpeta</li>
     </ol>
</section>

<section class="content">
    <div class="box box-primary">
        <div class="box-body">
            <form role="form" class="form-horizontal">
                <div class="row">
                    <div class="col-md-6 top-spaced">
                        <div class="margin-bottom-10"></div>

                        <div class="form-group">
                            <label  class="col-lg-4 control-label">Nombre Carpeta</label>
                            <div class="col-lg-8">
                                <input class="form-control" name="nombre" id="nombre" placeholder="Ingrese Nombre Carpeta"> </input>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row top-spaced margin-bottom-10">
                    <div class="col-xs-12 top-spaced">

                        <div class="form-group">
                            <label for="exampleInputEmail1" class="col-xs-12  col-md-2 control-label">Comentario</label>
                            <div class="col-xs-12 col-md-10">
                                <textarea class="form-control form-control-textarea" name="gl_comentario" id="gl_comentario" rows="4"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="top-spaced">

                    <div class="box box-info">
                        <div class="box-header">
                            Archivos adjuntos
                            <button type="button" class="btn btn-success btn-xs btn-flat"
                                    onClick="xModal.open('{$smarty.const.BASE_URI}/MantenedorArchivos/adjuntarArchivo','Adjuntar Archivos',50,'adjuntar',true,280);">
                                <i class="fa fa-upload"></i></button>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive" id="lista_adjuntos"></div>
                        </div>
                    </div>
                </div>

                <div class="margin-bottom-10"></div>
                <!-- Campos carga Automatica -->
                <input  type="hidden" name="id_usuario" id="id_usuario" value="{$id_usuario}"></input>
                <input  type="hidden" name="id_estado_carpeta" id="id_estado_carpeta" value="0"></input>

                <button type="button" class="btn btn-success pull-right btn-flat" onclick="MantenedorArchivos.guardarNuevaSolicitud(this.form,this);">Guardar Carpeta</button>
            </form>
        </div>
    </div>
</section>