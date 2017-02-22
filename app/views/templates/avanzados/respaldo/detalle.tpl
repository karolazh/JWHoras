<head>
    {include file="layout/css.tpl"}
    <link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
</head>

<div class="box box-primary">
    <div class="box-header">
        <i class="fa fa-list fa-fw"></i>  Información del paciente
    </div>
    <div class="box-body">
        <div class="row"> 
            <div class="col-md-3">
                <div class="form-group">
                    <label for="NombresPaciente" class="control-label">Nombres : </label>&nbsp;&nbsp;{$detPac->pac_nombres}
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="ApellidosPaciente" class="control-label">Apellidos : </label>&nbsp;&nbsp;{$detPac->pac_apellidos}
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="fechaNacimiento" class="control-label">Fecha Nacimiento : </label>&nbsp;&nbsp;{$detPac->pac_fec_nac}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="prevision" class="control-label">Previsión : </label>&nbsp;&nbsp;{$detPac->pac_prevision}
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="convenio" class="control-label">Convenio : </label>&nbsp;&nbsp;{$detPac->pac_convenio}
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="direccion" class="control-label">Dirección : </label>&nbsp;&nbsp;{$detPac->pac_direccion}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="fono" class="control-label">fono : </label>&nbsp;&nbsp;{$detPac->pac_fono}
                </div>
            </div>  
            <div class="col-md-3">
                <div class="form-group">
                    <label for="email" class="control-label">email : </label>&nbsp;&nbsp;{$detPac->pac_email}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="celular" class="control-label">celular : </label>&nbsp;&nbsp;{$detPac->pac_celular}
                </div>
            </div>
        </div>           
    </div>

    <hr>
    <div class="box box-primary">
        <div class="box-header">
            <i class="fa fa-list fa-fw"></i> Registros del paciente           
        </div>
        <div class="box-body">
            <div id="div_tabla" class="table-responsive small"> 
                <table class="table table-hover table-striped table-bordered  dataTable no-footer">
                    <thead>
                    <th>Fecha Ingreso</th>
                    <th>Hora Ingreso</th>
                    <th>Motivo Consulta</th>
                    <th>Historia Enfermedad</th>
                    <th>Diagnostico</th>
                    <th>Indicación Médica</th>
                    </thead>
                    <tbody>
                        {foreach $detReg as $item}
                            <tr>
                                <td align="center">{$item->reg_fec_ingreso}</td>                                                                
                                <td align="center">{$item->reg_hora_ingreso}</td>
                                <td align="center">{$item->reg_motivo_consulta}</td>
                                <td align="center">{$item->reg_historia_enfermedad}</td>
                                <td align="center">{$item->reg_diagnostico}</td>
                                <td align="center">{$item->reg_indicacion_medica}</td>
                            </tr>
                        {/foreach}
                    </tbody>
                </table>            
            </div>
        </div>
    </div>

    <!--agregar un comentario desde la bitacora-->
    <section class="content-header" >
        <h3 class="panel-title"><span class="fa fa-plus" onclick="habilitar()"> Agregar comentario</span></h3>
        <form id="form" name="form-inline" enctype="application/x-www-form-urlencoded" action="" method="post">
            <input value="{$p->id_ticket}" id="ticket" name="ticket" type="hidden">
            <div class="box box-primary" id="seccionComentario" style="display:none">
                <div class="box-header">
                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputPassword1" class="control-label">Nuevo Comentario</label>
                                <textarea class="form-control" name="nuevo_comentario" id="nuevo_comentario" style="resize:none" rows="10"></textarea> 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-2">
                            <div id="div_tabla" class="table-responsive small"> 
                                <button type="button" class="form-control btn btn-primary" onclick="Comentario.guardarComentario(this.form, this)">Guardar comentario</button>     
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>

    <hr>
    <div id="div_grilla_comentario">
        {include file='avanzados/grillaComentario.tpl'}
    </div>


    <hr>

    <!--agregar un adjunto (! version) desde la bitacora-->
    <section class="content-header" >
        <h3 class="panel-title"><span class="fa fa-plus" onclick="habilitarAdjunto()"> Agregar adjunto</span></h3>
        <form id="form" role="form" name="form-inline" enctype="multipart/form-data" action="{$smarty.const.BASE_URI}/Solicitudes/guardarNuevoAdjunto" method="post">
            <input value="{$p->id_ticket}" id="ticket" name="ticket" type="hidden">
            <div class="box box-primary" id="seccionAdjunto" style="display:none">
                <div class="top-spaced">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="box-header">
                                    Adjuntar nuevo archivo
                                    <input type="file" name="archivo" id="archivo" class="form-control"/>
                                    <input type="hidden" value="{$p->id_ticket}" name="id_ticket" id="id_ticket">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="box-header">
                                    Comentario (opcional)
                                    <textarea style="resize:none" class="form-control" id="comentario_adjunto" name="comentario_adjunto"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="box-header">
                                <button class="btn btn-primary form-control" type="button" onclick="this.form.submit()">Guardar adjunto</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
    <hr>
    <div id="div_grilla_adjuntos">
        {include file='avanzados/grillaAdjuntos.tpl'}
    </div>
</div>
<script type="text/javascript">
    function habilitar() {
        $('#seccionComentario').toggle()
    }

    function habilitarAdjunto() {
        $('#seccionAdjunto').toggle()
    }
</script>