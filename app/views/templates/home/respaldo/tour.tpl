<div class="modal fade" id="myModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Bienvenido a la plataforma MIDAS</h3>
      </div>
      <div class="modal-body">
	<div class="row form-group" style="margin-bottom:0px">
        <div class="col-xs-12">
            <ul class="nav nav-pills nav-justified thumbnail setup-panel" style="margin-bottom: 0px;">
                <li class="active"><a href="#step-1">
                    <h4 class="list-group-item-heading">1</h4>
                    <p class="list-group-item-text">Bienvenida</p>
                </a></li>
                <li class="disabled"><a href="#step-2">
                    <h4 class="list-group-item-heading">2</h4>
                    <p class="list-group-item-text">Sistemas</p>
                </a></li>
                <li class="disabled"><a href="#step-3">
                    <h4 class="list-group-item-heading">3</h4>
                    <p class="list-group-item-text">Datos personales</p>
                </a></li>
            </ul>
        </div>
	</div>
    <div class="row setup-content" id="step-1">
        <div class="col-xs-12">
            <div class="col-md-12 well text-center">
                <h1 style="margin-top: 0px;">Sistema MIDAS</h1>
				
                    <div class="col-xs-12 text-center">
					<p class="bg-info">Es la plataforma de ingreso a todos los sistemas disponibles de la autoridad sanitaria.</br>
					Solo una clave para acceder a todos los sistemas.</p>
                    </div>				
            </div>
			<div class="col-md-12 text-center">
				<button id="activate-step-2" class="btn btn-success btn-md">Continuar tour <i class="fa fa-arrow-circle-o-right fa-2x"></i></button>
			</div>
        </div>
    </div>
    <div class="row setup-content" id="step-2">
        <div class="col-xs-12">
            <div class="col-md-12 well text-center">
                <h1 style="margin-top: 0px;">Sistemas disponibles</h1>
				
                    <div class="col-xs-12 text-center">
						<p class="bg-info">En la plataforma encontrar&aacute;s los accesos a todos los sistema de la autiordad sanitaria.</p>
						<p class="bg-info">En forma autom&aacute;tica se iluminar&aacute;n los sistemas a los que tienes acceso, los dem&aacute;s sistema se encender&aacute;n una vez que estes registrado en &eacute;l, contacta con tu jefatura para solicitar el acceso a alguna aplicaci&oacute;n no disponible.</p>
						
						<div class="row">
							<div class="col-md-6 well text-center">					
								<div class="row">
									<div class="col-md-12  well text-center">					
										Sistema disponible coloreado
									</div>
									<div class="col-md-12  text-center">					
											<img class="img-responsive img-thumbnail" src="/{$FOLDER}/static/images/fotos_tour/asd_on.PNG" width="200px">
									</div>									
								</div>
								
							</div>
							<div class="col-md-6 well text-center">					
								<div class="row">
									<div class="col-md-12  well text-center">					
										Sistema <b>NO</b> disponible apagado
									</div>
									<div class="col-md-12  text-center">					
											<img class="img-responsive img-thumbnail" src="/{$FOLDER}/static/images/fotos_tour/Lab_off.PNG" width="200px">
									</div>									
								</div>
								
							</div>
						</div>
                    </div>				
            </div>
			<div class="col-md-12 text-center">
				<button id="activate-step-3" class="btn btn-success btn-md">Continuar tour <i class="fa fa-arrow-circle-o-right fa-2x"></i></button>
			</div>
        </div>
    </div>
    <div class="row setup-content" id="step-3">
        <div class="col-xs-12">
            <div class="col-md-12 well text-center">
                <h1 style="margin-top: 0px;">Datos personales</h1>
                    <div class="col-xs-12 text-center">
						<p class="bg-info">En el men&uacute; superior dispones de una opci&oacute;n para modificar todos tus datos personales, los que ser&aacute;n tambien utilizados en la opci&oacute;n  "Buscar personas" .</p>
						
						<div class="col-md-12 well text-center">
							<img class="img-responsive img-thumbnail" src="/{$FOLDER}/static/images/fotos_tour/datos_personales.PNG">
						</div>
						
						<p class="bg-info">Busca personas, te permitira realizar consultas de cualquier funcionario, sin importar su region y con los datos de contacto actualizados, ya que, cada persona puede modificar su popia informaci&oacute;n.</p>
						
						<div class="col-md-12 well text-center">
							<img class="img-responsive img-thumbnail" src="/{$FOLDER}/static/images/fotos_tour/busca_personas.PNG">
						</div>
					
                    </div>				
            </div>
			<div class="col-md-12 text-center">
				<button type="button" class="btn btn-success" data-dismiss="modal" id="btn_fin_tour_session">Volver a ver la próxima vez&nbsp;<i class="fa fa-check-square-o fa-2x"></i></button>				
				<button type="button" class="btn btn-default" data-dismiss="modal" id="btn_fin_tour">Ya entendí, no volver a mostrar&nbsp;<i class="fa fa-check-square-o fa-2x"></i></button>				
			</div>
        </div>
    </div>

		
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->