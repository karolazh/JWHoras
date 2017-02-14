<section class="content-header">
    <h1><i class="fa fa-envelope"></i><span>&nbsp;Notificación de Zoonosis</span></h1>
</section>

<section class="content">
    <div class="row">
        
        <form  id="form" name="form" enctype="application/x-www-form-urlencoded" action="" method="post">
            
            <div class="col-xs-12 col-md-12">
                <div class="box box-primary">
                    
                    <div class="box-body">
                        <div class="box-header">
                            <h3 class="box-title">Información General</h3>
                        </div>
                        <br>
                        
                        <div class="form-group">
                            
                            <div class="form-group col-md-12">
                                <div class="form-group clearfix col-md-6">
                                    <label for="fecha" class="control-label required">Fecha de Diagnóstico</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="date" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask=""
                                               name="fecha" id="fecha" placeholder="Fecha de Diagnóstico" class="form-control"/>
                                            <span class="help-block hidden"></span>
                                    </div>
                                </div>
                                
                                <div class="form-group clearfix col-md-6">
                                    <label for="patologia" class="control-label required">Patología</label>
                                    <select for="patologia" class="form-control">
                                        <option>Seleccione una Patología</option>
                                        {foreach $arrPatologia as $item} 
                                                <option value="{$item->pat_id}" >{$item->pat_nombre}</option>
                                        {/foreach}
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group col-md-12">
                                <div class="form-group clearfix col-md-6">
                                    <label for="metodo" class="control-label required">Método de diagnóstico</label>
                                    <input type="text" name="metodo" id="metodo" value="" 
                                           placeholder="Método de Diagnóstico" class="form-control"/>
                                    <span class="help-block hidden"></span>
                                </div>
                                
                                <div class="form-group clearfix col-md-6">
                                    <label for="sintomas" class="control-label required">Síntomas</label>
                                    <input type="text" name="sintomas" id="sintomas" value="" 
                                           placeholder="Síntomas" class="form-control"/>
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
                            <h3 class="box-title">Información del Propietario</h3>
                        </div>
                        <br>
                        
                        <div class="form-group ">
                            <div class="form-group col-md-12">
                                <div class="form-group clearfix col-md-5">
                                    <label for="rut" class="control-label required">Rut</label>
                                    <input type="text" name="rut" id="rut" value="" 
                                           placeholder="Rut" class="form-control"/>
                                    <span class="help-block hidden"></span>
                                </div>
                                
                                <div class="form-group clearfix col-md-1">
                                    <label for="rutbtn" class="control-label required">&nbsp</label>
                                    <button type="button" id="rutbtn" class="form-control btn btn-info">
                                        <i class="fa fa-search"></i>  Buscar
                                    </button>
                                </div>
                                
                                <div class="form-group clearfix col-md-6">
                                    <label for="email" class="control-label required">Email</label>
                                    <input type="text" name="email" id="email" value="" 
                                           placeholder="Email" class="form-control"/>
                                    <span class="help-block hidden"></span>
                                </div>
                            </div>
                          
                            
                            <div class="form-group col-md-12">
                                <div class="form-group clearfix col-md-6">
                                    <label for="nombre" class="control-label required">Nombre</label>
                                    <input type="text" name="nombre" id="nombre" value="" 
                                           placeholder="Nombre" class="form-control"/>
                                    <span class="help-block hidden"></span>
                                </div>
                                
                                <div class="form-group clearfix col-md-6">
                                    <label for="apellido" class="control-label required">Apellido</label>
                                    <input type="text" name="apellido" id="apellido" value="" 
                                           placeholder="Apellido" class="form-control"/>
                                    <span class="help-block hidden"></span>
                                </div>
                                </div>
                                <div class="form-group col-md-12">
                                <div class="form-group clearfix col-md-6">
                                    <label for="telefono" class="control-label required">Teléfono</label>
                                    <input type="text" name="telefono" id="telefono" value="" 
                                           placeholder="Teléfono" class="form-control"/>
                                    <span class="help-block hidden"></span>
                                </div>
                                
                                <div class="form-group clearfix col-md-6">
                                    <label for="celular" class="control-label required">Celular</label>
                                    <input type="text" name="celular" id="celular" value="" 
                                           placeholder="Celular" class="form-control"/>
                                    <span class="help-block hidden"></span>
                                </div>
                            </div>
                          
                            
                            <div class="form-group col-md-12">
                                <div class="form-group clearfix col-md-6">
                                    <label for="direccion" class="control-label required">Dirección</label>
                                    <input type="text" name="direccion" id="direccion" value="" 
                                           placeholder="Dirección" class="form-control"/>
                                    <span class="help-block hidden"></span>
                                </div>
                                
                                <div class="form-group clearfix col-md-6">
                                    <label for="comuna" class="control-label required">Comuna</label>
                                    <input type="text" name="comuna" id="comuna" value="" 
                                           placeholder="Comuna" class="form-control"/>
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
                            <h3 class="box-title">Información del Animal</h3>
                        </div>
                        <br>
                        <div class="form-group ">
                            <div class="form-group col-md-12">
                                <div class="form-group clearfix col-md-6">
                                    <label for="vive" class="control-label required">¿Vive con el animal? &nbsp&nbsp&nbsp&nbsp</label>
                                    <fieldset>    
                                        <input type="radio" name="transporte" value="1">&nbsp Sí &nbsp&nbsp
                                        <input type="radio" name="transporte" value="2">&nbsp No
                                    </fieldset>
                                    <span class="help-block hidden"></span>
                                    
                                </div>

                            </div>
                                     
                            
                                <div class="form-group col-md-12">
                                    <div class="form-group clearfix col-md-6">
                                        <label for="direccion" class="control-label required">Dirección</label>
                                        <input type="text" name="direccion" id="direccion" value="" 
                                               placeholder="Dirección" class="form-control"/>
                                        <span class="help-block hidden"></span>
                                    </div>

                                    <div class="form-group clearfix col-md-6">
                                        <label for="comuna" class="control-label required">Comuna</label>
                                        <input type="text" name="comuna" id="comuna" value="" 
                                               placeholder="Comuna" class="form-control"/>
                                        <span class="help-block hidden"></span>
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <div class="form-group clearfix col-md-6">
                                        <label for="sexo" class="control-label required">Sexo</label>
                                        <fieldset>  
                                        <input type="radio" name="sexo" value="Macho">&nbsp Macho &nbsp&nbsp
                                        <input type="radio" name="sexo" value="Hembra">&nbsp Hembra
                                        </fieldset>  
                                        <span class="help-block hidden"></span>
                                    </div>


                                    <div class="form-group clearfix col-md-6">
                                        <label for="especie" class="control-label required">Especie</label>
                                        <select for="especie" class="form-control">
                                            <option>Seleccione una Especie</option>
                                            {foreach $arrEspecie as $item} 
                                                <option value="{$item->esp_id}" >{$item->esp_nombre}</option>
                                        {/foreach}
                                        </select>
                                    </div>
                                </div>
                          
                            
                                <div class="form-group col-md-12">
                                    <div class="form-group clearfix col-md-6">
                                        <label for="edad" class="control-label required">Edad (rango en años)</label>
                                        <select for="edad" class="form-control">
                                            <option selected="selected">Seleccione una Edad</option>
                                        </select>
                                    </div>

                                    <div class="form-group clearfix col-md-6">
                                        <label for="tipo" class="control-label required">Tipo</label>
                                        <select for="tipo" class="form-control">
                                            <option selected="selected">Seleccione un Tipo</option>
                                        </select>
                                    </div>
                                    
                                    <div class="col-md-12 text-right">
                                        <button type="button" id="guardar" class="btn btn-success">
                                            <i class="fa fa-save"></i>  Guardar
                                        </button>
                                        <button type="button" id="cancelar"  class="btn btn-default"
                                                onclick="location.href='{$base_url}/Zoonosis/zoonosis'">
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