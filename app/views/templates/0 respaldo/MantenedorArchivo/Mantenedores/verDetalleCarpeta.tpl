<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<section class="content-header">
    <h1>Detalle carpeta {$revisar_carpeta->nombre}</h1>
</section>

<div class="box box-success">
    <div class="box-body">
        <form role="form" class="form-horizontal">
            <div class="row">
                <div class="col-md-6 top-spaced">
                    <div class="margin-bottom-10"></div>                   
                   
                    <div class="form-group">
                        <label for="exampleInputPassword1" class="col-lg-5 control-label">Nombre Carpeta</label>
                         <div class="col-lg-5">
                            <p class="form-control-static well well-sm" name="nombre" id="nombre" value="{$revisar_carpeta->nombres}" class="form-control">{$revisar_carpeta->nombre}</p>
                         </div>
                    </div>
                  
                </div>

                 <div class="col-md-6 top-spaced">
                    <div class="margin-bottom-10"></div>
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="col-lg-5 control-label">Usuario Creador</label>
                            <div class="col-lg-5">
                               <p class="form-control-static well well-sm" name="nombres" id="nombres" value="{$revisar_carpeta->nombres}" class="form-control">{$revisar_carpeta->nombres}</p>
                            </div>
                    </div>           
                </div>               
            </div>

            <div class="row">    
                <div class="col-md-6 top-spaced">
                    <div class="margin-bottom-10"></div>            
                    <div class="form-group">
                         <label for="exampleInputEmail1" class="col-lg-5 control-label">Estado Carpeta</label>
                         <div class="col-lg-5">
                              <p class="form-control-static well well-sm" name="nombre_estado_carpeta" id="nombre_estado_carpeta" value="{$revisar_carpeta->nombre_estado_carpeta}" class="form-control">{$revisar_carpeta->nombre_estado_carpeta}</p>
                         </div>
                    </div>
                </div>

                <div class="col-md-6 top-spaced">
                    <div class="margin-bottom-10"></div>
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="col-lg-5 control-label">Fecha creacion</label>
                            <div class="col-lg-5">
                                <p class="form-control-static well well-sm" name="fc_fecha_creacion" id="fc_fecha_creacion" value="{$revisar_carpeta->fc_fecha_creacion}" class="form-control">{$revisar_carpeta->fc_fecha_creacion}</p>
                             </div>
                    </div>           
                </div>

                <div class="col-md-6 top-spaced">
                    <div class="margin-bottom-10"></div>
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="col-lg-5 control-label">Comentario</label>
                            <div class="col-lg-5">
                                <textarea class="form-control form-control-textarea" name="gl_comentario" id="gl_comentario" rows="4">{$revisar_carpeta->gl_comentario}</textarea>
                            </div>
                    </div>           
                </div>

         </div>
        </form>
    </div>
</div>