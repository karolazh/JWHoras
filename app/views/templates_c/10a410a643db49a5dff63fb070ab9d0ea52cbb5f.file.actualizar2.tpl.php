<?php /* Smarty version Smarty-3.1.18, created on 2017-02-01 14:16:21
         compiled from "/var/www/html/mordedores/app/views/templates/login/actualizar2.tpl" */ ?>
<?php /*%%SmartyHeaderCode:816753831588f9cf692c321-18520635%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '10a410a643db49a5dff63fb070ab9d0ea52cbb5f' => 
    array (
      0 => '/var/www/html/mordedores/app/views/templates/login/actualizar2.tpl',
      1 => 1485969378,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '816753831588f9cf692c321-18520635',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_588f9cf6948fb5_53595447',
  'variables' => 
  array (
    'nombre' => 0,
    'rut' => 0,
    'mail' => 0,
    'fono' => 0,
    'celular' => 0,
    'comuna' => 0,
    'provincia' => 0,
    'region' => 0,
    'item' => 0,
    'base_url' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_588f9cf6948fb5_53595447')) {function content_588f9cf6948fb5_53595447($_smarty_tpl) {?><section class="content-header">
    <h1>Cuenta</h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12 col-md-6">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Datos de Usuario</h3>
                </div>
                <div class="box-body">
                    <label class="control-label required">Nombre</label><br>
                    <?php echo $_smarty_tpl->tpl_vars['nombre']->value;?>

                    <br/><br/>
                    <label class="control-label required">RUT</label><br>
                    <?php echo $_smarty_tpl->tpl_vars['rut']->value;?>

                    <br/><br/>
                    <label class="control-label required">Email</label><br>
                    <?php echo $_smarty_tpl->tpl_vars['mail']->value;?>

                    <br/><br/>
                    <label class="control-label required">Fono</label><br>
                    <?php echo $_smarty_tpl->tpl_vars['fono']->value;?>

                    <br/><br/>
                    <label class="control-label required">Celular</label><br>
                    <?php echo $_smarty_tpl->tpl_vars['celular']->value;?>

                    <br/><br/>
                    <label class="control-label required">Comuna</label><br>
                    <?php echo $_smarty_tpl->tpl_vars['comuna']->value;?>

                    <br/><br/>
                    <label class="control-label required">Provincia</label><br>
                    <?php echo $_smarty_tpl->tpl_vars['provincia']->value;?>

                    <br/><br/>
                    <label class="control-label required">Regi&oacute;n</label><br>
                    <?php echo $_smarty_tpl->tpl_vars['region']->value;?>

                    <br/><br/>
                </div>
            </div>
        </div>
        
        <div class="col-xs-12 col-md-6">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Actualización de Contraseña</h3>
                </div>
                <div class="box-body">
                    <form  id="form" name="form" enctype="application/x-www-form-urlencoded" action="" method="post">
                        <input type="hidden" name="id" id="id" value="<?php echo $_smarty_tpl->tpl_vars['item']->value->id;?>
"/>
                        <div class="col-md-6 text-left">
                            <div class="form-group clearfix">
                                <label for="password" class="control-label required">Nueva contraseña (*)</label>
                                <input type="password" name="password" id="password" value="" class="form-control"/>
                                <span class="help-block hidden"></span>
                            </div>
                        </div>
                        <div class="col-md-6 text-left">
                            <div class="form-group clearfix">
                                <label for="password_repetido" class="control-label required">Repita la nueva contraseña (*)</label>
                                <input type="password" name="password_repetido" id="password_repetido" value="" class="form-control"/>
                                <span class="help-block hidden"></span>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div id="form-error" class="alert alert-danger hidden">
                            <i class="fa fa-warning fa-2x"></i> &nbsp; 
                            <strong> ¡Error! </strong> Existen problemas en los datos, revise los campos en rojo.
                        </div>
                        <div id="form-ok" class="alert alert-warning hidden">
                            <i class="fa fa-info-circle"></i> &nbsp; 
                            La contraseña ha sido actualizada.
                        </div>
                        <div class="col-md-12 text-right">
                            <button type="button" id="guardar" class="btn btn-success btn-sm">
                                <i class="fa fa-save"></i> Guardar
                            </button>
                            <button type="button" id="cancelar" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/Home/dashboard'" class="btn btn-default btn-sm">
                                <i class="fa fa-remove"></i> Cancelar 
                            </button>
                            <br/><br/>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</section><?php }} ?>
