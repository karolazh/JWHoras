<?php /* Smarty version Smarty-3.1.18, created on 2017-02-14 14:41:30
         compiled from "/var/www/html/prevencion/app/views/templates/login/recuperar_password.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1847601525589ccc5b9ecc25-55496770%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ccf1e1e105d29bab4d4e2f93ae7b1023688b52c7' => 
    array (
      0 => '/var/www/html/prevencion/app/views/templates/login/recuperar_password.tpl',
      1 => 1486994782,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1847601525589ccc5b9ecc25-55496770',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_589ccc5ba008d6_86875938',
  'variables' => 
  array (
    'static' => 0,
    'base_url' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_589ccc5ba008d6_86875938')) {function content_589ccc5ba008d6_86875938($_smarty_tpl) {?><!DOCTYPE html>
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
                    </div>
                    <div class="portlet portlet-green">
                        <div class="portlet-body">
                            <form role="form" action="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/Login/procesar" method="post" id="loginForm">
                                <fieldset>
                                    <div class="alert alert-warning">
                                        Para recuperar su contraseña, ingrese su Rut.
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control mailbox-attachment" 
                                               name="mail" id="mail" placeholder="Ingrese su Rut"/>
                                    </div>
                                    <br>
                                    <div id="form-error" class="alert alert-danger hidden">
                                        <i class="fa fa-warning fa-2x"></i> &nbsp; No se encontro un usuario para el Rut ingresado.
                                    </div>
                                    
                                    <button id="enviar" class="btn btn-lg btn-primary btn-block" type="button">Enviar</button>                                    
                                    
                                </fieldset>
                                <br>
                                
                                <div class="form-group">
                                    <p class="text-center">
                                        <a href="javascript:history.back();">Volver</a>
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
