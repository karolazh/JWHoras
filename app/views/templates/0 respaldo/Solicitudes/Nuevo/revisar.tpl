<div class="box box-success">
    <div class="box-body">
        <form role="form" class="form-horizontal">

                <div class="row">
                    <div class="col-md-6 top-spaced">
                        <div class="margin-bottom-10"></div>

                        <div class="form-group">
                            <label for="exampleInputEmail1" class="col-lg-4 control-label">Proyecto</label>
                            <div class="col-lg-8">
                                <p class="form-control-static well well-sm">{$solicitud->nombre_proyecto}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1" class="col-lg-4 control-label">Asunto</label>
                            <div class="col-lg-8">
                                <p class="form-control-static  well well-sm">{$solicitud->asunto}</p>

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1" class="col-lg-4 control-label">Comentario</label>
                            <div class="col-lg-8">
                                <p class="form-control-static  well well-sm">{$solicitud->comentario}
                                </p>

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1" class="col-lg-4 control-label">Estado</label>
                            <div class="col-lg-8">
                                <p class="form-control-static  well well-sm">{$solicitud->desc_estado}</p>

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1" class="col-lg-4 control-label">Prioridad</label>
                            <div class="col-lg-8">
                                <p class="form-control-static  well well-sm">
                                    {$solicitud->desc_prioridad}</p>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 top-spaced">
                        <div class="margin-bottom-10"></div>

                        <div class="form-group">
                            <label for="exampleInputEmail1" class="col-lg-4 control-label">Fecha Creación</label>
                            <div class="col-lg-7">
                                <p class="form-control-static well well-sm">
                                    {$solicitud->fc_fecha_creacion}
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1" class="col-lg-4 control-label">Fecha Límite</label>
                            <div class="col-lg-7">
                                <p class="form-control-static well well-sm">{$solicitud->fecha_entrega}
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1" class="col-lg-4 control-label">Días Restantes</label>
                            <div class="col-lg-7">
                                <p class="form-control-static well well-sm">{Fechas::diffDiasTickets({$fechaHoy},{$solicitud->fecha_entrega})}</p>

                            </div>
                        </div>
                    </div>


                </div>

                <div class="row top-spaced margin-bottom-10">
                    <div class="col-md-12 col-xs-12 top-spaced">

                        <div class="margin-bottom-10"></div>

                  
                    <div class="margin-bottom-10"></div>
                        <div class="text-center">
                            {if $solicitud->id_estado == 2 || $solicitud->id_estado == 1}                          
                                    <button type="button" class="btn btn-flat btn-success" onclick="parent.Solicitudes.iniciar({$solicitud->id_solicitud},this);">
                                        Iniciar
                                    </button>
                                    {else}
                                    <button type="button" class="btn btn-flat btn-success" onclick="parent.Solicitudes.finalizar({$solicitud->id_solicitud},this);">
                                        Finalizar Ticket
                                    </button>                           
                            {/if}
                         </div>
    </div>
</div>
