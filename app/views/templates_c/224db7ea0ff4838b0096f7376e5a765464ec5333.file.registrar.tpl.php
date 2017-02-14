<?php /* Smarty version Smarty-3.1.18, created on 2017-02-07 10:20:14
         compiled from "/var/www/html/mordedores/app/views/templates/Vacunas/registrar.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20015571355894ebd92470d4-09389351%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '224db7ea0ff4838b0096f7376e5a765464ec5333' => 
    array (
      0 => '/var/www/html/mordedores/app/views/templates/Vacunas/registrar.tpl',
      1 => 1486471669,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20015571355894ebd92470d4-09389351',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_5894ebd9255d92_06749172',
  'variables' => 
  array (
    'base_url' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5894ebd9255d92_06749172')) {function content_5894ebd9255d92_06749172($_smarty_tpl) {?><section class="content-header">
    <h1><i class="fa fa-paw"></i><span>&nbsp;Registro de Vacuna</span></h1>
</section>

<section class="content">
    <div class="row">
        
        <form  id="form" name="form" enctype="application/x-www-form-urlencoded" action="" method="post">
            
            <div class="col-xs-12 col-md-12">
                <div class="box box-primary">
                    
                    <div class="box-body">
                        <div class="box-header">
                            <h3 class="box-title">Notificaci&oacute;n de vacunas antirrábicas de uso animal</h3>
                        </div>
                        <br>
                        
                        <div class="form-group ">
                            <div class="form-group col-md-12">
                                <div class="form-group clearfix col-md-6">
                                    <label for="especie" class="control-label required">Especie</label>
                                    <input type="text" name="especie" id="comuna" value="" 
                                           placeholder="Especie" class="form-control"/>
                                    <span class="help-block hidden"></span>
                                </div>
                                
                                <div class="form-group clearfix col-md-6">
                                    <label for="cantidad" class="control-label required">Cantidad</label>
                                    <input type="text" name="cantidad" id="direccionanimal" value="" 
                                           placeholder="Ingrese una cantidad" class="form-control"/>
                                    <span class="help-block hidden"></span>
                                </div>
                            </div>
                            
                            <div class="form-group col-md-12">
                                <div class="form-group clearfix col-md-6">
                                    <label for="periodo" class="control-label required">Periodo</label>
                                    <input type="text" name="periodo" id="comuna" value="" 
                                           placeholder="Periodo" class="form-control"/>
                                    <span class="help-block hidden"></span>
                                </div>
                                
                                <div class="form-group clearfix col-md-6">
                                    <label for="agno" class="control-label required">Año</label>
                                    <input type="text" name="agno" id="direccionanimal" value="" 
                                           placeholder="Año" class="form-control"/>
                                    <span class="help-block hidden"></span>
                                </div>
                            </div>
                            
                            <div class="form-group col-md-12">
                                <div class="form-group clearfix col-md-12">
                                    <label for="comuna" class="control-label required">Comuna</label>
                                    <input type="text" name="comuna" id="referencia" value="" 
                                           placeholder="Comuna" class="form-control"/>
                                    <span class="help-block hidden"></span>
                                </div>
                            </div>
                            
                            <div class="form-group col-md-12">
                                <div class="form-group clearfix col-md-6">
                                    <label for="inicio" class="control-label required">Inicio Periodo</label>
                                    <input type="text" name="inicio" id="comuna" value="" 
                                           placeholder="Inicio Periodo" class="form-control"/>
                                    <span class="help-block hidden"></span>
                                </div>
                                
                                <div class="form-group clearfix col-md-6">
                                    <label for="termino" class="control-label required">T&eacute;rmino Periodo</label>
                                    <input type="text" name="termino" id="direccionanimal" value="" 
                                           placeholder="T&eacute;rmino Periodo" class="form-control"/>
                                    <span class="help-block hidden"></span>
                                </div>
                            </div>
                            
                            <div class="form-group col-md-12">
                                <div class="col-md-12 text-right">
                                    <button type="button" id="guardar" class="btn btn-success">
                                        <i class="fa fa-save"></i>  Guardar
                                    </button>
                                    <button type="button" id="cancelar"  class="btn btn-default" 
                                            onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/Vacunas/buscar'">
                                        <i class="fa fa-remove"></i>  Cancelar
                                    </button>
                                    <br/><br/>
                                </div>
                            </div>
                            
                        </div>
                        
                    </div>
                </div>
            </div>
        </form>
                             
    </div>
</section><?php }} ?>
