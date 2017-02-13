<?php /* Smarty version Smarty-3.1.18, created on 2017-02-07 10:18:14
         compiled from "/var/www/html/mordedores/app/views/templates/Zoonosis/zoonosis.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3133530415898c565eeb245-74747132%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1ab1282240c4b121d12222ceb9c30c51a2331738' => 
    array (
      0 => '/var/www/html/mordedores/app/views/templates/Zoonosis/zoonosis.tpl',
      1 => 1486471669,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3133530415898c565eeb245-74747132',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_5898c565f02149_77602024',
  'variables' => 
  array (
    'base_url' => 0,
    'arrResultado' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5898c565f02149_77602024')) {function content_5898c565f02149_77602024($_smarty_tpl) {?><link href="<?php echo @constant('STATIC_FILES');?>
template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo @constant('STATIC_FILES');?>
template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<section class="content-header">
    <h1><i class="fa fa-envelope"></i><span>&nbsp;Notificaciones de Zoonosis</span></h1>
    <div class="col-md-12 text-right">
        <button type="button" id="notificar" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/Zoonosis/notificar'"
                class="btn btn-success">
            <i class="fa fa-envelope"></i>&nbsp;&nbsp;Notificar Zoonosis
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
                        
                        <div class="form-group" align="right">
                            <div class="form-group col-md-12">
                                <div class="form-group col-md-3">
                                    <label for="region" class="control-label required">Región</label>
                                    <select for="region" class="form-control">
                                            <option selected="selected">Todas las Regiones</option>
                                    </select>
                                </div>
                                
                                <div class="form-group col-md-3">
                                    <label for="columna" class="control-label required">Comuna</label>
                                    <select for="comuna" class="form-control">
                                            <option selected="selected">Todas las Comunas</option>
                                    </select>
                                </div>
                                
                                <div class="form-group col-md-3">
                                    <label for="busqueda" class="control-label required">&nbsp;</label>
                                    <input type="text" name="busqueda" id="rut" value="" 
                                           placeholder="Búsqueda" class="form-control"/>
                                    <span class="help-block hidden"></span>
                                </div>
                                
                                <div class="form-group col-md-1">
                                    <label for="busqueda" class="control-label required">&nbsp;</label>
                                    <button type="button" id="buscar" class="btn btn-info form-control">
                                            <i class="fa fa-search"></i>
                                    </button>
                                </div>
                                
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
                                        <th align="center">Especie</th>
                                        <th align="center">Patología</th>
                                        <th align="center">Método de Diagnóstico</th>
                                        <th align="center">Comuna</th>
                                        <th align="center">Dirección</th>
                                        <th align="center">Acciones</th>
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
