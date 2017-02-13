<link href="{$static}template/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css"/>

<section class="content-header">
    <h1>Nuevo Registro
        <small>Ingresar nuevo documento</small>
    </h1>
</section>

<section class="content">
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Formulario de Registro</h3>
        </div>
        <div class="box-body">
            <form role="form" class="form-horizontal">
                <div class="row">
                    <div class="col-md-6 top-spaced">
                        <div class="margin-bottom-10"></div>

                        <div class="form-group">
                            <label for="exampleInputEmail1" class="col-lg-4 control-label">Subsecretaria</label>
                            <div class="col-lg-8">
                                <select class="form-control" name="subsecretaria" id="subsecretaria"
                                        onchange="Documento.cargarCentrosResponsabilidad(this.value,'centro_responsabilidad');">
                                    <option value="0">-- Seleccione --</option>
                                    {foreach from=$subsecretarias item=item}
                                        <option value="{$item->id_subsecretaria}">{$item->nombre_subsecretaria}</option>
                                    {/foreach}
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1" class="col-lg-4 control-label">Tipo Documento</label>
                            <div class="col-lg-8">


                                <select class="form-control" id="tipo_documento" name="tipo_documento">
                                    <option value="0">-- Seleccione --</option>
                                    {foreach from=$tipo_documentos item=item}
                                        <option value="{$item->id_tipodocumento}">{$item->nombre_tipodocumento}</option>
                                    {/foreach}
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1" class="col-lg-4 control-label">Nro del Documento</label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control numbers" id="numero_documento"
                                       name="numero_documento" placeholder="">

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1" class="col-lg-4 control-label">RUT emisor</label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control typeahead" id="rut_emisor" name="rut_emisor"
                                       placeholder="Escriba rut">

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1" class="col-lg-4 control-label">Nro.Orden de
                                compra</label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" id="numero_compra" name="numero_compra"
                                       placeholder="">

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1" class="col-lg-4 control-label">Centro de
                                Responsabilidad</label>
                            <div class="col-lg-8">
                                <select class="form-control" id="centro_responsabilidad" name="centro_responsabilidad"
                                        onchange="Documento.cargarVisadores(this.value,'asignacion_visador');">
                                    <option value="">-- Debe seleccionar Subsecretaría --</option>
                                </select>
                            </div>
                        </div>


                    </div>

                    <div class="col-md-6 top-spaced">
                        <div class="margin-bottom-10"></div>

                        <div class="form-group">
                            <label for="exampleInputEmail1" class="col-lg-4 control-label">Fecha ingreso a Oficina de
                                partes</label>
                            <div class="col-md-3 col-xs-12">
                                <div class="input-group">
                                    <input type="text" class="form-control datepicker" readonly
                                           style="border-radius: 0" id="fecha_oficina"
                                           name="fecha_oficina"
                                           placeholder="">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1" class="col-lg-4 control-label">ID registro en
                                SIGFE</label>
                            <div class="col-lg-7">
                                <input type="text" class="form-control" id="id_registro_sigfe" name="id_registro_sigfe"
                                       placeholder="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1" class="col-lg-4 control-label">Tipo de compra</label>
                            <div class="col-lg-7">
                                <select class="form-control" id="tipo_compra" name="tipo_compra">
                                    <option value="">-- Seleccione --</option>
                                    {foreach from=$tipo_compras item=item}
                                        <option value="{$item->id_tipocompra}">{$item->nombre_tipocompra}</option>
                                    {/foreach}
                                    <!-- <option value="Compra de bienes o productos">Compra de bienes o productos</option>
                                    <option value="Compra de servicios">Compra de servicios</option>
                                    <option value="Ambos">Ambos</option> -->
                                </select>

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1" class="col-lg-4 control-label">Nombre Emisor</label>
                            <div class="col-lg-7">
                                <input type="text" class="form-control" id="nombre_emisor" name="nombre_emisor"
                                       placeholder="">

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1" class="col-lg-4 control-label">Subtitulo
                                Presupuestario</label>
                            <div class="col-lg-7">


                                <select class="form-control" id="subtitulo_presupuestario"
                                        name="subtitulo_presupuestario">
                                    <option value="">-- Seleccione --</option>
                                    <option value="22">22</option>
                                    <option value="24">24</option>
                                    <option value="29">29</option>
                                    <option value="31">31</option>
                                    <option value="33">33</option>
                                </select>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1" class="col-lg-4 control-label">Asignación de
                                visador</label>
                            <div class="col-lg-7">

                                <select class="form-control " id="asignacion_visador" name="asignacion_visador">
                                    <option value="">-- Debe seleccionar Centro Responsabilidad --</option>
                                    {*{foreach from=$visadores item=item}
                                        <option value="{$item->id}">{$item->nombres} {$item->apellidos}</option>
                                    {/foreach}*}

                                    {*<option value="22">22</option>
                                    <option value="24">24</option>
                                    <option value="29">29</option>
                                    <option value="31">31</option>
                                    <option value="33">33</option>*}
                                </select>


                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-4 control-label">Monto ($)</label>
                            <div class="col-lg-3">
                                <input type="text" name="monto" id="monto" class="form-control"
                                       onkeyup="Documento.validarSoloNumeros(this);"
                                       onchange="Documento.validarSoloNumeros(this);"/>
                                <span class="help-block label label-danger" id="mensaje_monto"></span>
                            </div>
                        </div>

                        {*<div class="form-group">
                            <label class="col-lg-4 control-label">Número Folio SIGFE</label>
                            <div class="col-lg-3">
                                <input type="text" name="numero_folio_sigfe" id="numero_folio_sigfe" class="form-control"/>
                            </div>
                        </div>*}


                    </div>


                </div>
                <div class="row top-spaced margin-bottom-10">
                    <div class="col-xs-12 top-spaced">

                        <div class="form-group">
                            <label for="exampleInputEmail1"
                                   class="col-xs-12  col-md-2 control-label">Descripción</label>
                            <div class="col-xs-12 col-md-10">
                                <textarea class="form-control form-control-textarea" name="descripcion" id="descripcion"
                                          rows="10"></textarea>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="top-spaced">

                    <div class="box box-info">
                        <div class="box-header">
                            Archivos adjuntos
                            <button type="button" class="btn btn-success btn-xs btn-flat"
                                    onClick="xModal.open('{$smarty.const.BASE_URI}/Documento/adjuntarArchivo','Adjuntar Archivos',50,'adjuntar',true,280);">
                                <i class="fa fa-upload"></i></button>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive" id="lista_adjuntos"></div>
                        </div>
                    </div>
                </div>


                <div class="margin-bottom-10"></div>
                <button type="button" class="btn btn-success pull-right btn-flat"
                        onclick="Documento.guardarNuevoDocumento(this.form,this);">
                    Guardar documento
                </button>


            </form>
        </div>
    </div>
</section>

