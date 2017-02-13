<?php /* Smarty version Smarty-3.1.18, created on 2017-02-09 17:39:51
         compiled from "/var/www/html/prevencion/app/views/plugins/view/box_usuario.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1625109280589cd397e504b8-26843880%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2cc67ef7a158c95ea998b3dae2d4a8e5af99cb8e' => 
    array (
      0 => '/var/www/html/prevencion/app/views/plugins/view/box_usuario.tpl',
      1 => 1485975491,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1625109280589cd397e504b8-26843880',
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
  'unifunc' => 'content_589cd397e5e334_98490971',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_589cd397e5e334_98490971')) {function content_589cd397e5e334_98490971($_smarty_tpl) {?><li class="dropdown user user-menu">
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
