<link href="{$static}template/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css"/>
<form id="form" name="form-inline" enctype="application/x-www-form-urlencoded" action="" method="post">
    <input type="hidden" name="id_solicitud" id="id_solicitud" value="{$solicitud->id_solicitud}"/>
    <div class="col-md-6 text-left">
        <div class="form-group clearfix">
            <label for="rut" class="control-label required">Proyecto (*)</label>
             <input type="text" name="id_proyecto" id="id_proyecto" value="{$solicitud->nombre_proyecto}" readonly class="form-control"/>
            <span class="help-block hidden"></span>
        </div>
    </div>
    <div class="col-md-6 text-left">
        <div class="form-group clearfix">
            <label  class="control-label required">Asunto (*)</label>
            <input type="text" name="nombre" id="nombre" value="{$solicitud->asunto}" class="form-control"/>
        </div>
    </div>
    <div class="col-md-6 text-left">
        <div class="form-group clearfix">
            <label for="rut" class="control-label required">Responsable (*)</label>
             <select class="form-control" id="id_responsable" name="id_responsable">
                {foreach from=$trabajadores item=item}
                    <option value="{$item->id}" {if $item->id == $solicitud->id_usuario} selected {/if}>{$item->nombres} {$item->apellidos}</option>
                {/foreach}
            </select>

            <span class="help-block hidden"></span>
        </div>
    </div>
    <div class="col-md-6 text-left">
        <div class="form-group clearfix">
            <label for="email" class="control-label required">Estado(*)</label>
            <input type="text" name="tipo_estado" id="tipo_estado" value="{$solicitud->desc_estado}" class="form-control" readonly/>
            <input type="hidden" name="estado" id="estado" value="{$solicitud->id_estado}" class="form-control" readonly/>
            <span class="help-block hidden"></span>
        </div>
    </div>
    <div class="col-md-6 text-left">
        <div class="form-group clearfix">
            <label  class="control-label required">Fecha Creación (*)</label>
            <input type="text" name="fecha_creacion" id="fecha_creacion" value="{$fc_fecha_creacion}" readonly class="form-control"/>
            <span class="help-block hidden"></span>
        </div>
    </div>
    <div class="col-md-6 text-left">
        <div class="form-group clearfix">
            <label for="apellido" class="control-label required">Fecha Entrega (*)</label>
            <div class="input-group">
            <input type="text" class="form-control datepicker" readonly
                                           style="border-radius: 0" id="fecha_entrega"
                                           name="fecha_entrega"
                                           placeholder=""
                                           value="{$fc_fecha_entrega}">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            </div>
            <span class="help-block hidden"></span>
        </div>
    </div>
    
    <div class="col-md-6 text-left">
        <div class="form-group clearfix">
        <label for="rut" class="control-label required">Prioridad (*)</label>
            <select class="form-control" id="prioridad" name="prioridad">
                {foreach from=$prioridad item=item}
                    <option value="{$item->id}" {if $item->id == $solicitud->id} selected {/if}>{$item->gl_descripcion}</option>
                {/foreach}
            </select>
        </div>
    </div>
    <div class="clearfix"></div>
    <!-- <div class="col-md-6 text-left">
        <div class="form-group clearfix">
            <label for="email" class="control-label required">Región</label>
            {selectRegion nombre="region" class="form-control" default=$region}
            <span class="help-block hidden"></span>
        </div>
    </div> -->

    <!-- <div class="col-md-6 text-left">
        <div class="form-group clearfix">
            <label for="oficinas" class="control-label required">Oficinas</label>
            {selectOficina nombre="oficinas" class="form-control" default=$oficinas}
            <span class="help-block hidden"></span>
        </div>
    </div> -->
    <div class="clearfix"></div>
    <!-- <div class="col-md-6 text-left hide">
        <div class="form-group clearfix">
            <label for="email" class="control-label required">Sistemas</label>
            {selectSistemas nombre="sistemas" class="form-control" default=$sistemas}
            <span class="help-block hidden"></span>
        </div>
    </div> -->

    <div class="clearfix"></div>

    <div id="form-error" class="alert alert-danger hidden">
        <i class="fa fa-warning fa-2x"></i> &nbsp; <strong> ¡Error! </strong> Existen problemas en los datos, revise los
        campos en rojo.
    </div>

    <div class="col-md-12 text-right">
        <button type="button" id="guardar" class="btn btn-success btn-sm btn-flat">
            <i class="fa fa-save"></i> Guardar
        </button>
        <button type="button" id="cancelar" onclick="location.href='{$base_url}/MantenedorSolicitudes/index'"
                class="btn btn-default btn-sm btn-flat">
            <i class="fa fa-remove"></i> Cancelar
        </button>
    </div>

</form>
