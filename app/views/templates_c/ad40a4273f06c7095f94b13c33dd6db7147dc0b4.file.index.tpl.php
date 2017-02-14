<?php /* Smarty version Smarty-3.1.18, created on 2017-02-06 12:11:34
         compiled from "/var/www/html/mordedores/app/views/templates/Administracion/Especies/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:205812984758827bc0290898-99974581%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ad40a4273f06c7095f94b13c33dd6db7147dc0b4' => 
    array (
      0 => '/var/www/html/mordedores/app/views/templates/Administracion/Especies/index.tpl',
      1 => 1486147495,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '205812984758827bc0290898-99974581',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_58827bc02a79f3_13788062',
  'variables' => 
  array (
    'base_url' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58827bc02a79f3_13788062')) {function content_58827bc02a79f3_13788062($_smarty_tpl) {?><link href="<?php echo @constant('STATIC_FILES');?>
template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo @constant('STATIC_FILES');?>
template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<section class="content-header">
    <h1>Mantenedor de Especies</h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/Administracion">
            <i class="fa fa-folder-open"></i>Mantenedor de Especies</a></li>
            <li class="active">Nueva Especie</>
        </ol>
</section>

<section class="content">
	<div class="box box-primary">
		<div class="box-body">
		
			 <form role="form" class="form-horizontal">
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
                                <th width="1px" align="center">Acciones</th>
                            </tr>
                        </thead>
                        
                    </table>
                            
		</div>
	</div>    
</section><?php }} ?>
