<?php /* Smarty version Smarty-3.1.18, created on 2017-02-06 12:11:11
         compiled from "/var/www/html/mordedores/app/views/templates/Administracion/Regiones/grilla_regiones.tpl" */ ?>
<?php /*%%SmartyHeaderCode:65963565258860488f035c9-25189080%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '05884ce609d567854cdbe09a322fb6ae6970657d' => 
    array (
      0 => '/var/www/html/mordedores/app/views/templates/Administracion/Regiones/grilla_regiones.tpl',
      1 => 1486147495,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '65963565258860488f035c9-25189080',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_58860488f1ace9_83874399',
  'variables' => 
  array (
    'arrResultado' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58860488f1ace9_83874399')) {function content_58860488f1ace9_83874399($_smarty_tpl) {?><table id="tablaPrincipal" class="table table-hover table-striped table-bordered  table-middle dataTable no-footer">
    <thead>
        <tr role="row">
            <th align="center"># ID</th>
            
            <th align="center">Nombre</th>
            <th width="1px" align="center">Acciones</th>
        </tr>
    </thead>
    
    <tbody>
    <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['arrResultado']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
        <tr>
            <td nowrap width="100px" align="center"> <?php echo $_smarty_tpl->tpl_vars['item']->value->id;?>
 </td>
            
            <td class="text-center"><?php echo $_smarty_tpl->tpl_vars['item']->value->nombre;?>
</td>
            
            <td align="center">
                
                <button data-toggle="tooltip" type="button" class="btn btn-sm btn-success btn-flat" title="Ver Detalle" 
                        onClick="">
                    <i class="fa fa-edit"></i>&nbsp;&nbsp;Ver
                </button>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table><?php }} ?>
