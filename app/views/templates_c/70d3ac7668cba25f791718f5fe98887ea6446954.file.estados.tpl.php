<?php /* Smarty version Smarty-3.1.18, created on 2017-01-20 11:44:02
         compiled from "/var/www/html/mordedores/app/views/templates/avanzados/estados.tpl" */ ?>
<?php /*%%SmartyHeaderCode:94478894358822232e1be62-09673265%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '70d3ac7668cba25f791718f5fe98887ea6446954' => 
    array (
      0 => '/var/www/html/mordedores/app/views/templates/avanzados/estados.tpl',
      1 => 1484854629,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '94478894358822232e1be62-09673265',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'base_url' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_58822232e2e162_61743425',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58822232e2e162_61743425')) {function content_58822232e2e162_61743425($_smarty_tpl) {?><?php if (!is_callable('smarty_function_grilla')) include '/var/www/html/mordedores/app/views/templates/mantenedor_avanzados/grilla_estado/plugins/function.grilla.php';
?><link href="<?php echo @constant('STATIC_FILES');?>
template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo @constant('STATIC_FILES');?>
template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<section class="content-header">
    <h1>Estados
        <small>Administración</small>
    </h1>

</section>

<section class="content">
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Mantenedor de estados</h3>
            <button class="btn btn-sm btn-success btn-flat pull-right"
                    onClick="location.href='<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/Estados/nuevo_estado'">
                <i class="fa fa-plus"></i> Nuevo estado
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
