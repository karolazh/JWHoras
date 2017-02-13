<div class="row">
    <div class="col-xs-12">
        <legend>Busca personas
        </legend>

        <ol class="breadcrumb">
            <li class="active"><i class="fa fa-angle-right"></i> <strong>Busca personas</strong></li>
        </ol>
               
        <!-- Formulario de busqueda -->
        <div class="row">
            <div class="col-sm-12">
                <div class="well">
                    <form id="form-busqueda">
                        <input type="hidden" name="letra" id="letra" value="" class="elemento-busqueda" />
                        <div class="col-sm-2 hide"> 
                            <div class="form-group clearfix">
                                <label for="rut" class="col-lg-12 control-label text-left margin-remove">Rut:</label>
                                <input type="text" id="rut" name="rut" class="form-control elemento-busqueda" />
                                <span class="help-block hidden"></span>
                            </div>
                        </div>
                        <div class="col-sm-2"> 
                            <div class="form-group clearfix">
                                <label for="nombre" class="col-lg-12 control-label text-left margin-remove">Nombre:</label>
                                <input type="text" id="nombre" name="nombre" class="form-control elemento-busqueda" />
                                <span class="help-block hidden"></span>
                            </div>
                        </div>
                        <div class="col-sm-2"> 
                            <div class="form-group clearfix">
                                <label for="apellido" class="col-lg-12 control-label text-left margin-remove">Apellido:</label>
                                <input type="text" id="apellido" name="apellido" class="form-control elemento-busqueda" />
                                <span class="help-block hidden"></span>
                            </div>
                        </div>
                        <div class="col-sm-2"> 
                            <div class="form-group clearfix">
                                <label for="email" class="col-lg-12 control-label text-left margin-remove">Email:</label>
                                <input type="text" id="email" name="email" class="form-control elemento-busqueda" />
                                <span class="help-block hidden"></span>
                            </div>
                        </div>
                        <div class="col-sm-4 hide"> 
                            <div class="form-group clearfix">
                                <label for="sistemas" class="col-lg-12 control-label text-left margin-remove ">Sistemas:</label>

                                {selectSistemas nombre="sistemas" class="col-sm-12 form-control elemento-busqueda"}

                                <span class="help-block hidden"></span>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-sm-4"> 
                            <div class="form-group clearfix">
                                <label for="oficinas" class="col-lg-12 control-label text-left margin-remove ">Oficinas:</label>

                                {selectOficina nombre="oficinas" class="col-sm-12 form-control elemento-busqueda"}

                                <span class="help-block hidden"></span>
                            </div>
                        </div> 
                        <div class="col-sm-4"> 
                            <div class="form-group clearfix">
                                <label for="region" class="col-lg-12 control-label text-left margin-remove ">Región:</label>

                                {selectRegion nombre="region" class="col-sm-12 form-control elemento-busqueda"}

                                <span class="help-block hidden"></span>
                            </div>
                        </div>
                        <div class="col-sm-4 text-right">
                            <div class="form-group clearfix pull-right">
                                <div class="col-xs-12" style="color:#FFF">_</div>
                                <div class="col-xs-12 pull-right">
                                    <button id="limpiar" type="button" class="btn btn-xs btn-default">
                                        <i class="glyphicon glyphicon-refresh"></i> Limpiar
                                    </button>
                                    <button id="boton-buscar" data-rel="lista_usuarios" type="button" class="btn btn-xs btn-primary">
                                        <i class="glyphicon glyphicon-search"></i> Buscar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

        <!-- Fin de formulario de busqueda -->
                        
        <div class="row">  
            <div class="col-sm-12">
                <div class="well">
                    
                    <div id="abecedario" class="text-center margin-bottom-10 hide">
                        {abecedario}
                    </div>
                    
                    <!-- Contenedor de imagenes -->
                    <div id="contenedor-galeria">
                        <div id="container-waterfall"></div>
                    </div>

                    <!-- Template para cada item -->
                    <script type="text/x-handlebars-template" id="waterfall-tpl">
                        {literal}
                        {{#result}}
                            
                            <div class="item" >
                            
                                <div class="element-flip">
                                    <div>
                                        <a href="javascript: detalle('{{rut}}');" class="ver-usuario" data-rel="{{id}}">
                                            <img src="{{image}}" width="100px" />
                                        </a>
                                    </div>
                                </div>
                                <span style="font-size: 9px">{{nombre}}</span></br>
                                <span style="font-size: 9px"><strong>Valparaiso</strong></span>
                            
                            </div>
                            
                        {{/result}}
                        {/literal}
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Detalle de funcionario</h4>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>