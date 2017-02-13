<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<section class="content-header">
    <h1>Mantenedor de Razas</h1>
        <ol class="breadcrumb">
            <li><a href="{$base_url}/Administracion">
            <i class="fa fa-folder-open"></i>Mantenedor de Razas</a></li>
            <li class="active">Nueva Raza</>
        </ol>
</section>

<section class="content">
	<div class="box box-primary">
		<div class="box-body">
		
			 <form role="form" class="form-horizontal">
                            <div class="col-md-2">
                                <div class="form-group">
                                   <label class="control-label required">Especies (*)</label>                    
                                   <select name="region" id="region" class="form-control" onchange="Regiones.cargarComunasPorRegion(this.value,'provincias')">
                                                    <option value="0">-- Seleccione --</option>
                                                           {foreach from=$Regiones item=it}
                                                   <option value="{$it->id_region}">{$it->nombre_region}</option>
                                                           {/foreach}                
                                   </select>

                               </div>
                            </div>

                            <div class="col-md-6 ">
                                <label  class="control-label required">Nombre (*)</label>
                                    <div class="form-group">                        
                                        <div class="col-md-12">
                                                <input class="form-control" 
                                                       name="nombre" id="nombre" placeholder="Nombre"></input>
                                        </div>
                                    </div>
                                
                                <button type="button" class="btn btn-success btn-flat" 
                                    onclick="">
                                Guardar
                                </button>
                                <br><br><br>
                            </div>

                        </form>
                            
                    
                    <table id="tablaPrincipal" class="table table-hover table-striped table-bordered  table-middle dataTable no-footer">
                        <thead>
                            <tr role="row">
                                <th align="center"># ID</th>
                                <th align="center">Nombre</th>
                                <th align="center">Especie</th>
                                <th width="1px" align="center">Acciones</th>
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