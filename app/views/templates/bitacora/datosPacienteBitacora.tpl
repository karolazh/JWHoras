<div class="form-group">
    <div class="clearfix col-md-6">
        <div class="col-md-4">
            <label class="control-label">RUT/RUN/Pasaporte : </label>
        </div>
        <div class="col-md-8">
            <input type="text" value="{$run}" class="form-control" readonly>
        </div>
    </div>

    <div class="clearfix col-md-6">
        <div class="col-md-4">
            <label class="control-label">Nombres : </label>
        </div>
        <div class="col-md-8">
            <input type="text" value="{$nombres}" class="form-control" readonly>
        </div>
    </div>
</div>

<div class="form-group">
    <div class="clearfix col-md-6">
        <div class="col-md-4">
            <label class="control-label">Fecha Nacimiento : </label>
        </div>
        <div class="col-md-8">
            <input type="text" value="{$fc_nacimiento}" class="form-control" readonly>
        </div>
    </div>

    <div class="clearfix col-md-6">
        <div class="col-md-4">
            <label class="control-label">Edad : </label>
        </div>
        <div class="col-md-8">
            <input type="text" value="{$edad}" class="form-control" readonly>
        </div>
    </div>
</div>

<div class="form-group">
    <div class="clearfix col-md-6">
        <div class="col-md-4">
            <label class="control-label">Sexo : </label>
        </div>
        <div class="col-md-8">
            <input type="text" value="{$gl_sexo}" class="form-control" readonly>
        </div>
    </div>

    <div class="clearfix col-md-6">
        <div class="col-md-4">
            <label class="control-label">Estado Caso : </label>
        </div>
        <div class="col-md-8">
            <input type="text" value="{$gl_nombre_estado_caso}" class="form-control" readonly>
        </div>
    </div>
</div>

<div class="form-group">
    <div class="clearfix col-md-6">
        <div class="col-md-4">
            <label class="control-label">Previsi&oacute;n : </label>
        </div>
        <div class="col-md-8">
            <input type="text" value="{$gl_nombre_prevision}" class="form-control" readonly>
        </div>
    </div>

    <div class="clearfix col-md-6">
        <div class="col-md-4">
            <label class="control-label">Grupo : </label>
        </div>
        <div class="col-md-8">
            <input type="text" value="{$gl_grupo_tipo}" class="form-control" readonly>
        </div>
    </div>
</div>

<div class="form-group">
    <div class="clearfix col-md-6">
        <div class="col-md-4">
            <label class="control-label">Regi&oacute;n : </label>
        </div>
        <div class="col-md-8">
            <input type="text" value="{$gl_nombre_region}" class="form-control" readonly>
        </div>
    </div>

    <div class="clearfix col-md-6">
        <div class="col-md-4">
            <label class="control-label">Comuna : </label>
        </div>
        <div class="col-md-8">
            <input type="text" value="{$gl_nombre_comuna}" class="form-control" readonly>
        </div>
    </div>
</div>

<div class="form-group">
    <div class="clearfix col-md-6">
        <div class="col-md-4">
            <label class="control-label">Direcci&oacute;n : </label>
        </div>
        <div class="col-md-8">
            <input type="text" value="{$gl_direccion}" class="form-control" readonly>
        </div>
    </div>

    <div class="clearfix col-md-6">
        <div class="col-md-4">
            <label class="control-label">E-mail : </label>
        </div>
        <div class="col-md-8">
            <input type="text" value="{$gl_email}" class="form-control" readonly>
        </div>
    </div>
</div>

<div class="form-group">
    <div class="clearfix col-md-6">
        <div class="col-md-4">
            <label class="control-label">Teléfono : </label>
        </div>
        <div class="col-md-8">
            <input type="text" value="{$gl_fono}" class="form-control" readonly>
        </div>
    </div>

    <div class="clearfix col-md-6">
        <div class="col-md-4">
            <label class="control-label">¿Teléfono Seguro? </label>
        </div>
        <div class="col-md-8">
            <input type="text" value="{if $bo_fono_seguro==1}SI{else}NO{/if}" class="form-control" readonly>
        </div>
    </div>
</div>

<div class="form-group">
    <div class="clearfix col-md-6">
        <div class="col-md-4">
            <label class="control-label">Celular : </label>
        </div>
        <div class="col-md-8">
            <input type="text" value="{$gl_celular}" class="form-control" readonly>
        </div>
    </div>

    <div class="clearfix col-md-6">
        <div class="col-md-4">
            <label class="control-label">Fecha Registro : </label>
        </div>
        <div class="col-md-8">
            <input type="text" value="{$fc_crea}" class="form-control" readonly>
        </div>
    </div>
</div>

<div class="form-group">
    <div class="clearfix col-md-6">
        <div class="col-md-4">
            <label class="control-label">Reconoce: </label>
        </div>
        <div class="col-md-8">
            <input type="text" value="{$bo_reconoce}" class="form-control" readonly>
        </div>
    </div>

    <div class="clearfix col-md-6">
        <div class="col-md-4">
            <label class="control-label">Acepta Programa : </label>
        </div>
        <div class="col-md-8">
            <input type="text" value="{$bo_acepta_programa}" class="form-control" readonly>
        </div>
    </div>
</div>