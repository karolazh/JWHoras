<?php /* Smarty version Smarty-3.1.18, created on 2017-02-01 16:31:36
         compiled from "/var/www/html/mordedores/app/views/templates/mantenedor_avanzados/formEstados.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18406378358923798d5f881-41371749%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '976983786b5b800a39f9ee33727ae2efd76fbb56' => 
    array (
      0 => '/var/www/html/mordedores/app/views/templates/mantenedor_avanzados/formEstados.tpl',
      1 => 1484854629,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18406378358923798d5f881-41371749',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'item' => 0,
    'base_url' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_58923798d709c3_84194643',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58923798d709c3_84194643')) {function content_58923798d709c3_84194643($_smarty_tpl) {?><form id="form" name="form-inline" enctype="application/x-www-form-urlencoded" action="" method="post">
<input type="hidden" name="id_estado" id="id_estado" value="<?php echo $_smarty_tpl->tpl_vars['item']->value->id_estado;?>
"/>
    <div class="row">
        <div class="col-md-6 top-spaced">
            <div class="margin-bottom-10"></div>
           
            
            <div class="form-group">
                <label for="exampleInputPassword1" class="col-lg-4 control-label">Nombre del estado</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" id="nombre_estado" name="nombre_estado" value="<?php echo $_smarty_tpl->tpl_vars['item']->value->gl_descripcion;?>
">
                </div>
            </div>

          
        </div>

        <div class="col-md-6 ">
            <div class="margin-bottom-10"></div>
              <div class="form-group top-spaced">
                <label for="exampleInputPassword1" class="col-lg-4 control-label">Fecha creación</label>
                <div class="col-lg-8">
                    <input type="text" readonly="true" class="form-control" id="fecha" name="fecha" value="<?php echo $_smarty_tpl->tpl_vars['item']->value->fc_fecha_creacion;?>
">
                </div>
            </div>
            
           
        </div>
    </div>

      <div class="row">
        <div class="col-md-6 top-spaced">
            <div class="margin-bottom-10"></div>
            <div class="form-group">
                <label for="exampleInputPassword1" class="col-lg-4 control-label">Descripción</label>
                <div class="col-lg-7">
                    <textarea  class="form-control" id="descripcion" name="descripcion" placeholder=""><?php echo $_smarty_tpl->tpl_vars['item']->value->gl_descripcion_estado;?>
</textarea>
                </div>
            </div>  
        </div>
    </div>

    <div class="margin-bottom-10"></div>
    <div class="col-md-12 text-right">
        <button type="button" id="guardar" class="btn btn-success btn-sm btn-flat">
            <i class="fa fa-save"></i> Guardar
        </button>
        <button type="button" id="cancelar" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/Estados'"
                class="btn btn-default btn-sm btn-flat">
            <i class="fa fa-remove"></i> Cancelar
        </button>
    </div>

</form>
        <?php }} ?>
