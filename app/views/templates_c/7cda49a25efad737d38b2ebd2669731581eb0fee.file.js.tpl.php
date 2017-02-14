<?php /* Smarty version Smarty-3.1.18, created on 2017-02-14 14:40:08
         compiled from "/var/www/html/prevencion/app/views/templates/layout/js.tpl" */ ?>
<?php /*%%SmartyHeaderCode:800287763589cc4e7158550-60043323%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7cda49a25efad737d38b2ebd2669731581eb0fee' => 
    array (
      0 => '/var/www/html/prevencion/app/views/templates/layout/js.tpl',
      1 => 1486994782,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '800287763589cc4e7158550-60043323',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_589cc4e716f5e7_96078281',
  'variables' => 
  array (
    'static' => 0,
    'js' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_589cc4e716f5e7_96078281')) {function content_589cc4e716f5e7_96078281($_smarty_tpl) {?><?php if (!is_callable('smarty_function_js')) include '/var/www/html/prevencion/app/views/plugins/function.js.php';
?><footer>
    <!-- jQuery 2.1.4 -->
    <script src="<?php echo $_smarty_tpl->tpl_vars['static']->value;?>
template/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo $_smarty_tpl->tpl_vars['static']->value;?>
template/bootstrap/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo $_smarty_tpl->tpl_vars['static']->value;?>
template/dist/js/app.min.js"></script>

    
    
    <script src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.1.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.1.2/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['static']->value;?>
js/plugins/select2.full.min.js"></script>
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['static']->value;?>
js/plugins/jquery.mask.js"></script>
	<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['static']->value;?>
js/plugins/jquery.colorbox.js"></script>
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['static']->value;?>
js/plugins/xmodal.js"></script>
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['static']->value;?>
js/base.js"></script>

    <?php echo smarty_function_js(array(),$_smarty_tpl);?>

    <?php echo $_smarty_tpl->tpl_vars['js']->value;?>

</footer><?php }} ?>
