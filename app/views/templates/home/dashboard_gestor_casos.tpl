<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet"
      type="text/css"/>
<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet"
      type="text/css"/>

<section class="content-header">
    <h1><i class="fa fa-home"></i> <span>Inicio</span></h1>
</section>

<section class="content">
    <div class="row">

        <div role="tabpanel">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="#alarmas" aria-controls="alarmas" role="tab" data-toggle="tab">Alarmas</a>
                </li>
                <li role="presentation">
                    <a href="#mapa" aria-controls="mapa" role="tab" data-toggle="tab" onclick="Home.initMapaGestor();">Mapa</a>
                </li>
                <li role="presentation">
                    <a href="#estadisticas" aria-controls="estadisticas" role="tab" data-toggle="tab">Estadísticas</a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="alarmas">

                    <div class="col-xs-12">
                        <legend>Alarmas</legend>
                        <div class="row">
                            <!-- contenedor alarma reconoce violencia -->
                            <div class="col-xs-12 col-md-6">
                                <div class="box box-primary">
                                    <div class="box-header">
                                        <div class="box-title">Reconoce Violencia</div>
                                    </div>
                                    <div class="box-body">
                                        <div class="col-xs-12">
                                            <div class="info-box bg-red">
                                                <span class="info-box-icon"><i class="fa fa-female"></i></span>

                                                <div class="info-box-content">
                                                    <span class="info-box-text">Casos en que reconoce violencia</span>
                                                    <span class="info-box-number">{$total_violencia}</span>

                                                    <div class="progress" style="height:34px">
                                                        <div class="progress-bar" style="width: 0%" id="barra-reconoce-violencia"></div>
                                                    </div>
                                                    <span class="progress-description text-right">
                                                        <strong>{$porcentaje_violencia}%</strong> de un total de <strong>{$total_pacientes}</strong> pacientes
                                                    </span>
                                                </div>
                                                <!-- /.info-box-content -->
                                            </div>
                                            <!-- /.info-box -->
                                        </div>

                                        <div class="table-responsive col-xs-12">
                                            <table class="table table-condensed table-hover table-bordered dataTable paginada"
                                                   id="tabla-reconoce-violencia">
                                                <thead>
                                                <tr>
                                                    <th>Días</th>
                                                    <th>RUT</th>
                                                    <th>Nombre</th>
                                                    <th>Comuna</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                {if $arr_violencia}
                                                    {foreach from=$arr_violencia item=item}
                                                        <tr>
                                                            <td class="text-center">{$item->nr_dias_primera_visita}</td>
                                                            <td class="text-center">{$item->gl_identificacion}</td>
                                                            <td class="text-center">{$item->gl_nombres} {$item->gl_apellidos}</td>
                                                            <td class="text-center">{$item->gl_nombre_comuna}</td>
                                                        </tr>
                                                    {/foreach}
                                                {/if}
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- fin alarma reconoce violencia -->

                            <!-- contenedor alarma mamograficas -->
                            <div class="col-xs-12 col-md-6">
                                <div class="box box-primary">
                                    <div class="box-header">
                                        <div class="box-title">Exámen PAP o Mamografía Alterado</div>
                                    </div>
                                    <div class="box-body">
                                        <div class="col-xs-12">
                                            <div class="info-box bg-yellow">
                                                <span class="info-box-icon"><i class="fa fa-stethoscope"></i></span>

                                                <div class="info-box-content">
                                                    <span class="info-box-text">Casos con examen PAP o mamografía alterado</span>
                                                    <span class="info-box-number">{$total_pap}</span>

                                                    <div class="progress" style="height: 34px;">
                                                        <div class="progress-bar" style="width: 0%" id="barra-pap-alterado"></div>
                                                    </div>
                                                    <span class="progress-description text-right">
                                                        <strong>{$porcentaje_pap}%</strong> de un total de <strong>{$total_pacientes}</strong> pacientes
                                                    </span>
                                                </div>
                                                <!-- /.info-box-content -->
                                            </div>
                                            <!-- /.info-box -->
                                        </div>

                                        <div class="table-responsive col-xs-12">
                                            <table class="table table-condensed table-hover table-bordered dataTable paginada"
                                                   id="tabla-pap-alterado">
                                                <thead>
                                                <tr>
                                                    <th>Días</th>
                                                    <th>RUT</th>
                                                    <th>Nombre</th>
                                                    <th>Comuna</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                {if $arr_violencia}
                                                    {foreach from=$arr_pap item=item}
                                                        <tr>
                                                            <td class="text-center">{$item->nr_dias_primera_visita}</td>
                                                            <td class="text-center">{$item->gl_identificacion}</td>
                                                            <td class="text-center">{$item->gl_nombres} {$item->gl_apellidos}</td>
                                                            <td class="text-center">{$item->gl_nombre_comuna}</td>
                                                        </tr>
                                                    {/foreach}
                                                {/if}
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- fin contenedor alarma mamograficas -->
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="mapa">
                    <div class="col-xs-12">
                        <legend>Mapa</legend>
                        <div id="mapa_gestor" style="height: 600px;" class="col-xs-12"></div>
                        <input type="hidden" name="latitud" id="latitud" value="-33.04864"/>
                        <input type="hidden" name="longitud" id="longitud" value="-71.613353"/>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="estadisticas">
                    <div class="col-xs-12">
                        <legend>Estadísticas</legend>
                        <div class="row">
                            <div class="col-xs-12 col-md-4">
                                <div class="box box-primary">
                                    <div class="box-header">
                                        <h3 class="box-title" id="titulo_registros_estados"></h3>
                                    </div>
                                    <div class="box-body">
                                        <div class="col-xs-12">
                                            <div id="grafico_estados_general" style="height: 700px;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-8">
                                <div class="box box-primary">
                                    <div class="box-header">
                                        <h3 class="box-title" id="titulo_fechas_registros"></h3>
                                    </div>
                                    <div class="box-body">
                                        <div class="col-xs-12">
                                            <div id="grafico_fechas_registros" style="height: 350px"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-4">
                                <div class="box box-primary">
                                    <div class="box-header">
                                        <h3 class="box-title" id="titulo_reconoce_abuso"></h3>
                                    </div>
                                    <div class="box-body">
                                        <div class="col-xs-12">
                                            <div id="grafico_reconoce_abuso" style="height: 300px"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-4">
                                <div class="box box-primary">
                                    <div class="box-header">
                                        <h3 class="box-title" id="titulo_acepta_programa"></h3>
                                    </div>
                                    <div class="box-body">
                                        <div class="col-xs-12">
                                            <div id="grafico_acepta_programa" style="height: 300px"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- <div class="row">
        <div class="col-xs-12 col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Noticias e Informativos</h3>
                </div>
                <div class="box-body">
                    <table id="tablaPrincipal" class="table table-hover table-condensed table-bordered table-middle datatable paginada">
                        <thead>
                            <tr role="row">
                                <th align="center" width="10%">#ID</th>
                                <th align="center" width="30%">T&iacute;tulo</th>
                                <th align="center" width="50%">Resumen</th>
                                <th align="center" width="10%">Acciones</th>
                            </tr>
                        </thead>

                        <tbody>
                        {foreach $arrResultado as $item}
                            <tr>
                                <td nowrap width="100px" align="center"> {$item->id_noticia} </td>
                                <td class="text-center">{$item->gl_titulo}</td>
                                <td class="text-center">?</td>
                                <td align="center">

                                    <button type="button" class="btn btn-sm btn-success btn-flat" 
                                            onClick="location.href='{$base_url}/Home/verNoticia/{$item->id_noticia}'" 
                                            data-toggle="tooltip" title="Ver Noticia">
                                        <i class="fa fa-eye"></i>&nbsp;&nbsp;Ver
                                    </button>
                                </td>
                            </tr>
                        {/foreach}
                        </tbody>
                    </table>
                    <br/>
                </div>
            </div>
        </div>
    </div> -->
</section>

</body>