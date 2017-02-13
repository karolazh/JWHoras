<?php /* Smarty version Smarty-3.1.18, created on 2017-02-07 10:20:06
         compiled from "/var/www/html/mordedores/app/views/templates/Vacunas/ver_registro.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2128111275894e95c9b2527-97827629%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bb0f91c8d2039f0eba76c440dbc68b95b5395ffb' => 
    array (
      0 => '/var/www/html/mordedores/app/views/templates/Vacunas/ver_registro.tpl',
      1 => 1486471669,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2128111275894e95c9b2527-97827629',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_5894e95c9cc169_41762445',
  'variables' => 
  array (
    'institucion' => 0,
    'responsable' => 0,
    'especie' => 0,
    'cantidad' => 0,
    'periodo' => 0,
    'agno' => 0,
    'comuna' => 0,
    'provincia' => 0,
    'region' => 0,
    'base_url' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5894e95c9cc169_41762445')) {function content_5894e95c9cc169_41762445($_smarty_tpl) {?><section class="content-header">
    <h1><i class="fa fa-plus"></i><span>&nbsp;Vacunas</span></h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12 col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Detalle de Vacuna Antirr&aacute;bica</h3>
                </div>
                <div class="box-body">
                    <br/>
                    <label class="control-label required">Instituci&oacute;n</label><br>
                    <?php echo $_smarty_tpl->tpl_vars['institucion']->value;?>

                    <br/><br/>
                    <label class="control-label required">Responsable</label><br>
                    <?php echo $_smarty_tpl->tpl_vars['responsable']->value;?>

                    <br/><br/>
                    <label class="control-label required">Especie</label><br>
                    <?php echo $_smarty_tpl->tpl_vars['especie']->value;?>

                    <br/><br/>
                    <label class="control-label required">Cantidad de vacunas</label><br>
                    <?php echo $_smarty_tpl->tpl_vars['cantidad']->value;?>

                    <br/><br/>
                    <label class="control-label required">Periodo</label><br>
                    <?php echo $_smarty_tpl->tpl_vars['periodo']->value;?>

                    <br/><br/>
                    <label class="control-label required">Año</label><br>
                    <?php echo $_smarty_tpl->tpl_vars['agno']->value;?>

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
                    <div class="col-md-12 text-right">
                        <button type="button" id="aceptar" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/Vacunas/buscar'"
                                class="btn btn-success btn-sm">
                            <i class="fa fa-check"></i>&nbsp;&nbsp;Aceptar
                        </button>
                        <br/><br/>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</section><?php }} ?>
