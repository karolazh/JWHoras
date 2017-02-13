<?php /* Smarty version Smarty-3.1.18, created on 2017-02-01 16:31:36
         compiled from "/var/www/html/mordedores/app/views/templates/mantenedor_avanzados/editar_estado.tpl" */ ?>
<?php /*%%SmartyHeaderCode:206976396858923798d4c3f0-00253567%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '46ff3f351ef275f2f3b920dc363d71979539cd7b' => 
    array (
      0 => '/var/www/html/mordedores/app/views/templates/mantenedor_avanzados/editar_estado.tpl',
      1 => 1484854629,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '206976396858923798d4c3f0-00253567',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_58923798d5b616_69446493',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58923798d5b616_69446493')) {function content_58923798d5b616_69446493($_smarty_tpl) {?><section class="content-header">
    <h1>Estados <small>Administración</small></h1>
</section>

<section class="content">
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Editar estado <small>(*) Campos requeridos</small></h3>
        </div>
        <div class="box-body">
            <?php echo $_smarty_tpl->getSubTemplate ("mantenedor_avanzados/formEstados.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

        </div>
    </div>
</section>

<?php }} ?>
