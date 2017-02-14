<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<section class="content-header">
    <h1><i class="fa fa-cog"></i> Mantenedor de Noticias</h1>
        <ol class="breadcrumb">
            <li><a href="{$base_url}/Administracion/noticias">
            <i class="fa fa-folder-open"></i>Mantenedor de Noticias</a></li>
            <li class="active">Nueva Noticia</li>
        </ol>
</section>

<section class="content">
    <div class="box box-primary">
        <div class="box-body">

            <form role="form" class="form-horizontal">
                <div class="col-md-12">
                    <label  class="control-label required">T&iacute;tulo (*)</label>
                    <div class="form-group">                        
                        <div class="col-md-12">
                            <input class="form-control" 
                                   name="nombre" id="titulo" placeholder="Título noticia"></input>
                        </div>
                    </div>
                   
                    <label  class="control-label required">Resumen (*)</label>
                    <div class="form-group">                        
                        <div class="col-md-12">
                            <input class="form-control" 
                                   name="nombre" id="resumen" placeholder="Resumen noticia"></input>
                        </div>
                    </div>
                   
                    <label  class="control-label required">Cuerpo (*)</label>
                    <div class="form-group">                        
                        <div class="col-md-12">
                            <input class="form-control" 
                                   name="nombre" id="cuerpo" placeholder="Cuerpo Noticia"></input>
                        </div>
                    </div>

                    <button type="button" class="btn btn-success btn-flat" 
                            accesskey=""onclick="">Guardar</button>
                    <br><br><br>
                </div>

            </form>

            <table id="tablaPrincipal" class="table table-hover table-striped table-bordered  table-middle dataTable no-footer">
                <thead>
                    <tr role="row">
                        <th align="center" width="10%">#ID</th>
                        <th align="center" width="40%">T&iacute;tulo</th>
                        <th align="center" width="40%">Resumen</th>
                        <th align="center" width="10%">Acciones</th>
                    </tr>
                </thead>
                {*<tbody>
                    {foreach $arrResultado as $itm}
                        <tr>
                            <td nowrap width="100px" align="center"> {$itm->id_actividad} </td>
                            <td nowrap width="100px" align="center"> {$itm->actividad} </td>
                            <td class="text-center">{$itm->fecha_creacion_actividad}</td>
                            <td nowrap width="100px" align="center">{$itm->nombres} {$itm->apellidos}</td>           
                            <td class="text-center" style="width:100px;">				
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-success btn-flat" 
                                            onClick="location.href='{$base_url}/MantenedorActividades/revisarActividad/{$itm->id_actividad}'" 
                                            data-toggle="tooltip" title="Ver Actividad">
                                        <i class="fa fa-file-o"></i></button>
                                </div>			
                           </td>          
                        </tr>
                    {/foreach}
                </tbody>*}
            </table>

        </div>
    </div>    
</section>