<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<div class="box-body">
    <div id="div_tabla" class="table-responsive small"> 
        <table id="tablaPrincipal" class="table table-hover table-striped table-bordered  table-middle dataTable no-footer">
            <thead>
                <tr role="row">
                    <th align="center" width="10%">Fecha</th>
                    <th align="center" width="30">Instituci&oacute;n</th>
                    <th align="center" width="20">Comuna</th>
                    <th align="center" width="20%">Funcionario</th>
                    <th align="center" width="10%">Estado EMPA</th>
                    <th align="center" width="10%">Acciones</th>
                </tr>
            </thead>
            <tbody>
            {foreach $arrEmpa as $emp}
                <tr>
                    {*<td>{$emp->fc_crea}</td>*}
                    <td>
                        {if $emp->bo_finalizado == 0}
                            {$emp->fc_crea}
                        {else}
                            {$emp->fc_empa}
                        {/if}
                    </td>
                    <td>{$emp->gl_nombre_comuna}</td>
                    <td>{$emp->gl_nombre_establecimiento}</td>
                    <td>{$emp->funcionario}</td>
                    <td class="text-center">
                        {if $emp->bo_finalizado == 0}
                            <span class="label label-success">EN PROCESO</span>
                        {else}
                            <span class="label label-danger">FINALIZADO</span>
                        {/if}
                    </td>
                    <td class="text-center" style="width:100px;">
                        <div class="btn-group">
                            <button type="button" class="btn btn-xs btn btn-success" 
                                    {*onClick="xModal.open('{$base_url}/Empa/nuevo/{$emp->id_registro}', 'Registro número : {$item->id_registro}', 85);" *}
                                    {*onClick="location.href='{$base_url}/Empa/nuevo/{$emp->id_registro}'" *}
                                    onClick="location.href='{$base_url}/Empa/nuevo/{$emp->id_paciente}'" 
                                    data-toggle="tooltip" title="Ver EMPA">
                                <i class="fa fa-book"></i>&nbsp;&nbsp;EMPA
                            </button>
                        </div>
                    </td>
                </tr>
            {/foreach}
            </tbody>
        </table>            
    </div>
</div>