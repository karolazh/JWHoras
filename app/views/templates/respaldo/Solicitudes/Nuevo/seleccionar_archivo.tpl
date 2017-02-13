<head>{include file="layout/css.tpl"}</head>

<section class="content">
    <div class="box box-success">
        <div class="box-body">
            <form class="form" role="form" enctype="multipart/form-data" method="post" action="{$smarty.const.BASE_URI}/Solicitudes/subirArchivo">
                <div class="form-group">
                  
                    <div class="">
                        <div class="input-group">
                               <div class="input-group-btn"></div>
                        </div>

                        <div class="box-body">
                            <div class="top-spaced table-responsive" id="contenedor-grilla-asignados">
                                {include file="Solicitudes/Grillas/asignados.tpl"}
                            </div>
                        </div>

                        <div class="input-group-btn">
                            <button type="button" class="btn btn-success btn-flat" onclick="this.form.submit();">Selecionar</button>
                        </div> 

                        <div class="input-group-btn">
                            <button type="button" class="btn btn-primary btn-flat" onclick="parent.xModal.close();">Cerrar</button>
                        </div>                      

                        <input  type="hidden" name="id_usuario"     id="id_usuario"     value="{$id_usuario}"></input>
                    </div>
                </div>
            </form>
        </div>
    </div>
    {if isset($mensaje)}
        {$mensaje}
    {/if}
    
</section>
