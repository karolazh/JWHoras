<section class="content-header">
    <h1><i class="fa fa-paw"></i><span>&nbsp;Registro de Accidentes por Mordedura</span></h1>
</section>

<section class="content">
    <div class="row">
        
        <form  id="form" name="form" enctype="application/x-www-form-urlencoded" action="" method="post">
            
            <div class="col-xs-12 col-md-12">
                <div class="box box-primary">
                    
                    <div class="box-body">
                        <div class="box-header">
                            <h3 class="box-title">Datos del afectado</h3>
                        </div>
                        <br>
                        
                        <div class="form-group ">
                            <div class="form-group col-md-6">
                                <div class="form-group clearfix col-md-6">
                                    <label for="rut" class="control-label required">Rut afectado (*)</label>
                                    <input type="text" name="rut" id="rut" value="" 
                                           placeholder="Rut afectado" class="form-control"/>
                                    <span class="help-block hidden"></span>
                                </div>
                            </div>
                            
                            <div class="form-group col-md-12">
                                <div class="form-group clearfix col-md-6">
                                    <label for="nombre" class="control-label required">Nombre (*)</label>
                                    <input type="text" name="nombre" id="nombre" value="" 
                                           placeholder="Nombre de la víctima" class="form-control"/>
                                    <span class="help-block hidden"></span>
                                </div>
                                
                                <div class="form-group clearfix col-md-6">
                                    <label for="apellido" class="control-label required">Apellido (*)</label>
                                    <input type="text" name="apellido" id="apellido" value="" 
                                           placeholder="Apellido de la víctima" class="form-control"/>
                                    <span class="help-block hidden"></span>
                                </div>
                            </div>
                            
                            <div class="form-group col-md-12">
                                <div class="form-group clearfix col-md-6">
                                    <label for="direccion" class="control-label required">Direcci&oacute;n (*)</label>
                                    <input type="text" name="direccion" id="direccion" value="" 
                                           placeholder="Dirección del afectado" class="form-control"/>
                                    <span class="help-block hidden"></span>
                                </div>
                                
                                <div class="form-group clearfix col-md-6">
                                    <label for="telefono" class="control-label required">Tel&eacute;fono</label>
                                    <input type="text" name="telefono" id="telefono" value="" 
                                           placeholder="Teléfono" class="form-control"/>
                                    <span class="help-block hidden"></span>
                                </div>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <div class="form-group clearfix col-md-6">
                                    <label for="fecha" class="control-label required">Fecha Mordida (*)</label>
                                    <input type="text" name="fecha" id="fecha" value="" 
                                           placeholder="Fecha Mordida" class="form-control"/>
                                    <span class="help-block hidden"></span>
                                </div>
                            </div>
                            
                        </div>
                        
                    </div>
                </div>
            </div>
            
            <div class="col-xs-12 col-md-12">
                <div class="box box-primary">
                    
                    <div class="box-body">
                        <div class="box-header">
                            <h3 class="box-title">Datos del animal</h3>
                        </div>
                        <br>
                        
                        <div class="form-group ">
                            <div class="form-group col-md-12">
                                <div class="form-group clearfix col-md-6">
                                    <label for="comuna" class="control-label required">Comuna domicilio animal (*)</label>
                                    <input type="text" name="comuna" id="comuna" value="" 
                                           placeholder="Seleccione una comuna" class="form-control"/>
                                    <span class="help-block hidden"></span>
                                </div>
                                
                                <div class="form-group clearfix col-md-6">
                                    <label for="direccionanimal" class="control-label required">Direcci&oacute;n domicilio animal (*)</label>
                                    <input type="text" name="direccionanimal" id="direccionanimal" value="" 
                                           placeholder="Dirección domicilio animal" class="form-control"/>
                                    <span class="help-block hidden"></span>
                                </div>
                            </div>
                            
                            <div class="form-group col-md-12">
                                <div class="form-group clearfix col-md-12">
                                    <label for="referencia" class="control-label required">Referencia</label>
                                    <input type="text" name="referencia" id="referencia" value="" 
                                           placeholder="Detalle datos adicionales para la dirección" class="form-control"/>
                                    <span class="help-block hidden"></span>
                                </div>
                            </div>
                            
                            <div class="form-group col-md-12">
                                <div class="form-group clearfix col-md-6">
                                    <label for="especie" class="control-label required">Especie (*)</label>
                                    <input type="text" name="especie" id="comuna" value="" 
                                           placeholder="Seleccione una especie" class="form-control"/>
                                    <span class="help-block hidden"></span>
                                </div>
                                
                                <div class="form-group clearfix col-md-6">
                                    <label for="caracteristicas" class="control-label required">Caracter&iacute;sticas del animal</label>
                                    <input type="text" name="caracteristicas" id="caracteristicas" value="" 
                                           placeholder="Características del animal" class="form-control"/>
                                    <span class="help-block hidden"></span>
                                </div>
                                
                                <div class="form-group col-md-12">
                                    <div class="form-group clearfix col-md-16">
                                        <label for="fecha" class="control-label required">
                                            Mascota sin dueño <input id="chkPropietario" type="checkbox" />
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <div class="form-group clearfix col-md-16">
                                        <label for="fecha" class="control-label required">(*) Datos Obligatorios</label>
                                    </div>
                                </div>
                                
                                <div class="col-md-12 text-right">
                                    <button type="button" id="guardar" class="btn btn-success">
                                        <i class="fa fa-save"></i>  Guardar
                                    </button>
                                    <button type="button" id="cancelar"  class="btn btn-default" 
                                            onclick="location.href='{$base_url}/Home/dashboard'">
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