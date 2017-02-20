<div id="adjuntos">
    <section class="content-header">
        <h3 class="panel-title"><i class="fa fa-paperclip fa-fw"></i> Adjuntos asociados</h3>
        <div class="box box-primary">
            
            <div class="box-body">
                <div id="div_tabla" class="table-responsive small"> 
                    <table class="table table-hover table-striped table-bordered dataTable no-footer">
                        <thead>
                            <th>Nombre archivo</th>
                            <th>Comentario</th>
                            <th>Fecha</th>
                            <th></th>
                        </thead>
                        <tbody>
                            {foreach $adjuntos as $a}
                                <tr>
                                    <td>
                                        {if $smarty.session.perfil == 1}
                                            <a title="Ver Adjunto" href="../{$a->gl_ruta_archivo}/{$a->gl_nombre_archivo}" target="_blank">{$a->gl_nombre_archivo}</a>
                                        {else}
                                            <a title="Ver Adjunto" href="../../{$a->gl_ruta_archivo}/{$a->gl_nombre_archivo}" target="_blank">{$a->gl_nombre_archivo}</a>
                                        {/if}
                                    </td>
                                    <td>{$a->gl_comentario} </td>
                                    <td>{$a->fc_fecha_archivo}</td>
                                    <td>
                                        {if $smarty.session.perfil == 1}
                                            <a data-toggle="tooltip" title="Ver adjunto"  href="../{$a->gl_ruta_archivo}/{$a->gl_nombre_archivo}" target="_blank" class="btn btn-sm btn-info btn-flat" >
                                            <i class="fa fa-file-o"></i></a>
                                        {else}
                                            <a data-toggle="tooltip" title="Ver Adjunto" href="../../{$a->gl_ruta_archivo}/{$a->gl_nombre_archivo}" target="_blank" class="btn btn-sm btn-info btn-flat" >
                                            <i class="fa fa-file-o"></i></a>
                                        {/if}
                                        <button type="button" id="btn-{$a->id_archivo}" data-toggle="tooltip" title="Eliminar Adjunto"   class="btn btn-sm btn-danger btn-flat" onclick="Adjuntos.eliminarAdjunto({$a->id_archivo})">
                                            <i class="fa fa-remove"></i></button>
                                            <input type="hidden" id="id_archivo" name="id_archivo" value="{$a->id_archivo}">
                                            <input type="hidden" id="ticket" name="ticket" value="{$a->cd_solicitud_fk_archivo}">
                                    </td>
                                </tr>
                            {/foreach} 
                        </tbody>
                    </table>       
                </div>
            </div>
        </div>
    </section>
</div>