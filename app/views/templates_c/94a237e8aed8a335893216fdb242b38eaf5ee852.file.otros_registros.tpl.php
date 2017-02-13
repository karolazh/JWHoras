<?php /* Smarty version Smarty-3.1.18, created on 2017-02-07 10:19:31
         compiled from "/var/www/html/mordedores/app/views/templates/OtrosRegistros/otros_registros.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1291718845894d04c2333c6-60036034%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '94a237e8aed8a335893216fdb242b38eaf5ee852' => 
    array (
      0 => '/var/www/html/mordedores/app/views/templates/OtrosRegistros/otros_registros.tpl',
      1 => 1486471669,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1291718845894d04c2333c6-60036034',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_5894d04c23ce28_52153509',
  'variables' => 
  array (
    'base_url' => 0,
    'arrResultado' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5894d04c23ce28_52153509')) {function content_5894d04c23ce28_52153509($_smarty_tpl) {?>
<section class="content-header">
    <h1><i class="fa fa-pencil"></i><span>&nbsp;Otros Registros</span></h1>
    <div class="col-md-12 text-right">
        <button type="button" id="nuevo_registro" onclick="location.href = '<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/OtrosRegistros/nuevo'"
                class="btn btn-sucess">
            <i class="fa fa-file"></i><span>&nbsp;&nbsp;Registrar Nuevo</span>
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
                            <h3 class="box-title">Listado de Registros</h3>
                        </div>
                        <br>

                        <div class="form-group ">
                            <div class="form-group col-md-12">
                                <div class="form-group clearfix col-md-6">
                                    <label for="microchip" class="control-label required">Microchip de mascota</label>
                                    <input type="text" name="microchip" id="microchip" value=""
                                           placeholder="Buscar" class="form-control"/>
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
                            <br/>
                            <div class="form-group ">
                                <table id="tablaPrincipal" class="table table-hover table-striped table-bordered  table-middle dataTable no-footer">
                                    <thead>
                                        <tr role="row">
                                            <th align="center">Tipo de Registro</th>
                                            <th align="center">Observaciones</th>

                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['arrResultado']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                                            <tr>
                                                <td align="center">?</td>
                                                <td align="center">?</td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <br/>
                            </div>


                        </div>

                    </div>
                </div>
            </div>
        </form>

    </div>
</section><?php }} ?>
