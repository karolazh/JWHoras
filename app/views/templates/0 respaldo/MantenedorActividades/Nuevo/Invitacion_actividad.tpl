<head>{include file="layout/css.tpl"}</head>

<section class="content">
    <div class="box box-success">
        <div class="box-body">
            <form class="form" role="form" enctype="multipart/form-data" method="post"
                  action="{$smarty.const.BASE_URI}/MantenedorActividades/subirArchivo">
                <div class="form-group">
                    <label class="control-label">Busque el archivo a adjuntara la Actividad</label>
                    <div class="">
                        <div class="input-group">
                            <label  class="col-lg-4 control-label">Nombre Archivo</label>
                            <div class="col-lg-8">
                                <input class="form-control" name="nombre_archivo" id="nombre_archivo" placeholder="Ingrese Nombre Archivo"> </input>
                            </div>

                            <label  class="col-lg-4 control-label">Adjuntar Archivo</label>
                            <div class="col-lg-8">
                                <input type="file" name="archivo" id="archivo" class="form-control"/>
                            </div>
                                
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-success btn-flat" onclick="this.form.submit();">Adjuntar</button>
                            </div>

                            <div class="input-group-btn">
                                <button type="button" class="btn btn-primary btn-flat" onclick="parent.xModal.close();">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    {if isset($mensaje)}
        {$mensaje}
    {/if}
</section>