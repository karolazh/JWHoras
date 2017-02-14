<?php /* Smarty version Smarty-3.1.18, created on 2017-02-07 10:19:43
         compiled from "/var/www/html/mordedores/app/views/templates/Vigilancia/vigilancia.tpl" */ ?>
<?php /*%%SmartyHeaderCode:202070512858987cc419c0a4-53358518%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b8fb700445cce0752ab2b5f87298e48d3795362d' => 
    array (
      0 => '/var/www/html/mordedores/app/views/templates/Vigilancia/vigilancia.tpl',
      1 => 1486471669,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '202070512858987cc419c0a4-53358518',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_58987cc41a8f26_96120518',
  'variables' => 
  array (
    'base_url' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58987cc41a8f26_96120518')) {function content_58987cc41a8f26_96120518($_smarty_tpl) {?>
<section class="content-header">
    <h1><i class="fa fa-pencil"></i><span>&nbsp;Muestras Registradas</span></h1>
    <div class="col-md-12 text-right">
        <button type="button" id="nuevo_registro" onclick="location.href = '<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/OtrosRegistros/nuevo'"
                class="btn btn-defaultr">
            <i class="fa fa-file"></i><span>&nbsp;&nbsp;Registrar muestra de vigilancia</span>
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
                        <div class="form-group ">

                            <div class="form-group ">
                                <table id="tablaPrincipal" class="table table-hover table-striped table-bordered  table-middle dataTable no-footer">
                                    <thead>
                                        <tr role="row">
                                            <th align="center">Especie</th>
                                            <th align="center">Numero de muestra</th>
                                            <th align="center">Region de la muestra</th>
                                            <th align="center" with="1px">Acciones</th>

                                        </tr>
                                    </thead>

                                    <tbody>
                                        
                                            <tr>
                                                <td align="center">?</td>
                                                <td align="center">?</td>
                                                <td align="center">?</td>
                                                <td align="center">
                                                    <button type="button" class="btn btn-sm btn-success btn-flat" 
                                                            onClick="location.href = ''" 
                                                            data-toggle="tooltip" title="Descargar Acta">
                                                        <i class="fa fa-download"></i>
                                                    </button>
                                                </td>
                                            </tr>
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
