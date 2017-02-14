<?php /* Smarty version Smarty-3.1.18, created on 2017-01-31 11:24:07
         compiled from "/var/www/html/mordedores/app/views/templates/login/recuperar_password.tpl" */ ?>
<?php /*%%SmartyHeaderCode:173711331958822585f2e246-12994740%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '229fa5e73d4a704fce74eefafa44a6bd65c31bd1' => 
    array (
      0 => '/var/www/html/mordedores/app/views/templates/login/recuperar_password.tpl',
      1 => 1485869180,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '173711331958822585f2e246-12994740',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_58822585f3f588_65652933',
  'variables' => 
  array (
    'static' => 0,
    'base_url' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58822585f3f588_65652933')) {function content_58822585f3f588_65652933($_smarty_tpl) {?><!DOCTYPE html>
<html lang="es">
<head>
    <?php echo $_smarty_tpl->getSubTemplate ("layout/css.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

</head>
    <body class="body-login">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="login-banner text-left">
                        <h1 class="text-center"><img src="<?php echo $_smarty_tpl->tpl_vars['static']->value;?>
images/seremi_1.png" />&nbsp;&nbsp;&nbsp;FACTURACIÓN</h1>
                    </div>
                    <div class="portlet portlet-green">
                        <div class="portlet-body">
                            <div id="form-success" class="hidden">
                                <div id="mensaje-modificacion" class="alert alert-success">
                                    
                                </div>
                                <button onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
'" class="btn btn-lg btn-primary btn-block" type="button">Continuar <i class="fa fa-forward"></i></button>

                            </div>
                            <div id="form-contenedor">
                                <form id="form" name="form" role="form" method="post">
                                    <fieldset>
                                        <div class="alert alert-warning">
                                            Para recuperar su contraseña, ingrese su correo electrónico.
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" name="email" id="email" type="text" placeholder="ejemplo@email.com" />
                                        </div>
                                      <!--  <div class="form-group">
                                            <input class="form-control rut" name="rut" id="rut" type="text" placeholder="Escriba su RUT"/>
                                        </div>
-->
                                        <div id="form-error" class="alert alert-danger hidden">
                                            <i class="fa fa-warning fa-2x"></i> &nbsp; No se encontro un usuario para el correo ingresado.
                                        </div>

                                        <br>
                                        <button id="enviar" class="btn btn-lg btn-primary btn-block" type="button">Enviar email</button>
                                        <a href="javascript:history.back();" class="pull-right">Volver</a>

                                    </fieldset>
                                    <br>                                
                                </form>   
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php echo $_smarty_tpl->getSubTemplate ("layout/js.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

    </body>
</html><?php }} ?>
