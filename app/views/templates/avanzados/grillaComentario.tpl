<!--muestra los comentarios del ticket-->
<div id="comments">
    <section class="content-header">
    <h3 class="panel-title"><i class="fa fa-comment-o fa-fw"></i> Comentarios asociados</h3>
        <div class="box box-primary">
            <div class="box-header">
               
            </div>
            <div class="box-body">
                <div id="div_tabla" class="table-responsive small"> 
                    <table class="table table-hover table-striped table-bordered  dataTable no-footer">
                        <thead>
                            <!--<th>ID</th>-->
                            <th>Comentario</th>
                            <th>Creado por</th>
                        </thead>
                        <tbody>
                            {foreach $comentarios as $com}
                                <tr>
                                    <!--<td>{$com->id_comentario}</td>-->
                                    <td>{$com->gl_comentario}</td>
                                    <td>{$com->usuario}</td>
                                </tr>
                            {/foreach}
                        </tbody>
                    </table>            
                </div>
            </div>
        </div>
    </section> 
</div>