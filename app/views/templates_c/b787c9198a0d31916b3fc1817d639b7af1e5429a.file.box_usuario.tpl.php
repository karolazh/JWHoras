<?php /* Smarty version Smarty-3.1.18, created on 2017-02-13 12:11:34
         compiled from "/srv/http/prevencion/app/views/plugins/view/box_usuario.tpl" */ ?>
<?php /*%%SmartyHeaderCode:206409172558a1cca62e5075-00479186%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b787c9198a0d31916b3fc1817d639b7af1e5429a' => 
    array (
      0 => '/srv/http/prevencion/app/views/plugins/view/box_usuario.tpl',
      1 => 1486994086,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '206409172558a1cca62e5075-00479186',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'usuario' => 0,
    'rut' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_58a1cca62fab71_70671643',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58a1cca62fab71_70671643')) {function content_58a1cca62fab71_70671643($_smarty_tpl) {?><li class="dropdown user user-menu">
    <!-- Menu Toggle Button -->
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <!-- The user image in the navbar-->
        <i class="fa fa-user" alt="User Image"></i>
        <!-- hidden-xs hides the username on small devices so only the image appears. -->
        <span class="hidden-xs"><?php echo $_smarty_tpl->tpl_vars['usuario']->value;?>
</span>
    </a>
    <ul class="dropdown-menu">
        <!-- The user image in the menu -->
        <li class="user-header">
            <i  class="fa fa-user fa-3x img-circle" alt="User Image"></i>
            <p>
                
                <a href="<?php echo @constant('BASE_URI');?>
/Login/actualizar" class="h4">
                    <?php echo $_smarty_tpl->tpl_vars['usuario']->value;?>
 <br/> <?php echo $_smarty_tpl->tpl_vars['rut']->value;?>

                </a>
            </p>
        </li>

        <!-- Menu Footer-->
        <li class="user-footer">
            
            <div class="pull-right">
                <a href="<?php echo @constant('BASE_URI');?>
/Login/logoutUsuario" class="btn btn-default btn-flat">Cerrar Sesión</a>
            </div>
        </li>
    </ul>
</li><?php }} ?>
