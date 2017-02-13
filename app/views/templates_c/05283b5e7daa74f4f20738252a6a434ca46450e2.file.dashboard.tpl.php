<?php /* Smarty version Smarty-3.1.18, created on 2017-02-09 18:53:41
         compiled from "/var/www/html/prevencion/app/views/templates/home/dashboard.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1794375807589cd397df3816-64507997%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '05283b5e7daa74f4f20738252a6a434ca46450e2' => 
    array (
      0 => '/var/www/html/prevencion/app/views/templates/home/dashboard.tpl',
      1 => 1486677219,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1794375807589cd397df3816-64507997',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_589cd397e1ac58_50009951',
  'variables' => 
  array (
    'arrResultado' => 0,
    'item' => 0,
    'base_url' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_589cd397e1ac58_50009951')) {function content_589cd397e1ac58_50009951($_smarty_tpl) {?><link href="<?php echo @constant('STATIC_FILES');?>
template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo @constant('STATIC_FILES');?>
template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<section class="content-header">
    <h1><i class="fa fa-home"></i> <span>Inicio</span></h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12 col-md-6">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Estadística Nacional</h3>
                </div>
                <div class="box-body">
                    <div class="col-xs-7">
                        <canvas id="graficoA"></canvas>
                    </div>
                    <div class="col-xs-5">
                        <div id="graficoA_legend"></div>
                    </div>
                </div>
            </div>
        </div>
                
        <div class="col-xs-12 col-md-6">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Estadística Regional</h3>
                </div>
                <div class="box-body">
                    <div id="map"></div>
                    <div class="col-xs-7">
                        <canvas id="graficoA"></canvas>
                    </div>
                    <div class="col-xs-5">
                        <div id="graficoA_legend"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xs-12 col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Noticias e Informativos</h3>
                </div>
                <div class="box-body">
                    <table id="tablaPrincipal" class="table table-hover table-condensed table-bordered table-middle datatable paginada">
                        <thead>
                            <tr role="row">
                                <th align="center" width="10%">#ID</th>
                                <th align="center" width="30%">T&iacute;tulo</th>
                                <th align="center" width="50%">Resumen</th>
                                <th align="center" width="10%">Acciones</th>
                            </tr>
                        </thead>

                        <tbody>
                        <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['arrResultado']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                            <tr>
                                <td nowrap width="100px" align="center"> <?php echo $_smarty_tpl->tpl_vars['item']->value->not_id;?>
 </td>
                                
                                <td class="text-center"><?php echo $_smarty_tpl->tpl_vars['item']->value->not_titulo;?>
</td>
                                <td class="text-center">?</td>
                                <td align="center">
                                    
                                    
                                    <button type="button" class="btn btn-sm btn-success btn-flat" 
                                            onClick="location.href='<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/Home/verNoticia/<?php echo $_smarty_tpl->tpl_vars['item']->value->not_id;?>
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
</section>
                        
</body><?php }} ?>
