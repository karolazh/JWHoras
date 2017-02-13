<?php /* Smarty version Smarty-3.1.18, created on 2017-02-01 16:31:10
         compiled from "/var/www/html/mordedores/app/views/templates/mantenedor_avanzados/nuevo_estado.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12411808275892377e2aaf56-87683547%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '22adb4e25336efd1fa595ed80cb8fa12110c9f9d' => 
    array (
      0 => '/var/www/html/mordedores/app/views/templates/mantenedor_avanzados/nuevo_estado.tpl',
      1 => 1484854629,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12411808275892377e2aaf56-87683547',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_5892377e2bda42_61200014',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5892377e2bda42_61200014')) {function content_5892377e2bda42_61200014($_smarty_tpl) {?><section class="content-header">
    <h1>Estados <small>Administración</small></h1>
</section>

<section class="content">
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Nuevo estado <small>(*) Campos requeridos</small></h3>
           
        </div>
        <div class="box-body">
            <?php echo $_smarty_tpl->getSubTemplate ("mantenedor_avanzados/form_estados.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

        </div>
    </div>
</section>
<?php }} ?>
