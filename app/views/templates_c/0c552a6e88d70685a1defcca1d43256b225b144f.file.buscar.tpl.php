<?php /* Smarty version Smarty-3.1.18, created on 2017-02-07 10:20:01
         compiled from "/var/www/html/mordedores/app/views/templates/Vacunas/buscar.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3651494845894e3e7a859c7-67192286%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0c552a6e88d70685a1defcca1d43256b225b144f' => 
    array (
      0 => '/var/www/html/mordedores/app/views/templates/Vacunas/buscar.tpl',
      1 => 1486471669,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3651494845894e3e7a859c7-67192286',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_5894e3e7ab0272_99086581',
  'variables' => 
  array (
    'base_url' => 0,
    'arrResultado' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5894e3e7ab0272_99086581')) {function content_5894e3e7ab0272_99086581($_smarty_tpl) {?><link href="<?php echo @constant('STATIC_FILES');?>
template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo @constant('STATIC_FILES');?>
template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<section class="content-header">
    <h1><i class="fa fa-plus"></i><span>&nbsp;Vacunas</span></h1>
    <div class="col-md-12 text-right">
        <button type="button" id="registrar" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/Vacunas/registrar'"
                class="btn btn-danger">
            <i class="fa fa-plus"></i>&nbsp;&nbsp;Registrar Vacunas
        </button>
    </div>
    <br/><br/>
</section>

<section class="content">
    <div class="row">
        
        <form  id="form" name="form" enctype="application/x-www-form-urlencoded" action="" method="post">
            
            <div class="col-xs-12 col-md-12">
                <div class="box box-primary">
                    
                    <div class="box-body">
                        <div class="box-header">
                            <h3 class="box-title">Busqueda de vacunas</h3>
                        </div>
                        <br>
                        
                        <div class="form-group ">
                            <div class="form-group col-md-12">
                                <div class="form-group clearfix col-md-6">
                                    <label for="agno" class="control-label required">Año</label>
                                    <input type="text" name="agno" id="fecha" value=""
                                           placeholder="Año" class="form-control"/>
                                    <span class="help-block hidden"></span>
                                </div>
                                
                                <div class="form-group clearfix col-md-6">
                                    <label for="semestre" class="control-label required">Semestre</label>
                                    <input type="text" name="Semestre" id="rut" value="" 
                                           placeholder="Semestre" class="form-control"/>
                                    <span class="help-block hidden"></span>
                                </div>
                            </div>
                            
                            <div class="form-group col-md-12">
                                <div class="form-group clearfix col-md-6">
                                    <label for="comuna" class="control-label required">Comuna</label>
                                    <input type="text" name="comuna" id="rut" value="" 
                                           placeholder="Comuna" class="form-control"/>
                                    <span class="help-block hidden"></span>
                                </div>
                                
                                <div class="form-group clearfix col-md-6">
                                    <label for="busqueda" class="control-label required">Búsqueda</label>
                                    <input type="text" name="busqueda" id="apellido" value="" 
                                           placeholder="Búsqueda" class="form-control"/>
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
                            <h3 class="box-title">Listado de vacunas</h3>
                        </div>
                        <br>
                        
                        <div class="form-group ">
                            <table id="tablaPrincipal" class="table table-hover table-striped table-bordered  table-middle dataTable no-footer">
                                <thead>
                                    <tr role="row">
                                        <th align="center">Fecha Ing</th>
                                        <th align="center">Año</th>
                                        <th align="center">Semestre</th>
                                        
                                        <th align="center">Comuna</th>
                                        <th align="center">Tipo Animal</th>
                                        <th align="center">Instituci&oacute;n</th>
                                        
                                        <th align="center">Cantidad</th>
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
                                        <td align="center"><?php echo $_smarty_tpl->tpl_vars['item']->value->vac_fec_crea;?>
</td>
                                        <td align="center"><?php echo $_smarty_tpl->tpl_vars['item']->value->vac_agno;?>
</td>
                                        <td align="center"><?php echo $_smarty_tpl->tpl_vars['item']->value->vac_periodo;?>
</td>
                                        
                                        <td align="center"><?php echo $_smarty_tpl->tpl_vars['item']->value->com_nombre;?>
</td>
                                        <td align="center"><?php echo $_smarty_tpl->tpl_vars['item']->value->esp_nombre;?>
</td>
                                        <td align="center"><?php echo $_smarty_tpl->tpl_vars['item']->value->ins_nombre;?>
</td>
                                        
                                        <td align="center"><?php echo $_smarty_tpl->tpl_vars['item']->value->vac_cantidad;?>
</td>
                                        <td align="center">
                                            <button type="button" class="btn btn-sm btn-success btn-flat" 
                                                    onClick="location.href='<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/Vacunas/verRegistro/<?php echo $_smarty_tpl->tpl_vars['item']->value->vac_id;?>
'" 
                                                    data-toggle="tooltip" title="Ver Vacuna">
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
