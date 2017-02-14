<?php /* Smarty version Smarty-3.1.18, created on 2017-02-01 18:34:17
         compiled from "/var/www/html/mordedores/app/views/templates/home/ver_noticia.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1628784609589251ffccb6d1-86014467%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b40ced4e26ecd6055805dd68549046919114eed8' => 
    array (
      0 => '/var/www/html/mordedores/app/views/templates/home/ver_noticia.tpl',
      1 => 1485984853,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1628784609589251ffccb6d1-86014467',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_589251ffcda885_29290013',
  'variables' => 
  array (
    'titulo' => 0,
    'resumen' => 0,
    'cuerpo' => 0,
    'base_url' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_589251ffcda885_29290013')) {function content_589251ffcda885_29290013($_smarty_tpl) {?><section class="content-header">
    <h1>Inicio</h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12 col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Noticias</h3>
                </div>
                <div class="box-body">
                    <h1><?php echo $_smarty_tpl->tpl_vars['titulo']->value;?>
</h1>
                    <br/>
                    <h3><?php echo $_smarty_tpl->tpl_vars['resumen']->value;?>
</h3>
                    <br/>
                    <?php echo $_smarty_tpl->tpl_vars['cuerpo']->value;?>

                    <br/><br/>
                    <div class="col-md-12 text-right">
                        <button type="button" id="aceptar" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/Home/dashboard'"
                                class="btn btn-success btn-sm">
                            <i class="fa fa-check"></i>&nbsp;&nbsp;Aceptar
                        </button>
                        <br/><br/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><?php }} ?>
