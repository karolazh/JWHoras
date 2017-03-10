<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<section class="content-header">
    <h1><i class="fa fa-hospital-o"></i>&nbsp; {$titulo} </h1>
    <div class="col-md-12 text-right">
		{*{if $mostrar_plan != 1}
        <button type="button" id="ingresar" onclick="location.href = '{$base_url}/Paciente/nuevo'"
                class="btn btn-success">
            <i class="fa fa-plus"></i>&nbsp;&nbsp;Nuevo Registro
        </button>
		{/if}*}
    </div>
    <br/><br/>
</section>

<section class="content">
    <div class="box box-primary">
        <div class="box-body">
            <div class="table-responsive col-lg-12" data-row="10">
                <table id="tablaPrincipal" class="table table-hover table-striped table-bordered dataTable no-footer">
                    <thead>
                        <tr role="row">
                            <th class="text-center" width="5%">Fecha Registro</th>
                            <th class="text-center" width="5%">RUT/RUN/Pasaporte Paciente</th>                            
                            <th class="text-center" width="15%">Nombre Paciente</th>
                            <th class="text-center" width="">Centro Salud</th>
                            <th class="text-center" width="">Ex&aacute;men</th>
                            <th class="text-center" width="">Laboratorio</th>
                            <th class="text-center" width="5%">Resultado</th>
                            <th class="text-center" width="15%">Funcionario</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        {foreach $arrResultado as $item}
                            {if $item->gl_resultado == "A"}
                            <tr>
                                <td style="color:#ff0000; background: #F7D3D2;" class="text-center" nowrap>
                                    {$item->fc_crea} </td>
                                <td style="color:#ff0000; background: #F7D3D2;" class="text-center">
                                    {if $item->bo_extranjero == 1}
                                        {$item->gl_run_pass}
                                    {else}
                                        {$item->gl_rut}
                                    {/if}
                                </td>
                                <td style="color:#ff0000; background: #F7D3D2;" class="text-left">
                                    {$item->gl_nombre_paciente} </td>
                                <td style="color:#ff0000; background: #F7D3D2;" class="text-left">
                                    {$item->gl_nombre_establecimiento} </td>
                                <td style="color:#ff0000; background: #F7D3D2;" class="text-left">
                                    {$item->gl_nombre_examen} </td>
                                <td style="color:#ff0000; background: #F7D3D2;" class="text-center">
                                    {$item->gl_nombre_laboratorio} </td>
                                <td style="background: #F7D3D2;" class="text-center" nowrap>
                                    <span class="label label-danger">ALTERADO</span></td>
                                <td style="color:#ff0000; background: #F7D3D2;" class="text-left">
                                    {$item->gl_funcionario} </td>
                                <td style="background: #F7D3D2;" class="text-center" nowrap>
                                    <button type="button" 
                                            onClick="xModal.open('{$smarty.const.BASE_URI}/Paciente/ver/{$item->id_paciente}', 'Detalle Registro', 85);" 
                                            data-toggle="tooltip" 
                                            class="btn btn-xs btn-info"
                                            title="Ver Registro">
                                            <i class="fa fa-search"></i>
                                    </button>
                                    <button type="button"
                                            onClick="xModal.open('{$smarty.const.BASE_URI}/Laboratorio/ver/{$item->id_paciente_examen}/{$item->id_paciente}', 'Detalle Exámen', 85);"
                                            data-toggle="tooltip" 
                                            title="Formulario Examen" 
                                            class="btn btn-xs btn-success">
                                            <i class="fa fa-book"></i>
                                    </button>
                                    <button type="button"
                                            onClick="xModal.open('{$smarty.const.BASE_URI}/Bitacora/ver/{$item->id_paciente}', 'Registro número : {$item->id_paciente}', 85);" 
                                            data-toggle="tooltip" 
                                            title="Revisar bitácora" 
                                            class="btn btn-xs btn-primary">
                                            <i class="fa fa-info-circle"></i>
                                    </button>
                                </td>
                            </tr>
                            {else}
                            <tr>
                                <td class="text-center" nowrap>
                                    {$item->fc_crea} </td>
                                <td class="text-center">
                                    {if $item->bo_extranjero == 1}
                                        {$item->gl_run_pass}
                                    {else}
                                        {$item->gl_rut}
                                    {/if}
                                </td>
                                <td class="text-left">
                                    {$item->gl_nombre_paciente} </td>
                                <td class="text-left">
                                    {$item->gl_nombre_establecimiento} </td>
                                <td class="text-left">
                                    {$item->gl_nombre_examen} </td>
                                <td class="text-center">
                                    {$item->gl_nombre_laboratorio} </td>
                                <td class="text-center" nowrap>
                                    {if $exa->gl_resultado == "N"}
                                        <h6><b><span class="label label-success">NORMAL</span></b></h6>
                                    {else}
                                        <h6><b><span class="label label-warning">SIN INFORMACI&Oacute;N</span></b></h6>
                                    {/if}
                                <td class="text-left">
                                    {$item->gl_funcionario} </td>
                                <td class="text-center" nowrap>
                                    <button type="button" 
                                            onClick="xModal.open('{$smarty.const.BASE_URI}/Paciente/ver/{$item->id_paciente}', 'Detalle Registro', 85);" 
                                            data-toggle="tooltip" 
                                            class="btn btn-xs btn-info"
                                            title="Ver Registro">
                                            <i class="fa fa-search"></i>
                                    </button>
                                    <button type="button"
                                            onClick="xModal.open('{$smarty.const.BASE_URI}/Laboratorio/ver/{$item->id_paciente_examen}/{$item->id_paciente}', 'Registro número : {$item->id_paciente}', 85);" 
                                            data-toggle="tooltip" 
                                            title="Formulario Examen" 
                                            class="btn btn-xs btn-success">
                                            <i class="fa fa-book"></i>
                                    </button>
                                    <button type="button"
                                            onClick="xModal.open('{$smarty.const.BASE_URI}/Bitacora/ver/{$item->id_paciente}', 'Registro número : {$item->id_paciente}', 85);" 
                                            data-toggle="tooltip" 
                                            title="Revisar bitácora" 
                                            class="btn btn-xs btn-primary">
                                            <i class="fa fa-info-circle"></i>
                                    </button>
                                </td>
                            </tr>
                            {/if}
                        {/foreach}
                    </tbody>
                </table>
            </div>
        </div>
    </div>    
</section>