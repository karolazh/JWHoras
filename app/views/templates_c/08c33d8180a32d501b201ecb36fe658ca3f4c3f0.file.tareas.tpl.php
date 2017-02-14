<?php /* Smarty version Smarty-3.1.18, created on 2017-02-03 10:55:29
         compiled from "/var/www/html/mordedores/app/views/templates/RegistroMordedores/Tareas/tareas.tpl" */ ?>
<?php /*%%SmartyHeaderCode:127612774858935c35da2da4-27580330%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '08c33d8180a32d501b201ecb36fe658ca3f4c3f0' => 
    array (
      0 => '/var/www/html/mordedores/app/views/templates/RegistroMordedores/Tareas/tareas.tpl',
      1 => 1486130127,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '127612774858935c35da2da4-27580330',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_58935c35dc3838_03607530',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58935c35dc3838_03607530')) {function content_58935c35dc3838_03607530($_smarty_tpl) {?><link href="<?php echo @constant('STATIC_FILES');?>
template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo @constant('STATIC_FILES');?>
template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="<?php echo @constant('STATIC_FILES');?>
template/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo @constant('STATIC_FILES');?>
template/plugins/fullcalendar/fullcalendar.print.css" rel="stylesheet" type="text/css" />
<link href="<?php echo @constant('STATIC_FILES');?>
template/plugins/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo @constant('STATIC_FILES');?>
template/plugins/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    
<section class="content-header">
    <h1><i class="fa fa-paw"></i><span>&nbsp;Tareas</span></h1>
</section>



<!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-3">
              <div class="box box-solid">
                <div class="box-header with-border">
                  <h4 class="box-title">Draggable Events</h4>
                </div>
                <div class="box-body">
                  <!-- the events -->
                  <div id="external-events">
                    <div class="external-event bg-green">Lunch</div>
                    <div class="external-event bg-yellow">Go home</div>
                    <div class="external-event bg-aqua">Do homework</div>
                    <div class="external-event bg-light-blue">Work on UI design</div>
                    <div class="external-event bg-red">Sleep tight</div>
                    <div class="checkbox">
                      <label for="drop-remove">
                        <input type="checkbox" id="drop-remove">
                        remove after drop
                      </label>
                    </div>
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /. box -->
              <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Create Event</h3>
                </div>
                <div class="box-body">
                  <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                    <!--<button type="button" id="color-chooser-btn" class="btn btn-info btn-block dropdown-toggle" data-toggle="dropdown">Color <span class="caret"></span></button>-->
                    <ul class="fc-color-picker" id="color-chooser">
                      <li><a class="text-aqua" href="#"><i class="fa fa-square"></i></a></li>
                      <li><a class="text-blue" href="#"><i class="fa fa-square"></i></a></li>
                      <li><a class="text-light-blue" href="#"><i class="fa fa-square"></i></a></li>
                      <li><a class="text-teal" href="#"><i class="fa fa-square"></i></a></li>
                      <li><a class="text-yellow" href="#"><i class="fa fa-square"></i></a></li>
                      <li><a class="text-orange" href="#"><i class="fa fa-square"></i></a></li>
                      <li><a class="text-green" href="#"><i class="fa fa-square"></i></a></li>
                      <li><a class="text-lime" href="#"><i class="fa fa-square"></i></a></li>
                      <li><a class="text-red" href="#"><i class="fa fa-square"></i></a></li>
                      <li><a class="text-purple" href="#"><i class="fa fa-square"></i></a></li>
                      <li><a class="text-fuchsia" href="#"><i class="fa fa-square"></i></a></li>
                      <li><a class="text-muted" href="#"><i class="fa fa-square"></i></a></li>
                      <li><a class="text-navy" href="#"><i class="fa fa-square"></i></a></li>
                    </ul>
                  </div><!-- /btn-group -->
                  <div class="input-group">
                    <input id="new-event" type="text" class="form-control" placeholder="Event Title">
                    <div class="input-group-btn">
                      <button id="add-new-event" type="button" class="btn btn-primary btn-flat">Add</button>
                    </div><!-- /btn-group -->
                  </div><!-- /input-group -->
                </div>
              </div>
            </div><!-- /.col -->
            <div class="col-md-9">
              <div class="box box-primary">
                <div class="box-body no-padding">
                  <!-- THE CALENDAR -->
                  <div id="calendar"></div>
                </div><!-- /.box-body -->
              </div><!-- /. box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->

<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- jQuery 2.1.4 -->
<script src="<?php echo @constant('STATIC_FILES');?>
template/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- Bootstrap 3.3.5 -->
<script src="<?php echo @constant('STATIC_FILES');?>
template/bootstrap/js/bootstrap.min.js"></script>
<!-- Slimscroll -->
<script src="<?php echo @constant('STATIC_FILES');?>
template/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo @constant('STATIC_FILES');?>
template/plugins/fastclick/fastclick.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo @constant('STATIC_FILES');?>
template/plugins/dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo @constant('STATIC_FILES');?>
template/plugins/dist/js/demo.js"></script>
<!-- fullCalendar 2.2.5 -->
<script src="<?php echo @constant('STATIC_FILES');?>
template/plugins/fullcalendar/fullcalendar.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>

<!-- Page specific script -->
<?php }} ?>
