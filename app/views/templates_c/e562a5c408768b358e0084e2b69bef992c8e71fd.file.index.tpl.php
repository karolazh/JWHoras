<?php /* Smarty version Smarty-3.1.18, created on 2017-02-06 12:11:11
         compiled from "/var/www/html/mordedores/app/views/templates/Administracion/Regiones/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:204839546958826038f3a710-42981931%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e562a5c408768b358e0084e2b69bef992c8e71fd' => 
    array (
      0 => '/var/www/html/mordedores/app/views/templates/Administracion/Regiones/index.tpl',
      1 => 1486147495,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '204839546958826038f3a710-42981931',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_5882603915fa17_40113101',
  'variables' => 
  array (
    'base_url' => 0,
    'Regiones' => 0,
    'it' => 0,
    'TipoActividad' => 0,
    'id_usuario' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5882603915fa17_40113101')) {function content_5882603915fa17_40113101($_smarty_tpl) {?><link href="<?php echo @constant('STATIC_FILES');?>
template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo @constant('STATIC_FILES');?>
template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<section class="content-header">
    <h1>Mantenedor de Regiones</h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/Administracion">
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
                                                           <?php  $_smarty_tpl->tpl_vars['it'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['it']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['Regiones']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['it']->key => $_smarty_tpl->tpl_vars['it']->value) {
$_smarty_tpl->tpl_vars['it']->_loop = true;
?>
                                                   <option value="<?php echo $_smarty_tpl->tpl_vars['it']->value->id_region;?>
"><?php echo $_smarty_tpl->tpl_vars['it']->value->nombre_region;?>
</option>
                                                           <?php } ?>                
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
                                                         <?php  $_smarty_tpl->tpl_vars['it'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['it']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['TipoActividad']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['it']->key => $_smarty_tpl->tpl_vars['it']->value) {
$_smarty_tpl->tpl_vars['it']->_loop = true;
?>
                                                 <option value="<?php echo $_smarty_tpl->tpl_vars['it']->value->id_tipo_actividad;?>
"><?php echo $_smarty_tpl->tpl_vars['it']->value->nombre_tipo_actividad;?>
</option>
                                                         <?php } ?>                
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
                                
                                
                                <button type="button" class="btn btn-success btn-flat" 
                                    onclick="Administracion.guardarRegion(this.form,this);">
                                Guardar
                                </button>
                                <br><br><br>
                                
                                <div class="top-spaced table-responsive" id="contenedor-grilla-asignados">
                                    <?php echo $_smarty_tpl->getSubTemplate ("Administracion/Regiones/grilla_regiones.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

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
                            <!-- <input  type="hidden" name="id_usuario" id="id_usuario" value="<?php echo $_smarty_tpl->tpl_vars['id_usuario']->value;?>
"></input> -->

                            
                        </form>
                        
                        
                        
		</div>
                        
	</div>    
</section><?php }} ?>
