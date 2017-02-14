<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<section class="content-header">
    <h1><i class="fa fa-plus"></i> DAU</h1>
    <div class="col-md-12 text-right">
        <button type="button" id="ingresar" onclick="location.href='{$base_url}/Dau/nuevaDau'"
                class="btn btn-danger">
            <i class="fa fa-plus"></i>&nbsp;&nbsp;Ingresar DAU
        </button>
    </div>
    <br/><br/>
</section>

<section class="content">
    <div class="box box-primary">
        <div class="box-body">

            <table id="tablaPrincipal" class="table table-hover table-striped table-bordered  table-middle dataTable no-footer">
                <thead>
                    <tr role="row">
                        <th align="center" width="5%">#ID</th>
                        <th align="center" width="10%">RUT Paciente</th>
                        <th align="center" width="10%">Fecha Ingreso</th>
                        <th align="center" width="10%">Hora Ingreso</th>
                        <th align="center" width="10%">Hora Egreso</th>
                        <th align="center" width="">Caso Egreso</th>
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