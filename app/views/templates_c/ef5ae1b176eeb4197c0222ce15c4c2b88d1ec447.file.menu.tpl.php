<?php /* Smarty version Smarty-3.1.18, created on 2017-02-13 10:03:19
         compiled from "/var/www/html/prevencion/app/views/plugins/view/menu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1608956436589cd397e61669-39292186%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ef5ae1b176eeb4197c0222ce15c4c2b88d1ec447' => 
    array (
      0 => '/var/www/html/prevencion/app/views/plugins/view/menu.tpl',
      1 => 1486755958,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1608956436589cd397e61669-39292186',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_589cd397e8fa51_06900154',
  'variables' => 
  array (
    'base_url' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_589cd397e8fa51_06900154')) {function content_589cd397e8fa51_06900154($_smarty_tpl) {?><li>
    <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/Home/dashboard">
        <i class="fa fa-home"></i> <span>Inicio</span></a>
</li>
<li>
    <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/Home/dashboard">
        <i class="fa fa-plus"></i> <span>DAU</span></a>
</li>
<li>
    <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/Home/dashboard">
        <i class="fa fa-medkit"></i> <span>EMPA</span></a>
</li>
<li>
    <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/Home/dashboard">
        <i class="fa fa-hospital-o"></i> <span>Ficha</span></a>
</li>
<li>
    <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/Home/dashboard">
        <i class="fa fa-bar-chart"></i> <span>Reportes</span></a>
</li>
<li>
    <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/Home/dashboard">
        <i class="fa  fa-file-text-o"></i> <span>Exámenes</span></a>
</li>
<?php if ($_SESSION['perfil']==1) {?>
<li>
    <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/Home/dashboard">
        <i class="fa fa-cog"></i> <span>Administración</span></a>
        <ul class="treeview-menu">
            <li>
                <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/Home/dashboard">
                    <i class="fa fa-plus-circle"></i> <span>Mantenedores</span></a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/Administracion/regiones">
                                <i class="fa fa-plus-circle"></i> <span>Noticias</span></a>
                        </li>
                    </ul>
            </li>
        </ul>
</li>
<?php }?>




<br/><br/><br/><br/><?php }} ?>
