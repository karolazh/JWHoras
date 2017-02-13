<section class="content-header">
    <h1><i class="fa fa-paw"></i><span>&nbsp;Registro de Vacuna</span></h1>
</section>

<section class="content">
    <div class="row">
        
        <form  id="form" name="form" enctype="application/x-www-form-urlencoded" action="" method="post">
            
            <div class="col-xs-12 col-md-12">
                <div class="box box-primary">
                    
                    <div class="box-body">
                        <div class="box-header">
                            <h3 class="box-title">Notificaci&oacute;n de vacunas antirrábicas de uso animal</h3>
                        </div>
                        <br>
                        
                        <div class="form-group ">
                            <div class="form-group col-md-12">
                                <div class="form-group clearfix col-md-6">
                                    <label for="especie" class="control-label required">Especie</label>
                                    <input type="text" name="especie" id="comuna" value="" 
                                           placeholder="Especie" class="form-control"/>
                                    <span class="help-block hidden"></span>
                                </div>
                                
                                <div class="form-group clearfix col-md-6">
                                    <label for="cantidad" class="control-label required">Cantidad</label>
                                    <input type="text" name="cantidad" id="direccionanimal" value="" 
                                           placeholder="Ingrese una cantidad" class="form-control"/>
                                    <span class="help-block hidden"></span>
                                </div>
                            </div>
                            
                            <div class="form-group col-md-12">
                                <div class="form-group clearfix col-md-6">
                                    <label for="periodo" class="control-label required">Periodo</label>
                                    <input type="text" name="periodo" id="comuna" value="" 
                                           placeholder="Periodo" class="form-control"/>
                                    <span class="help-block hidden"></span>
                                </div>
                                
                                <div class="form-group clearfix col-md-6">
                                    <label for="agno" class="control-label required">Año</label>
                                    <input type="text" name="agno" id="direccionanimal" value="" 
                                           placeholder="Año" class="form-control"/>
                                    <span class="help-block hidden"></span>
                                </div>
                            </div>
                            
                            <div class="form-group col-md-12">
                                <div class="form-group clearfix col-md-12">
                                    <label for="comuna" class="control-label required">Comuna</label>
                                    <input type="text" name="comuna" id="referencia" value="" 
                                           placeholder="Comuna" class="form-control"/>
                                    <span class="help-block hidden"></span>
                                </div>
                            </div>
                            
                            <div class="form-group col-md-12">
                                <div class="form-group clearfix col-md-6">
                                    <label for="inicio" class="control-label required">Inicio Periodo</label>
                                    <input type="text" name="inicio" id="comuna" value="" 
                                           placeholder="Inicio Periodo" class="form-control"/>
                                    <span class="help-block hidden"></span>
                                </div>
                                
                                <div class="form-group clearfix col-md-6">
                                    <label for="termino" class="control-label required">T&eacute;rmino Periodo</label>
                                    <input type="text" name="termino" id="direccionanimal" value="" 
                                           placeholder="T&eacute;rmino Periodo" class="form-control"/>
                                    <span class="help-block hidden"></span>
                                </div>
                            </div>
                            
                            <div class="form-group col-md-12">
                                <div class="col-md-12 text-right">
                                    <button type="button" id="guardar" class="btn btn-success">
                                        <i class="fa fa-save"></i>  Guardar
                                    </button>
                                    <button type="button" id="cancelar"  class="btn btn-default" 
                                            onclick="location.href='{$base_url}/Vacunas/buscar'">
                                        <i class="fa fa-remove"></i>  Cancelar
                                    </button>
                                    <br/><br/>
                                </div>
                            </div>
                            
                        </div>
                        
                    </div>
                </div>
            </div>
        </form>
                             
    </div>
</section>