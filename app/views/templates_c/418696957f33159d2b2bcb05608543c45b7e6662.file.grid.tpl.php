<?php /* Smarty version Smarty-3.1.18, created on 2017-01-20 11:43:54
         compiled from "/var/www/html/mordedores/app/libs/Helpers/View/Grid/View/grid.tpl" */ ?>
<?php /*%%SmartyHeaderCode:9376635855882222a8f4f33-80067383%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '418696957f33159d2b2bcb05608543c45b7e6662' => 
    array (
      0 => '/var/www/html/mordedores/app/libs/Helpers/View/Grid/View/grid.tpl',
      1 => 1484854628,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9376635855882222a8f4f33-80067383',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'title' => 0,
    'columns' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_5882222a8fd674_64626232',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5882222a8fd674_64626232')) {function content_5882222a8fd674_64626232($_smarty_tpl) {?><?php if (!is_callable('smarty_function_columnas')) include '/var/www/html/mordedores/app/libs/Helpers/View/Grid/Plugins/function.columnas.php';
?><div class="col-sm-12">
<table id="<?php echo $_smarty_tpl->tpl_vars['title']->value;?>
" class="table table-hover table-striped table-bordered " width="100%">
    <thead>
        <tr>
            <?php echo smarty_function_columnas(array('columns'=>$_smarty_tpl->tpl_vars['columns']->value),$_smarty_tpl);?>

        </tr>
    </thead>
</table>
</div>
<?php }} ?>
