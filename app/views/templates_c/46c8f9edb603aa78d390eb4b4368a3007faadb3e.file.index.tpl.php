<?php /* Smarty version Smarty-3.1.18, created on 2017-02-06 12:11:15
         compiled from "/var/www/html/mordedores/app/views/templates/Administracion/Provincias/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:138592939588278044b9b48-07278377%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '46c8f9edb603aa78d390eb4b4368a3007faadb3e' => 
    array (
      0 => '/var/www/html/mordedores/app/views/templates/Administracion/Provincias/index.tpl',
      1 => 1486147495,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '138592939588278044b9b48-07278377',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_588278044e9c97_31869545',
  'variables' => 
  array (
    'base_url' => 0,
    'Regiones' => 0,
    'it' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_588278044e9c97_31869545')) {function content_588278044e9c97_31869545($_smarty_tpl) {?><link href="<?php echo @constant('STATIC_FILES');?>
template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo @constant('STATIC_FILES');?>
template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<section class="content-header">
    <h1>Mantenedor de Provincias</h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/Administracion">
            <i class="fa fa-folder-open"></i>Mantenedor de Provincias</a></li>
            <li class="active">Nueva Provincia</>
        </ol>
</section>

<section class="content">
	<div class="box box-primary">
		<div class="box-body">
		
			 <form role="form" class="form-horizontal">
                            <div class="col-md-2">
                                <div class="form-group">
                                </div>
                                
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

                            <div class="col-md-6 ">
                            </div>
                                                           
                            <table id="tablaPrincipal" class="table table-hover table-striped table-bordered  table-middle dataTable no-footer">
                                <thead>
                                    <tr role="row">
                                        <th align="center"># ID</th>
                                        <th align="center">Nombre</th>
                                        <th width="1px" align="center">Acciones</th>
                                    </tr>
                                </thead>
                                
                            </table>
                            
		</div>
	</div>    
</section><?php }} ?>
