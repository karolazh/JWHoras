<?php /* Smarty version Smarty-3.1.18, created on 2017-02-14 15:36:59
         compiled from "/srv/http/prevencion/app/views/templates/login/recuperar_password.tpl" */ ?>
<?php /*%%SmartyHeaderCode:52725248958a1ccbb9cb255-91345225%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9874bf2aa5f6137962719810d83a52e0b35eaab4' => 
    array (
      0 => '/srv/http/prevencion/app/views/templates/login/recuperar_password.tpl',
      1 => 1487097416,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '52725248958a1ccbb9cb255-91345225',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_58a1ccbba2ceb8_77204688',
  'variables' => 
  array (
    'base_url' => 0,
    'static' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58a1ccbba2ceb8_77204688')) {function content_58a1ccbba2ceb8_77204688($_smarty_tpl) {?><!DOCTYPE html>
<html lang="es">
<head>
    <?php echo $_smarty_tpl->getSubTemplate ("layout/css.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

    <script>
           var BASE_URI = '<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
' + '/';
    </script>
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
                            <div id="form-success" class="hidden">
                                <div id="mensaje-modificacion" class="alert alert-success">
                                </div>
                                <button onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
'" class="btn btn-lg btn-primary btn-block" 
                                        type="button">Continuar <i class="fa fa-forward"></i></button>
                            </div>
                            <div id="form-contenedor">
                            <form role="form" action="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/Login/procesar" method="post" id="form">
                                <fieldset>
                                    <div class="alert alert-warning">
                                        Para recuperar su contraseña, ingrese su Rut.
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" maxlength="13"
                                               onkeyup="formateaRut(this),validaRut(this)"
                                               name="rut" id="rut" placeholder="Ingrese su Rut"/>
                                    <br>
                                    <div id="form-error" class="alert alert-danger hidden">
                                        <i class="fa fa-warning fa-2x"></i> &nbsp; No se encontro un usuario para el Rut ingresado.
                                    </div>
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
        </div>
        <?php echo $_smarty_tpl->getSubTemplate ("layout/js.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

    </body>
</html><?php }} ?>
