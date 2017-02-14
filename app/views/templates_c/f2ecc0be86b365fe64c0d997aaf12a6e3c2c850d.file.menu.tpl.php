<?php /* Smarty version Smarty-3.1.18, created on 2017-02-13 12:11:34
         compiled from "/srv/http/prevencion/app/views/plugins/view/menu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:75471636358a1cca6300187-50961007%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f2ecc0be86b365fe64c0d997aaf12a6e3c2c850d' => 
    array (
      0 => '/srv/http/prevencion/app/views/plugins/view/menu.tpl',
      1 => 1486994086,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '75471636358a1cca6300187-50961007',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'base_url' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_58a1cca6322581_45260091',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58a1cca6322581_45260091')) {function content_58a1cca6322581_45260091($_smarty_tpl) {?><li>
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
