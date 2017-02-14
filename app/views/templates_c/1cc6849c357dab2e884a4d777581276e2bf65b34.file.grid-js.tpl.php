<?php /* Smarty version Smarty-3.1.18, created on 2017-01-20 11:43:54
         compiled from "/var/www/html/mordedores/app/libs/Helpers/View/Grid/View/grid-js.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12793278775882222a8d3e76-29456374%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1cc6849c357dab2e884a4d777581276e2bf65b34' => 
    array (
      0 => '/var/www/html/mordedores/app/libs/Helpers/View/Grid/View/grid-js.tpl',
      1 => 1484854628,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12793278775882222a8d3e76-29456374',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'title' => 0,
    'columns' => 0,
    'base_url' => 0,
    'params' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_5882222a8f2391_57622399',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5882222a8f2391_57622399')) {function content_5882222a8f2391_57622399($_smarty_tpl) {?>var table<?php echo $_smarty_tpl->tpl_vars['title']->value;?>
;

$(document).ready( function() {
    table<?php echo $_smarty_tpl->tpl_vars['title']->value;?>
 = initTable<?php echo $_smarty_tpl->tpl_vars['title']->value;?>
();
  
    $(".formulario-buscar").click(function(){
       var tabla = $(this).attr("data-rel");
       $("#" + tabla).dataTable().api()
                                 .draw(false);
    });
    
    $(".formulario-limpiar").click(function(){
        var tabla = $(this).attr("data-rel");
        var form = $("#form-busqueda-" + tabla);

        $(form).find(".element-search").val("");

        $("#" + tabla).dataTable().api()
                                 .draw(false);
    });
    
    $(".element-search").keypress(function (evt) {
        var charCode = evt.charCode || evt.keyCode;
        console.log(charCode);
        if (charCode  == 13) {
            $(this).parent().parent().parent().find(".formulario-buscar").trigger("click");
            return false;
        }
    });
});
 
function initTable<?php echo $_smarty_tpl->tpl_vars['title']->value;?>
() {
  return $('#<?php echo $_smarty_tpl->tpl_vars['title']->value;?>
').dataTable( {
        "processing": true,
        "serverSide": true,
        "stateSave": false,
        "searching": false,
        "language": {
                                "url": url_base + "static/js/plugins/DataTables-1.10.5/lang/es.json"
                            },
        "columns": [
                    <?php echo $_smarty_tpl->tpl_vars['columns']->value;?>

                  ],
        "ajax": {
            "url": "<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/index.php/Grid/listar/",
            "type": "POST",
            "data": function ( d ) {
                d.name = "<?php echo $_smarty_tpl->tpl_vars['title']->value;?>
";
                <?php echo $_smarty_tpl->tpl_vars['params']->value;?>

                d.format = "json";
            }
        }
    });
}<?php }} ?>
