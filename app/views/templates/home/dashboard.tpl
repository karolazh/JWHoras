<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<section class="content-header">
    <h1><i class="fa fa-home"></i> <span>Inicio</span></h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12 col-md-6">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Estadística Nacional</h3>
                </div>
                <div class="box-body">
                    <div class="col-xs-7">
                        <canvas id="graficoA"></canvas>
                    </div>
                    <div class="col-xs-5">
                        <div id="graficoA_legend"></div>
                    </div>
                </div>
            </div>
        </div>
                
        <div class="col-xs-12 col-md-6">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Estadística Regional</h3>
                </div>
                <div class="box-body">
                    <div id="map"></div>
                    <div class="col-xs-7">
                        <canvas id="graficoA"></canvas>
                    </div>
                    <div class="col-xs-5">
                        <div id="graficoA_legend"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
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
                                <td nowrap width="100px" align="center"> {$item->not_id} </td>
                                {*<td class="text-center">{$item->asunto|truncate:60:"...":true}</td>*}
                                <td class="text-center">{$item->not_titulo}</td>
                                <td class="text-center">?</td>
                                <td align="center">
                                    {*<button data-toggle="tooltip" type="button" class="btn btn-sm btn-success btn-flat" title="Ver Detalle" 
                                            onClick="xModal.open('{$smarty.const.BASE_URI}/Solicitudes/revisarSolicitud/{$item->id_solicitud}',
                                                                 'Revisar Solicitud',85);">
                                        <i class="fa fa-edit"></i>&nbsp;&nbsp;Ver
                                    </button>*}
                                    {*<button data-toggle="tooltip" type="button" class="btn btn-sm btn-success btn-flat" title="Ver Detalle" 
                                            onClick="">
                                        <i class="fa fa-edit"></i>&nbsp;&nbsp;Ver
                                    </button>*}
                                    <button type="button" class="btn btn-sm btn-success btn-flat" 
                                            onClick="location.href='{$base_url}/Home/verNoticia/{$item->not_id}'" 
                                            data-toggle="tooltip" title="Ver Noticia">
                                        <i class="fa fa-eye"></i>&nbsp;&nbsp;Ver
                                    </button>
                                </td>
                            </tr>
                        {/foreach}
                        </tbody>
                    </table>
                    <br/>
                    {*<div class="col-xs-7">
                        <canvas id="graficoB"></canvas>
                    </div>
                    <div class="col-xs-5">
                        <div id="graficoB_legend"></div>
                    </div>*}
                </div>
            </div>
        </div>
    </div>
</section>
                        
</body>