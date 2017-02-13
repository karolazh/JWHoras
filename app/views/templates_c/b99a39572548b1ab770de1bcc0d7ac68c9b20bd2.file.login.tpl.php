<?php /* Smarty version Smarty-3.1.18, created on 2017-02-03 18:10:27
         compiled from "/var/www/html/mordedores/app/views/templates/login/login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:7015792845881192e203407-79641685%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b99a39572548b1ab770de1bcc0d7ac68c9b20bd2' => 
    array (
      0 => '/var/www/html/mordedores/app/views/templates/login/login.tpl',
      1 => 1486147495,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7015792845881192e203407-79641685',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_5881192e32df57_86777843',
  'variables' => 
  array (
    'static' => 0,
    'base_url' => 0,
    'hidden' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5881192e32df57_86777843')) {function content_5881192e32df57_86777843($_smarty_tpl) {?><!DOCTYPE html>
<html lang="es">
<head>
    <?php echo $_smarty_tpl->getSubTemplate ("layout/css.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


</head>
    <body class="body-login">
        <br/><br/>
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="login-banner text-center">
                        <br/>
                        <img src="<?php echo $_smarty_tpl->tpl_vars['static']->value;?>
images/logo_minsal.png" />
                        <br/>
                        <h1 class="text-center" style="color:white">SIRAM</h1>
                        <h4 style="color:white">Inicio de sesión</h4>
                    </div>
                    <div class="portlet portlet-green">
                        <div class="portlet-body">
                            <form role="form" action="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/Login/procesar" method="post" id="loginForm">
                                <fieldset>
                                    
                                    <div class="form-group">
                                        <input type="text" class="form-control mailbox-attachment" 
                                               name="mail" id="mail" placeholder="Ingrese su Email"/>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" 
                                               name="password" id="password" placeholder="Ingrese su Contraseña"/>
                                    </div>
                                    <div class="form-group hide">
                                        <input type="checkbox" name="recordar" id="recordar" value="1"/> 
                                        Recordarme en este equipo
                                    </div>
                                    <div id="form-error" class="alert alert-danger <?php echo $_smarty_tpl->tpl_vars['hidden']->value;?>
">
                                        <i class="fa fa-warning fa-2x"></i> &nbsp; Los datos ingresados no son válidos.
                                    </div>
                                    <br>
                                    <button class="btn btn-lg btn-primary btn-block" type="submit">Ingresar</button>
                                </fieldset>
                                <br>
                                
                                <div class="form-group">
                                    <table style="width:100%;">
                                        <tr>
                                            <td>
                                                <p class="text-left">
                                                    <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/Login/obtener_cuenta" style="color:white">Obtener una cuenta</a>
                                                </p>
                                            </td>
                                            <td>
                                                <p class="text-right">
                                                    <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/Login/recuperar_password" style="color:white">¿Olvidó su contraseña?</a>
                                                </p>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php echo $_smarty_tpl->getSubTemplate ("layout/js.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

    </body>
</html><?php }} ?>
