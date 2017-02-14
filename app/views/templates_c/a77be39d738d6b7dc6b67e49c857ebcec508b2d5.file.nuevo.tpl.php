<?php /* Smarty version Smarty-3.1.18, created on 2017-02-07 10:19:55
         compiled from "/var/www/html/mordedores/app/views/templates/OtrosRegistros/nuevo.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13031630605899c97b0a5ac8-44997375%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a77be39d738d6b7dc6b67e49c857ebcec508b2d5' => 
    array (
      0 => '/var/www/html/mordedores/app/views/templates/OtrosRegistros/nuevo.tpl',
      1 => 1486471669,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13031630605899c97b0a5ac8-44997375',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_5899c97b0b0d82_74280806',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5899c97b0b0d82_74280806')) {function content_5899c97b0b0d82_74280806($_smarty_tpl) {?><section class="content-header">
    <h1><i class="fa fa-paw"></i><span>&nbsp;Otros Registros</span></h1>
</section>

<section class="content">
    <div class="row">
        
        <form  id="form" name="form" enctype="application/x-www-form-urlencoded" action="" method="post">
            
            <div class="col-xs-12 col-md-12">
                <div class="box box-primary">
                    
                    <div class="box-body">
                        <div class="box-header">
                            <h3 class="box-title">Datos propietario/mascota</h3>
                        </div>
                        <br>
                        
                        <div class="form-group ">
                            <div class="form-group col-md-12">
                                <div class="form-group clearfix col-md-6">
                                    <label for="especie" class="control-label required">Microchip Mascota</label>
                                    <input type="text" name="especie" id="comuna" value="" 
                                           placeholder="Especie" class="form-control"/>
                                    <span class="help-block hidden"></span>
                                </div>
                                
                                <div class="form-group clearfix col-md-6">
                                    <label for="buscar" class="control-label required">&nbsp;</label>
                                    <div class="col-xs-12">
                                    <button type="button" id="Buscar" class="btn btn-success">
                                        <i class="fa fa-search"></i>  Buscar
                                    </button>
                                    </div>
                                </div>
                            </div>

                            

                            
                            <div class="form-group col-md-12">
                                <div class="col-md-12 text-right">
                                    <button type="button" id="guardar" class="btn btn-success">
                                        <i class="fa fa-save"></i>  Guardar
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
