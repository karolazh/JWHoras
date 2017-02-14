<?php /* Smarty version Smarty-3.1.18, created on 2017-02-13 12:11:34
         compiled from "/srv/http/prevencion/app/views/templates/template.tpl" */ ?>
<?php /*%%SmartyHeaderCode:189696061058a1cca629f0e0-91339412%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd7f16d7fa8f634b0f72523ddc33f9f1d9963e57d' => 
    array (
      0 => '/srv/http/prevencion/app/views/templates/template.tpl',
      1 => 1486994086,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '189696061058a1cca629f0e0-91339412',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'static' => 0,
    'content' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_58a1cca62d9fd1_95133639',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58a1cca62d9fd1_95133639')) {function content_58a1cca62d9fd1_95133639($_smarty_tpl) {?><?php if (!is_callable('smarty_function_htmlBoxUsuario')) include '/srv/http/prevencion/app/views/plugins/function.htmlBoxUsuario.php';
if (!is_callable('smarty_function_htmlMenu')) include '/srv/http/prevencion/app/views/plugins/function.htmlMenu.php';
?><!DOCTYPE html>
<html lang="es">
<head>
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Minsal :: Prevenci&oacute;n de Femicidios</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['static']->value;?>
template/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['static']->value;?>
template/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
      -->
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['static']->value;?>
template/dist/css/skins/skin-blue.min.css">

    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['static']->value;?>
css/style.css" type="text/css" />


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <link rel="icon" type="image/png" href="<?php echo $_smarty_tpl->tpl_vars['static']->value;?>
/images/logo_minsal_32.png" />
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">

        <!-- Logo -->
        <a href="javascript:void(0);" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><img src="<?php echo $_smarty_tpl->tpl_vars['static']->value;?>
/images/logo_minsal_32.png"></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg" style="">
                <!-- <img src="<?php echo $_smarty_tpl->tpl_vars['static']->value;?>
/images/cosof.png" width="50" height="50"><b>T</b>ickets -->
                <img src="<?php echo $_smarty_tpl->tpl_vars['static']->value;?>
/images/logo_minsal_32.png">&nbsp;<b>Prevenci&oacute;n</b>
            </span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
                
            </a>
            
            <?php if (@constant('ENVIROMENT')!='PROD') {?>
            <span style="color:#fff;font-size:20px;height: 50px;line-height: 50px">
                Ambiente de Ejecución: <strong><?php echo @constant('ENVIROMENT');?>
</strong>
            </span>
            <?php }?>

            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">

                <ul class="nav navbar-nav">
                    <!-- User Account Menu -->
                    <?php echo smarty_function_htmlBoxUsuario(array(),$_smarty_tpl);?>

                </ul>
            </div>
        </nav>
    </header>
    
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

            <!-- Sidebar Menu -->
            <ul class="sidebar-menu">
                <li class="header" style="color:#fff; font-size:16px; text-align: center">Menu Principal</li>
                <?php echo smarty_function_htmlMenu(array(),$_smarty_tpl);?>

            </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <?php echo $_smarty_tpl->tpl_vars['content']->value;?>


        <!-- Content Header (Page header) -->
        

        <!-- Main content -->
        <!-- /.content -->
    </div><!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
            Prevenci&oacute;n de Femicidios
        </div>
        <!-- Default to the left -->
        <strong>&copy; 2017 <a href="http://www.minsal.cl/" target="_blank">Ministerio de Salud</a></strong>
    </footer>


</div><!-- ./wrapper -->

</body>
<?php echo $_smarty_tpl->getSubTemplate ("layout/js.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

</html><?php }} ?>
