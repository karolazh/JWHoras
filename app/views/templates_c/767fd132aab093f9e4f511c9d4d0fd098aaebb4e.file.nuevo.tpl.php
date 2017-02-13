<?php /* Smarty version Smarty-3.1.18, created on 2017-01-20 11:43:47
         compiled from "/var/www/html/mordedores/app/views/templates/Solicitudes/Nuevo/nuevo.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1632922623588222232e33f4-82591479%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '767fd132aab093f9e4f511c9d4d0fd098aaebb4e' => 
    array (
      0 => '/var/www/html/mordedores/app/views/templates/Solicitudes/Nuevo/nuevo.tpl',
      1 => 1484856480,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1632922623588222232e33f4-82591479',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'static' => 0,
    'lista_proyectos' => 0,
    'item' => 0,
    'prioridad' => 0,
    'trabajadores' => 0,
    'fecha_creacion_controller' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_58822223319ba8_00001467',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58822223319ba8_00001467')) {function content_58822223319ba8_00001467($_smarty_tpl) {?><link href="<?php echo $_smarty_tpl->tpl_vars['static']->value;?>
template/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css"/>

<section class="content-header">
    <h1>Nuevo Registro
        <small>Ingresar nueva solicitud</small>
    </h1>
</section>

<section class="content">
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Formulario de Registro</h3>
        </div>
        <div class="box-body">
            <form role="form" class="form-horizontal">
                <div class="row">
                    <div class="col-md-6 top-spaced">
                        <div class="margin-bottom-10"></div>

                        <div class="form-group">
                            <label  class="col-lg-4 control-label">Proyecto</label>
                            <div class="col-lg-8">
                               <select class="form-control" id="id_proyecto" name="id_proyecto">
                                    <option value="0">-- Seleccione --</option>
                                    <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['lista_proyectos']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                                        <option value="<?php echo $_smarty_tpl->tpl_vars['item']->value->id_proyecto;?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value->gl_nombre_proyecto;?>
</option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label  class="col-lg-4 control-label">Asunto</label>
                            <div class="col-lg-8">
                                <input class="form-control" name="nombre" id="nombre" placeholder="Ingrese asunto"> </input>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="col-lg-4 control-label">Fecha de entrega</label>
                            <div class="col-md-3 col-xs-12">
                                <div class="input-group">
                                    <input type="text" class="form-control datepicker" readonly
                                           style="border-radius: 0" id="fc_fecha_entrega"
                                           name="fc_fecha_entrega"
                                           placeholder="">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 top-spaced">
                        <div class="margin-bottom-10"></div>
                        <div class="form-group">
                            <label for="exampleInputPassword1" class="col-lg-4 control-label">Prioridad</label>
                            <div class="col-lg-8">
                                <select class="form-control" id="id_prioridad" name="id_prioridad">
                                    <option value="0">-- Seleccione --</option>
                                    <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['prioridad']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                                        <option value="<?php echo $_smarty_tpl->tpl_vars['item']->value->id;?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value->gl_descripcion;?>
</option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1" class="col-lg-4 control-label">Asignar a</label>
                            <div class="col-lg-8">
                                <select class="form-control" id="cd_id_usuario" name="cd_id_usuario">
                                    <option value="0">-- Seleccione --</option>
                                    <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['trabajadores']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                                        <option value="<?php echo $_smarty_tpl->tpl_vars['item']->value->id;?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value->nombres;?>
 <?php echo $_smarty_tpl->tpl_vars['item']->value->apellidos;?>
</option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="row top-spaced margin-bottom-10">
                    <div class="col-xs-12 top-spaced">

                        <div class="form-group">
                            <label for="exampleInputEmail1"
                                   class="col-xs-12  col-md-2 control-label">Comentario</label>
                            <div class="col-xs-12 col-md-10">
                                <textarea class="form-control form-control-textarea" name="gl_comentario" id="gl_comentario"
                                          rows="10"></textarea>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="top-spaced">

                    <div class="box box-info">
                        <div class="box-header">
                            Archivos adjuntos
                            <button type="button" class="btn btn-success btn-xs btn-flat"
                                    onClick="xModal.open('<?php echo @constant('BASE_URI');?>
/Solicitudes/adjuntarArchivo','Adjuntar Archivos',50,'adjuntar',true,280);">
                                <i class="fa fa-upload"></i></button>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive" id="lista_adjuntos"></div>
                        </div>
                    </div>
                </div>


                <div class="margin-bottom-10"></div>
                <!-- Campos carga Automatica -->
                <input  type="hidden" name="fc_fecha_creacion" id="fc_fecha_creacion" value="<?php echo $_smarty_tpl->tpl_vars['fecha_creacion_controller']->value;?>
"></input>
                <input  type="hidden" name="fc_fecha_termino" id="fc_fecha_termino" value="0"></input>
                <input  type="hidden" name="cd_id_estado" id="cd_id_estado" value="1"></input>
                <input  type="hidden" name="fc_fecha_diferencia" id="fc_fecha_diferencia" value="0"></input>

                <button type="button" class="btn btn-success pull-right btn-flat"
                        onclick="Solicitudes.guardarNuevaSolicitud(this.form,this);">
                    Guardar Solicitud
                </button>


            </form>
        </div>
    </div>
</section><?php }} ?>
