<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<section class="content-header">
    <h1><i class="fa fa-home"></i> <span>Inicio</span></h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12 col-md-4">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Estadística Nacional : Total de Registros por Estados</h3>
                </div>
                <div class="box-body">
                    <div class="col-xs-12">
                        <div id="grafico_estados_general" style="height: 600px;"></div>
                    </div>
                </div>
            </div>
        </div>
                
        <div class="col-xs-12 col-md-4">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Estadística Nacional : Reconoce abuso</h3>
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
                    <h3 class="box-title">Estadística Nacional : Acepta Programa</h3>
                </div>
                <div class="box-body">
                    <div class="col-xs-12">
                        <div id="grafico_acepta_programa" style="height: 300px"></div>
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