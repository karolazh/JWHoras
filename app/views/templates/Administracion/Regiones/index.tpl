<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<section class="content-header">
    <h1>Mantenedor de Regiones</h1>
        <ol class="breadcrumb">
            <li><a href="{$base_url}/Administracion">
            <i class="fa fa-folder-open"></i>Mantenedor de Regiones</a></li>
            <li class="active">Nueva Región</>
        </ol>
</section>

<section class="content">
	<div class="box box-primary">
		<div class="box-body">
			 <form role="form" class="form-horizontal">
                            <!-- <div class="col-md-2">
                                <div class="form-group">
                                   <label class="control-label required">Region (*)</label>                    
                                   <select name="region" id="region" class="form-control" onchange="Regiones.cargarComunasPorRegion(this.value,'provincias')">
                                                    <option value="0">-- Seleccione --</option>
                                                           {foreach from=$Regiones item=it}
                                                   <option value="{$it->id_region}">{$it->nombre_region}</option>
                                                           {/foreach}                
                                   </select>

                               </div>
                            </div> -->

                            <!-- <div class="col-md-2 col-md-offset-1">
                                <div class="form-group">
                                    <label class="control-label required">Provincia (*)</label>
                                        <select class="form-control" id="provincias" name="provincias" onchange="Regiones.cargarOficinaPorProvincia(this.value,'oficina')">
                                               <option value="0">-- Seleccione --</option>
                                        </select>

                               </div>
                            </div>  -->

                            <!-- <div class="col-md-2 col-md-offset-1">
                                <div class="form-group">
                                    <label class="control-label required">Oficina (*)</label>
                                        <select class="form-control" id="oficina" name="oficina">
                                                   <option value="0">-- Seleccione --</option>                                                  
                                        </select>

                                </div>
                            </div> -->

                            <!-- <div class="col-md-2 col-md-offset-1">
                                <div class="form-group">
                                    <label class="control-label required">Tipo Actividad (*)</label>
                                        <select class="form-control" id="tipo_actividad" name="tipo_actividad">
                                            <option value="0">-- Seleccione --</option>
                                                         {foreach from=$TipoActividad item=it}
                                                 <option value="{$it->id_tipo_actividad}">{$it->nombre_tipo_actividad}</option>
                                                         {/foreach}                
                                        </select>

                               </div>
                            </div> -->

                            <div class="col-md-12 ">
                                <!-- <label  class="control-label required">Código (*)</label>
                                <div class="form-group">                        
                                    <div class="col-md-12">
                                            <input class="form-control" 
                                                   name="codigo" id="codigo" placeholder="Código"></input>
                                    </div>
                                </div> -->
                                
                                <label  class="control-label required">Nombre (*)</label>
                                <div class="form-group">                        
                                    <div class="col-md-6">
                                            <input class="form-control" 
                                                   name="nombre" id="nombre" placeholder="Nombre"></input>
                                    </div>
                                </div>
                                
                                {*<button type="button" class="btn btn-success pull-right btn-flat" 
                                    onclick="MantenedorPlanificacion.guardarNuevoEvento(this.form,this);">
                                Guardar
                                </button>*}
                                <button type="button" class="btn btn-success btn-flat" 
                                    onclick="Administracion.guardarRegion(this.form,this);">
                                Guardar
                                </button>
                                <br><br><br>
                                
                                <div class="top-spaced table-responsive" id="contenedor-grilla-asignados">
                                    {include file="Administracion/Regiones/grilla_regiones.tpl"}
                                </div>
                            </div>

                            <!-- <div class="col-md-6 ">
                                <label  class="control-label required">Nombre (*)</label>
                                    <div class="form-group">                        
                                        <div class="col-md-12">
                                                <input class="form-control" 
                                                       name="nombre" id="nombre" placeholder="Nombre"></input>
                                        </div>
                                    </div>
                            </div> -->
			
                            <!-- 
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label  class="control-label required">Para (*)</label>
                                        <div class="ui-widget">
                                                <input class="form-control" name="invitacion" id="skills" size="1000" placeholder="Invitacion"></input>
                                        </div>
                                /div>	
                            </div>

                            <div class="col-md-2">
                                <div class="form-group clearfix">
                                    <label  class="control-label required">Fecha Inicio (*)</label>
                                        <div class="form-group">
                                                <div class="col-md-12">
                                                        <input type="date" name="fecha_inicio" id="fecha_inicio" >
                                                </div>
                                        </div>
                                </div>
                            </div>
				
                            <div class="col-md-3">
                                <div class="form-group clearfix">
                                    <label  class="control-label required">Hora de inicio (*)</label>
                                        <div class="form-group">
                                                <div class="col-md-12">
                                                        <input type="time" name="hora_inicio"  id="hora_inicio" >
                                                </div>
                                        </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group clearfix">
                                    <label  class="control-label required">Fecha Termino (*)</label>
                                    <div class="form-group">
                                            <div class="col-md-12">
                                                    <input type="date" name="fecha_termino" id="fecha_termino" >
                                            </div>
                                    </div>
                                </div>
                            </div>       			
	 
                            <div class="col-md-3">
                                    <div class="form-group clearfix">
                                                    <label  class="control-label required">Hora Termino (*)</label>
                                                            <div class="form-group">
                                                                    <div class="col-md-12">
                                                                            <input type="time" name="hora_termino"  id="hora_termino" >
                                                                    </div>
                                                            </div>
                                    </div>
                            </div> -->
				
                            <!-- Campos carga Automatica -->
                            <!-- <input  type="hidden" name="id_usuario" id="id_usuario" value="{$id_usuario}"></input> -->

                            {*<button type="button" class="btn btn-success pull-right btn-flat" 
                                    onclick="MantenedorPlanificacion.guardarNuevoEvento(this.form,this);">
                                Guardar
                            </button>*}
                        </form>
                        
                        
                        
		</div>
                        
	</div>    
</section>