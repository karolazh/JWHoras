<?php /* Smarty version Smarty-3.1.18, created on 2017-02-02 11:44:30
         compiled from "/var/www/html/mordedores/app/views/templates/home/dashboard.tpl" */ ?>
<?php /*%%SmartyHeaderCode:140853212358811d54611507-59418978%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f82682b8bb1bf9f69b9c05c68461b990dfcd5eec' => 
    array (
      0 => '/var/www/html/mordedores/app/views/templates/home/dashboard.tpl',
      1 => 1486046668,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '140853212358811d54611507-59418978',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_58811d5461e110_53913088',
  'variables' => 
  array (
    'arrResultado' => 0,
    'item' => 0,
    'base_url' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58811d5461e110_53913088')) {function content_58811d5461e110_53913088($_smarty_tpl) {?><link href="<?php echo @constant('STATIC_FILES');?>
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
                    <h3 class="box-title">Incidencias Reportadas</h3>
                </div>
                <div class="box-body">
                    <div id="map"></div>
                    
                </div>
            </div>
        </div>
                
        <div class="col-xs-12 col-md-6">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Noticias e Informativos</h3>
                </div>
                <div class="box-body">
                    <table id="tablaPrincipal" class="table table-hover table-condensed table-bordered table-middle datatable paginada">
                        <thead>
                            <tr role="row">
                                <th align="center" with="20%">#ID</th>
                                <th align="center">T&iacute;tulo</th>
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
                                <td nowrap width="100px" align="center"> <?php echo $_smarty_tpl->tpl_vars['item']->value->not_id;?>
 </td>
                                
                                <td class="text-center"><?php echo $_smarty_tpl->tpl_vars['item']->value->not_titulo;?>
</td>
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
                        


<script type="text/javascript">
    function initialize() {
        var mapa = document.getElementById('mapa');
 
        var mapOptions = {
          center: new google.maps.LatLng(40.413740, -3.6921),
          zoom: 18,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        var mapa = new google.maps.Map(mapa, mapOptions)
      }
      google.maps.event.addDomListener(window, 'load', initialize);
</script>

<script src="https://maps.googleapis.com/maps/api/js"></script>
<script async defer
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCsjDp027m2PxKkbRm9ZPoHB6QgtG2FpYw&callback=initMap">
</script>

</body><?php }} ?>
