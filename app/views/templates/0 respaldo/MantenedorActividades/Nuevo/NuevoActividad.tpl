<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />


<section class="content-header">
    <h1>Planificacion de actividades</h1>
        <ol class="breadcrumb">
           <li><a href="{$base_url}/MantenedorPlanificacion"><i class="fa fa-folder-open"></i>Planificacion de actividades</a></li>
            <li class="active">Nueva actividad</>
        </ol>
</section>

<section class="content">
	<div class="box box-primary">
		<div class="box-body">	
			<form role="form" class="form-horizontal">	
				<div class="col-md-2">
					<div class="form-group clearfix">
						<label class="control-label required">Region (*)</label>                    
								<select class="form-control" id="region" name="region"> 
										 <option value="0">-- Seleccione --</option>
											{foreach from=$Regiones item=it}
										<option value="{$it->id_region}">{$it->nombre_region}</option>
											{/foreach}                
								</select>
						<span class="help-block hidden"></span>
					</div>
				</div>

				<div class="col-md-2 col-md-offset-1">
					<div class="form-group clearfix">
							 <label class="control-label required">Provincia (*)</label>
								 <select class="form-control" id="provincias" name="provincias">
									   <option value="0">-- Seleccione --</option>
											{foreach from=$Provincias item=it}
										<option value="{$it->id_provincia}">{$it->nombre_provincias}</option>
											{/foreach}                
								</select>
						 <span class="help-block hidden"></span>
					</div>
				</div>              

				<div class="col-md-2 col-md-offset-1">
					<div class="form-group clearfix">
							<label class="control-label required">Oficina</label>
							<select class="form-control" id="oficina" name="oficina">
								   <option value="0">-- Seleccione --</option>
										{foreach from=$Oficinas item=it}
									<option value="{$it->id_oficina}">{$it->nombre_oficina}</option>
										{/foreach}                
							</select>
						 <span class="help-block hidden"></span>
					</div>
				</div> 

				<div class="col-md-2 col-md-offset-1">
					<div class="form-group clearfix">
						<label class="control-label required">Tipo Actividad (*)</label>
							<select class="form-control" id="tipo_actividad" name="tipo_actividad">
								   <option value="0">-- Seleccione --</option>
										{foreach from=$TipoActividad item=it}
								    <option value="{$it->id_tipo_actividad}">{$it->nombre_tipo_actividad}</option>
										{/foreach}                
							</select>
						<span class="help-block hidden"></span>
					</div>
				</div> 

				<div class="col-md-6 ">
					<label  class="control-label required">Actividad</label>
						<div class="form-group">                        
							<div class="col-md-12">
								<input class="form-control" name="actividad" id="actividad" placeholder="Actividad"></input>
							</div>
						</div>
				</div>
			
				<div class="col-md-6">
					<label  class="control-label required">Para (*)</label>
						<div class="form-group">                        
								<div class="col-md-12">
									<input class="form-control" name="invitacion" id="invitacion" placeholder="Invitacion"> </input>
								</div>
						</div>
					</div>

				<div class="col-md-2">
					<div class="form-group clearfix">
							<label  class="control-label required">Fecha Inicio</label>
								<div class="form-group">
									<div class="col-md-12">
									<input type="date" name="fecha_inicio" id="fecha_inicio" >
									</div>
								</div>
						<span class="help-block hidden"></span>
					</div>
				</div>

				<div class="col-md-3">
					<div class="form-group clearfix">
							<label  class="control-label required">Fecha Termino</label>
								<div class="form-group">
									<div class="col-md-12">
									<input type="date" name="fecha_termino" id="fecha_termino" >
									</div>
								</div>
						<span class="help-block hidden"></span>
					</div>
				</div>                			
	 
				<div class="col-md-3">
					<div class="form-group clearfix">
							<label  class="control-label required">Hora de inicio:</label>
								<div class="form-group">
									<div class="col-md-12">
									<input type="time" name="hora_inicio"  id="hora_inicio" >
									</div>
								</div>
						<span class="help-block hidden"></span>
					</div>
				</div>
				

				<div class="col-md-3 col-md-offset-1">
					<div class="form-group clearfix">
								<label  class="control-label required">Hora Termino</label>
								<div class="form-group">
									<div class="col-md-12">
									<input type="time" name="hora_termino"  id="hora_termino" >
									</div>
								</div>
						<span class="help-block hidden"></span>
					</div>
				</div>

				
				<!-- Campos carga Automatica -->
				<input  type="hidden" name="id_usuario" id="id_usuario" value="{$id_usuario}"></input>

				 <button type="button" class="btn btn-success pull-right btn-flat" onclick="MantenedorPlanificacion.guardarNuevoEvento(this.form,this);">Guardar Actividad</button>
			</form>
		</div>
	</div>    
</section>
