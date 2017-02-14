<?php /* Smarty version Smarty-3.1.18, created on 2017-02-13 11:18:50
         compiled from "/srv/http/prevencion/app/views/templates/login/login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:141102165958a1c04a72b097-00680441%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '20d6be46c61d3ea62c9ed46c1570aa9aeb5b8424' => 
    array (
      0 => '/srv/http/prevencion/app/views/templates/login/login.tpl',
      1 => 1486994086,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '141102165958a1c04a72b097-00680441',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'static' => 0,
    'base_url' => 0,
    'hidden' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_58a1c04a78fb44_14331677',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58a1c04a78fb44_14331677')) {function content_58a1c04a78fb44_14331677($_smarty_tpl) {?><!DOCTYPE html>
<html lang="es">
<head>
    <?php echo $_smarty_tpl->getSubTemplate ("layout/css.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

</head>
    <body class="body-login">
        <br/><br/><br/>
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="login-banner text-center">
                        <br/>
                        <img src="<?php echo $_smarty_tpl->tpl_vars['static']->value;?>
images/logo_minsal.png" />
                        <br/>
                        <h1 class="text-center">Prevenci&oacute;n de Femicidios</h1>
                        <h4>Inicio de sesión</h4>
                    </div>
                    <div class="portlet portlet-green">
                        <div class="portlet-body">
                            <form role="form" action="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/Login/procesar" method="post" id="loginForm">
                                <fieldset>
                                    
                                    <div class="form-group">
                                        <input type="text" class="form-control mailbox-attachment" 
                                               name="rut" id="mail" placeholder="Ingrese su Rut"/>
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
                                    <p class="text-center">
                                        <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/Login/recuperar_password">¿Olvidó su contraseña?</a>
                                    </p>
                                    
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
