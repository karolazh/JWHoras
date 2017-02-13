<?php /* Smarty version Smarty-3.1.18, created on 2017-02-07 10:19:25
         compiled from "/var/www/html/mordedores/app/views/plugins/view/menu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:30051701958811d5465c581-12195301%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '37a29f590020fddadd94b964ca660a1bf8bf1355' => 
    array (
      0 => '/var/www/html/mordedores/app/views/plugins/view/menu.tpl',
      1 => 1486471669,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '30051701958811d5465c581-12195301',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_58811d5467f086_44199537',
  'variables' => 
  array (
    'base_url' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58811d5467f086_44199537')) {function content_58811d5467f086_44199537($_smarty_tpl) {?><li>
    <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/Home/dashboard">
        <i class="fa fa-home"></i> <span>Inicio</span></a>
</li>
<li class="treeview">
    <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/Home/dashboard">
        <i class="fa fa-paw"></i> <span>Registro Animales Mordedores</span></a>
        <ul class="treeview-menu">
            <li>
                <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/RegistroMordedores/registrar">
                    <i class="fa fa-plus-circle"></i> <span>Registrar Accidente</span></a>
            </li>
            <li>
                <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/RegistroMordedores/buscar">
                    <i class="fa fa-plus-circle"></i> <span>Buscar</span></a>
            </li>
            <li>
                <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/RegistroMordedores/tareas">
                    <i class="fa fa-plus-circle"></i> <span>Tareas</span></a>
            </li>
            <li>
                <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/Home/dashboard">
                    <i class="fa fa-plus-circle"></i> <span>Reportes</span></a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/RegistroMordedores/reportesMordedores">
                                <i class="fa fa-plus-circle"></i> <span>Animales Mordedores</span></a>
                        </li>
                        <li>
                            <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/RegistroMordedores/reportesVacunas">
                                <i class="fa fa-slack"></i> <span>Vacunas</span></a>
                        </li>
                    </ul>
            </li>
        </ul>
</li>
<li>
    <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/OtrosRegistros/otrosRegistros">
        <i class="fa fa-pencil"></i> <span>Otros Registros</span></a>
</li>
<li>
    <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/Vigilancia/vigilancia">
        <i class="fa fa-eye"></i> <span>Vigilancia</span></a>
</li>
<li>
    <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/Vacunas/buscar">
        <i class="fa fa-plus"></i> <span>Vacunas</span></a>
</li>
<li>
    <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/Zoonosis/zoonosis">
        <i class="fa fa-envelope"></i> <span>Notificaciones de Zoonosis</span></a>
</li>
<li>
    <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/MesaDeAyuda/mesaDeAyuda">
        <i class="fa fa-life-ring"></i> <span>Mesa de Ayuda</span></a>
</li>

<?php if ($_SESSION['perfil']==1) {?>
<li>
    <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/Home/dashboard">
        <i class="fa fa-cog"></i> <span>Administración</span></a>
        <ul class="treeview-menu">
            <li>
                <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/Home/dashboard">
                    <i class="fa fa-plus-circle"></i> <span>Mantenedores</span></a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/Administracion/regiones">
                                <i class="fa fa-plus-circle"></i> <span>Regiones</span></a>
                        </li>
                        <li>
                            <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/Administracion/provincias">
                                <i class="fa fa-plus-circle"></i> <span>Provincias</span></a>
                        </li>
                        <li>
                            <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/Administracion/comunas">
                                <i class="fa fa-plus-circle"></i> <span>Comunas</span></a>
                        </li>
                        <li>
                            <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/Administracion/municipios">
                                <i class="fa fa-plus-circle"></i> <span>Municipios</span></a>
                        </li>
                        <li>
                            <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/Administracion/especies">
                                <i class="fa fa-plus-circle"></i> <span>Especies</span></a>
                        </li>
                        <li>
                            <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/Administracion/razas">
                                <i class="fa fa-plus-circle"></i> <span>Razas</span></a>
                        </li>
                    </ul>
            </li>
        </ul>
</li>
<?php }?>
<br/><br/><br/><br/>
<?php }} ?>
