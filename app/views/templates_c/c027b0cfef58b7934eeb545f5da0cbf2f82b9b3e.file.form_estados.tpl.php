<?php /* Smarty version Smarty-3.1.18, created on 2017-02-01 16:31:10
         compiled from "/var/www/html/mordedores/app/views/templates/mantenedor_avanzados/form_estados.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18498089445892377e2c0d01-18264759%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c027b0cfef58b7934eeb545f5da0cbf2f82b9b3e' => 
    array (
      0 => '/var/www/html/mordedores/app/views/templates/mantenedor_avanzados/form_estados.tpl',
      1 => 1484854629,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18498089445892377e2c0d01-18264759',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'fecha_creacion_controller' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_5892377e2c5494_98013946',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5892377e2c5494_98013946')) {function content_5892377e2c5494_98013946($_smarty_tpl) {?><form id="formEstado" name="form-inline" enctype="application/x-www-form-urlencoded" action="" method="post">
    <div class="row">
        <div class="col-md-6 top-spaced">
            <div class="margin-bottom-10"></div>
           
            
            <div class="form-group">
                <label for="exampleInputPassword1" class="col-lg-4 control-label">Nombre del estado</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" id="nombre_estado" name="nombre_estado" placeholder="">
                    <input type="hidden" class="form-control" id="fecha" name="fecha" placeholder="fecha" value="<?php echo $_smarty_tpl->tpl_vars['fecha_creacion_controller']->value;?>
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
                    <textarea class="form-control" id="descripcion" name="descripcion" ></textarea>
                </div>
            </div>
           
        </div>
    </div>

    <div class="margin-bottom-10"></div>
    <div id="g">
        <button id="" type="button" class="btn btn-success pull-right btn-flat" onclick="Estados.guardarNuevoEstado(this.form,this)">
            Guardar estado
        </button>
    </div>
</form>
            


             <?php }} ?>
