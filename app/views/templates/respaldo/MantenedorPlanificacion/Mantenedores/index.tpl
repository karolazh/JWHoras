<head>
	<style>
		#trash{
			width:32px;
			height:32px;
			float:left;
			padding-bottom: 15px;
			position: relative;
		}
			
		#wrap {
			width: 1100px;
			margin: 0 auto;
		}
			
		#external-events {
			float: left;
			width: 150px;
			padding: 0 10px;
			border: 1px solid #ccc;
			background: #eee;
			text-align: left;
		}
			
		#external-events h4 {
			font-size: 16px;
			margin-top: 0;
			padding-top: 1em;
		}
			
		#external-events .fc-event {
			margin: 10px 0;
			cursor: pointer;
		}
			
		#external-events p {
			margin: 1.5em 0;
			font-size: 11px;
			color: #666;
		}
			
		#external-events p input {
			margin: 0;
			vertical-align: middle;
		}

		#calendar {
			float: center;
			width: 900px;
		}

	</style>
</head>

<section class="content-header">
    <h1>Planificacion de actividades</h1>
        <ol class="breadcrumb">
			<li>
				<a href="{$base_url}/MantenedorPlanificacion">
                                    <i class="fa fa-folder-open"></i>Planificacion de actividades</a>
			</li>
        </ol>
</section>

<section class="content">
    <div class="box box-primary">
		<div class="box-header">
			<div class="row">
				<div class="col-md-offset-1 col-md-10">
					<button class="btn btn-sm btn-success btn-flat pull-right" onClick="location.href='{$base_url}/MantenedorPlanificacion/nuevaActividad'">
					<i class="fa fa-plus"></i>Nueva Actividad</button>  
				</div>
			</div>
		</div>
		        <div id='wrap'>
            <div style="display: none;" id='external-events'>
                    <h4>Draggable Events</h4>
                <div class='fc-event'>New Event</div>
                <p>
                    <img src="assets/img/trashcan.png" id="trash" alt="">
                </p>
            </div>        
            <div id='calendar'></div>
            <div style='clear:both'></div>            

		
		<div class="row">
			<div class="col-md-offset-1 col-md-10">
				<div id='calendar'></div>
				<div style='clear:both'></div>	 
			</div>
		</div>
	</div>
</section>

 



    

    
 
     