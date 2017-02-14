<?php /* Smarty version Smarty-3.1.18, created on 2017-02-13 11:18:50
         compiled from "/srv/http/prevencion/app/views/templates/layout/js.tpl" */ ?>
<?php /*%%SmartyHeaderCode:29118014958a1c04a7a7c81-72888434%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '63fe1f438529e7113c09c80f55d11d52441a10dc' => 
    array (
      0 => '/srv/http/prevencion/app/views/templates/layout/js.tpl',
      1 => 1486994086,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '29118014958a1c04a7a7c81-72888434',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'static' => 0,
    'js' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_58a1c04a7caaf1_96504441',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58a1c04a7caaf1_96504441')) {function content_58a1c04a7caaf1_96504441($_smarty_tpl) {?><?php if (!is_callable('smarty_function_js')) include '/srv/http/prevencion/app/views/plugins/function.js.php';
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
