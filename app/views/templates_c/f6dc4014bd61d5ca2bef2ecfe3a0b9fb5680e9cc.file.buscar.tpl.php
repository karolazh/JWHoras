<?php /* Smarty version Smarty-3.1.18, created on 2017-02-03 15:39:37
         compiled from "/var/www/html/mordedores/app/views/templates/RegistroMordedores/Buscar/buscar.tpl" */ ?>
<?php /*%%SmartyHeaderCode:79129727658935c32df9517-19827334%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f6dc4014bd61d5ca2bef2ecfe3a0b9fb5680e9cc' => 
    array (
      0 => '/var/www/html/mordedores/app/views/templates/RegistroMordedores/Buscar/buscar.tpl',
      1 => 1486147174,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '79129727658935c32df9517-19827334',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_58935c32e214c0_99389051',
  'variables' => 
  array (
    'base_url' => 0,
    'arrResultado' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58935c32e214c0_99389051')) {function content_58935c32e214c0_99389051($_smarty_tpl) {?><link href="<?php echo @constant('STATIC_FILES');?>
template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo @constant('STATIC_FILES');?>
template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<section class="content-header">
    <h1><i class="fa fa-paw"></i><span>&nbsp;B&uacute;scar de Accidentes por Mordedura</span></h1>
</section>

<section class="content">
    <div class="row">
        
        <form  id="form" name="form" enctype="application/x-www-form-urlencoded" action="" method="post">
            
            <div class="col-xs-12 col-md-12">
                <div class="box box-primary">
                    
                    <div class="box-body">
                        <div class="box-header">
                            <h3 class="box-title">Busqueda de accidentes por mordedura</h3>
                        </div>
                        <br>
                        
                        <div class="form-group ">
                            <div class="form-group col-md-12">
                                <div class="form-group clearfix col-md-6">
                                    <label for="fecha" class="control-label required">Fecha incidente</label>
                                    <input type="text" name="fecha" id="fecha" value=""
                                           placeholder="Fecha incidente" class="form-control"/>
                                    <span class="help-block hidden"></span>
                                </div>
                                
                                <div class="form-group clearfix col-md-6">
                                    <label for="comuna" class="control-label required">Comuna incidente</label>
                                    <input type="text" name="comuna" id="rut" value="" 
                                           placeholder="Comuna incidente" class="form-control"/>
                                    <span class="help-block hidden"></span>
                                </div>
                            </div>
                            
                            <div class="form-group col-md-12">
                                <div class="form-group clearfix col-md-6">
                                    <label for="rutafec" class="control-label required">Rut afectado</label>
                                    <input type="text" name="rutafec" id="nombre" value="" 
                                           placeholder="Rut afectado" class="form-control"/>
                                    <span class="help-block hidden"></span>
                                </div>
                                
                                <div class="form-group clearfix col-md-6">
                                    <label for="rutdue" class="control-label required">Rut dueño</label>
                                    <input type="text" name="rutdue" id="apellido" value="" 
                                           placeholder="Rut dueño" class="form-control"/>
                                    <span class="help-block hidden"></span>
                                </div>
                            </div>
                            
                            <div class="form-group col-md-12">
                                <div class="form-group clearfix col-md-6">
                                    <label for="microship" class="control-label required">Microship</label>
                                    <input type="text" name="microship" id="direccion" value="" 
                                           placeholder="Microship" class="form-control"/>
                                    <span class="help-block hidden"></span>
                                </div>
                                
                                <div class="form-group clearfix col-md-6">
                                    <label for="estado" class="control-label required">Estado</label>
                                    <input type="text" name="estado" id="telefono" value="" 
                                           placeholder="Estado" class="form-control"/>
                                    <span class="help-block hidden"></span>
                                </div>
                            </div>
                            
                            <div class="form-group col-md-12">
                                <div class="form-group clearfix col-md-6">
                                    <label for="tipoani" class="control-label required">Tipo animal</label>
                                    <input type="text" name="tipoani" id="direccion" value="" 
                                           placeholder="Tipo Animal" class="form-control"/>
                                    <span class="help-block hidden"></span>
                                </div>
                                
                                <div class="form-group clearfix col-md-6">
                                    <label for="funcionario" class="control-label required">Funcionario</label>
                                    <input type="text" name="funcionario" id="telefono" value="" 
                                           placeholder="Funcionario" class="form-control"/>
                                    <span class="help-block hidden"></span>
                                </div>
                            </div>
                            
                            <div class="col-md-12 text-right">
                                <button type="button" id="guardar" class="btn btn-success">
                                    <i class="fa fa-search"></i>  Buscar
                                </button>
                                <button type="button" id="cancelar"  class="btn btn-default" 
                                        onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/Home/dashboard'">
                                    <i class="fa fa-remove"></i>  Cancelar
                                </button>
                                <br/><br/>
                            </div>
                            
                        </div>
                        
                    </div>
                </div>
            </div>
            
            <div class="col-xs-12 col-md-12">
                <div class="box box-primary">
                    
                    <div class="box-body">
                        <div class="box-header">
                            <h3 class="box-title">Listado de accidentes por mordedura</h3>
                        </div>
                        <br>
                        
                        <div class="form-group ">
                            <table id="tablaPrincipal" class="table table-hover table-striped table-bordered  table-middle dataTable no-footer">
                                <thead>
                                    <tr role="row">
                                        <th align="center" with="20%">Fecha</th>
                                        <th align="center">D&iacute;as trancurridos</th>
                                        <th align="center">Direcci&oacute;n</th>
                                        <th align="center">Comuna</th>
                                        <th align="center">Especie</th>
                                        <th align="center">Responsable</th>
                                        <th align="center">Estado</th>
                                        <th align="center" with="1px">Acciones</th>
                                    </tr>
                                </thead>

                                <tbody>
                                <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['arrResultado']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                                    <tr>
                                        <td align="center"><?php echo $_smarty_tpl->tpl_vars['item']->value->inc_fec_mordida;?>
</td>
                                        <td align="center">?</td>
                                        <td align="center"><?php echo $_smarty_tpl->tpl_vars['item']->value->inc_direccion;?>
</td>
                                        <td align="center"><?php echo $_smarty_tpl->tpl_vars['item']->value->inc_com_id;?>
</td>
                                        <td align="center">?</td>
                                        <td align="center"><?php echo $_smarty_tpl->tpl_vars['item']->value->inc_usr_id_resp;?>
</td>
                                        <td align="center"><?php echo $_smarty_tpl->tpl_vars['item']->value->inc_estado;?>
</td>
                                        <td align="center">
                                            
                                            
                                            <button type="button" class="btn btn-sm btn-success btn-flat" 
                                                    onClick="location.href='<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/RegistroMordedores/Buscar/verRegistro/<?php echo $_smarty_tpl->tpl_vars['item']->value->not_id;?>
'" 
                                                    data-toggle="tooltip" title="Ver Noticia">
                                                <i class="fa fa-eye"></i>&nbsp;&nbsp;Ver
                                            </button>
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                            <br/>
                        </div>
                    </div>
                    
                </div>
            </div>
        </form>
        
    </div>
</section><?php }} ?>
