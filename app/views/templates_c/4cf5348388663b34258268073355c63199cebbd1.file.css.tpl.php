<?php /* Smarty version Smarty-3.1.18, created on 2017-01-31 16:43:37
         compiled from "/var/www/html/mordedores/app/views/templates/layout/css.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10634863125881192e3322d9-57180727%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4cf5348388663b34258268073355c63199cebbd1' => 
    array (
      0 => '/var/www/html/mordedores/app/views/templates/layout/css.tpl',
      1 => 1485891814,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10634863125881192e3322d9-57180727',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_5881192e33b799_27493208',
  'variables' => 
  array (
    'static' => 0,
    'css' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5881192e33b799_27493208')) {function content_5881192e33b799_27493208($_smarty_tpl) {?><meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Minsal :: SIRAM</title>
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

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<link rel="icon" type="image/png" href="<?php echo $_smarty_tpl->tpl_vars['static']->value;?>
/images/logo_minsal_32.png" />

<style type="text/css">
body {
  /* Ubicación de la imagen */
  background-image: url(static/images/perro_byn.jpg);
 
  /* Nos aseguramos que la imagen de fondo este centrada vertical y
    horizontalmente en todo momento */
  background-position: center center;

  /* La imagen de fondo no se repite */
  background-repeat: no-repeat;

  /* La imagen de fondo está fija en el viewport, de modo que no se mueva cuando
     la altura del contenido supere la altura de la imagen. */
  background-attachment: fixed;

  /* La imagen de fondo se reescala cuando se cambia el ancho de ventana
     del navegador */
  background-size: cover;

  /* Fijamos un color de fondo para que se muestre mientras se está
    cargando la imagen de fondo o si hay problemas para cargarla  */
  /*background-color: #464646;*/
  
  /*background-color: rgb(0,0,255); opacity: 0.5;*/
}

</style>

<?php echo $_smarty_tpl->tpl_vars['css']->value;?>
<?php }} ?>
