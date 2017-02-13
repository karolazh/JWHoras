<?php /* Smarty version Smarty-3.1.18, created on 2017-02-06 12:11:38
         compiled from "/var/www/html/mordedores/app/views/templates/Administracion/Razas/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:212879938158827c0f9253d4-63183224%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c517aeae293e7491913e771f5d64fd52b35fe167' => 
    array (
      0 => '/var/www/html/mordedores/app/views/templates/Administracion/Razas/index.tpl',
      1 => 1486147495,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '212879938158827c0f9253d4-63183224',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_58827c0f945282_90862991',
  'variables' => 
  array (
    'base_url' => 0,
    'Regiones' => 0,
    'it' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58827c0f945282_90862991')) {function content_58827c0f945282_90862991($_smarty_tpl) {?><link href="<?php echo @constant('STATIC_FILES');?>
template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo @constant('STATIC_FILES');?>
template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<section class="content-header">
    <h1>Mantenedor de Razas</h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/Administracion">
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
                        
                    </table>
                            
		</div>
	</div>    
</section><?php }} ?>
