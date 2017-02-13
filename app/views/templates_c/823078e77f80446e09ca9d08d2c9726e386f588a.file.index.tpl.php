<?php /* Smarty version Smarty-3.1.18, created on 2017-01-20 11:44:00
         compiled from "/var/www/html/mordedores/app/views/templates/mantenedor_usuarios/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1237501595588222301553e9-05609389%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '823078e77f80446e09ca9d08d2c9726e386f588a' => 
    array (
      0 => '/var/www/html/mordedores/app/views/templates/mantenedor_usuarios/index.tpl',
      1 => 1484854629,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1237501595588222301553e9-05609389',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'base_url' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_588222301696e9_02172485',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_588222301696e9_02172485')) {function content_588222301696e9_02172485($_smarty_tpl) {?><?php if (!is_callable('smarty_function_grilla')) include '/var/www/html/mordedores/app/views/templates/mantenedor_usuarios/plugins/function.grilla.php';
?><link href="<?php echo @constant('STATIC_FILES');?>
template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo @constant('STATIC_FILES');?>
template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<section class="content-header">
    <h1>Usuarios
        <small>Administración</small>
    </h1>

</section>

<section class="content">
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Mantenedor de usuarios</h3>
            <button class="btn btn-sm btn-success btn-flat pull-right"
                    onClick="location.href='<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/MantenedorUsuarios/nuevo'">
                <i class="fa fa-plus"></i> Nuevo usuario
            </button>
        </div>
        <div class="box-body">
            <div id="div_tabla" class="table-responsive small">
                <?php echo smarty_function_grilla(array(),$_smarty_tpl);?>

            </div>
        </div>
    </div>
</section>

<?php }} ?>
