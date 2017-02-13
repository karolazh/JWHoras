<?php /* Smarty version Smarty-3.1.18, created on 2017-01-20 11:43:54
         compiled from "/var/www/html/mordedores/app/views/templates/Solicitudes/Mantenedores/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:7355100815882222a8b5d53-70487352%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '801851ac9ddd3a74d1f9f6081f1d7e0031786082' => 
    array (
      0 => '/var/www/html/mordedores/app/views/templates/Solicitudes/Mantenedores/index.tpl',
      1 => 1484856480,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7355100815882222a8b5d53-70487352',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'base_url' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_5882222a8cf186_50806707',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5882222a8cf186_50806707')) {function content_5882222a8cf186_50806707($_smarty_tpl) {?><?php if (!is_callable('smarty_function_grilla')) include '/var/www/html/mordedores/app/views/templates/Solicitudes/Mantenedores/plugins/function.grilla.php';
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
            <h3 class="box-title">Mantenedor de Solicitudes</h3>
            <button class="btn btn-sm btn-success btn-flat pull-right"
                    onClick="location.href='<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/Solicitudes/Nuevo'">
                <i class="fa fa-plus"></i> Nueva Solicitud
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
