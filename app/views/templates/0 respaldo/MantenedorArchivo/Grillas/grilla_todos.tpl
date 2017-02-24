<table id="tablaPrincipal" class="table table-hover table-striped table-bordered  dataTable no-footer small">
    <thead>
    <tr role="row">
        <th align="center">ID</th>
        <th align="center">Fecha Registro</th>
        <th align="center">Subsecretaría</th>
        <th align="center">Tipo Documento</th>
        <th align="center">Nº Documento</th>
        <th align="center">Rut Emisor</th>
        <th align="center">Nombre Emisor</th>
        <th align="center">Centro de Responsabilidad</th>
        <th align="center">Asignado a</th>
        <th align="center">Fecha ingreso Of. Partes</th>
        <th>Días hábiles en Bandeja</th>
        <th>Fecha Visación</th>
        <th align="center">Tipo Compra</th>
        <th>Estado</th>
        <th width="1px" align="center">&nbsp;</th>
    </tr>
    </thead>
    <tbody>

    {foreach $arrResultado as $itm}
        <tr>
            <td nowrap width="100px" align="center" {if $itm->gl_origen|trim == "ASD"} style="background-color:#76EC76 !important" {/if} >{$itm->id_solicitud}</td>
            <td class="text-center">{Fechas::formatearHtml($itm->fc_fecha_solicitud)}</td>
            <td nowrap width="100px" align="center">{$itm->nombre_subsecretaria}</td>
            <td class="text-center">{$itm->nombre_tipodocumento}</td>
            <td class="text-center">{$itm->nr_numero_documento_solicitud}</td>
            <td nowrap class="text-center">{$itm->gl_rut_emisor_solicitud}</td>
            <td align="center" nowrap>{$itm->gl_nombre_emisor_solicitud}</td>
            <td class="text-center">
                {$itm->nombre_centroresponsabilidad}

            </td>
            <td align="center">{$itm->nombres} {$itm->apellidos}</td>
            <td align="center">{Fechas::formatearHtml($itm->fc_fecha_ingreso_partes_solicitud)}</td>
            {*<td align="center">{Fechas::diffDias(date('Y-m-d'),$itm->fc_fecha_ingreso_partes_solicitud,true) - $itm->total_dias_feriados}</td>*}
            {*<td align="center">{Fechas::diffDias(date('Y-m-d'),$itm->fc_fecha_ingreso_partes_solicitud,true) - $itm->total_dias_feriados} ({Fechas::diffDias(date('Y-m-d'),$itm->fc_fecha_ingreso_partes_solicitud,true)} cronológicos)</td>*}
            <td align="center">{$itm->dias_bandeja}</td>
            <td align="center">{$itm->fecha_visacion}</td>
            <td align="center">{$itm->nombre_tipocompra}</td>
            <td class="text-center">
                {if $itm->cd_estado_solicitud == 1}
                    Aprobado
                {elseif $itm->cd_estado_solicitud == 2}
                    Rechazado
                {elseif $itm->cd_estado_solicitud == 3}
                    Devuelto Proveedor
                {elseif $itm->cd_estado_solicitud == 4}
                    Devengado
                {elseif $itm->cd_estado_solicitud == 5}
                    Archivado en Contabilidad
                {elseif $itm->cd_estado_solicitud == 6}
                    Duplicidad en Registro
                {else}
                    Por Revisar
                {/if}
            </td>
            <td nowrap class="text-center">
                {* <button data-toggle="tooltip" type="button" class="btn btn-xs btn-success" title="Ver Detalle" onClick="detalle({$itm->ins_ia_id})">
                     <i class="fa fa-edit"></i>&nbsp;&nbsp;VER
                 </button>*}
                <button data-toggle="tooltip" type="button" class="btn btn-sm btn-success btn-flat" title="Ver Detalle" onClick="xModal.open('{$smarty.const.BASE_URI}/Documento/revisarDocumento/{$itm->id_solicitud}/historico','Detalle Documento',85);">
                    <i class="fa fa-search"></i> Detalle
                </button>
            </td>
        </tr>
    {/foreach}
    </tbody>
</table>        