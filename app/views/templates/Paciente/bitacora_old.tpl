<head>
    <link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
</head>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h5>  Información del paciente </h5>
    </div>
    <div class="panel-body">
        {if $extranjero}
            <div class="form-group">
                <div class="clearfix col-md-6">
                    <div class="col-md-4">
                        <label class="control-label required">Pasaporte Paciente :</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text"  value="{$run_pass}" class="form-control" readonly>
                    </div>
                </div>
                <div class="clearfix col-md-6">
                    <div class="col-md-6">
                        <a href="">Descargar documento identificación extranjero</a>
                    </div>
                </div>
            </div>
        {else}
            <div class="form-group">
                <div class="clearfix col-md-6">
                    <div class="col-md-4">
                        <label class="control-label required">Rut Paciente : </label>
                    </div>
                    <div class="col-md-8">
                        <input type="text"  value="{$rut}" class="form-control" readonly>
                    </div>
                </div>
                <div class="clearfix col-md-6">
                    <div class="col-md-4">
                        <label class="control-label required">Previsión : </label>
                    </div>
                    <div class="col-md-8">
                        <input type="text"  value="{$prevision}" class="form-control" readonly>
                    </div>
                </div>
            </div>
        {/if}
        <div class="form-group">
            <div class="clearfix col-md-6">
                <div class="col-md-4">
                    <label class="control-label required">Nombres : </label>
                </div>
                <div class="col-md-8">
                    <input type="text"  value="{$nombres}" class="form-control" readonly>
                </div>
            </div>
            <div class="clearfix col-md-6">
                <div class="col-md-4">
                    <label class="control-label required">Apellidos : </label>
                </div>
                <div class="col-md-8">
                    <input type="text"  value="{$apellidos}" class="form-control" readonly>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="clearfix col-md-6">
                <div class="col-md-4">
                    <label class="control-label required">Fecha Nacimiento : </label>
                </div>
                <div class="col-md-8">
                    <input type="text"  value="{$fecha_nacimiento}" class="form-control" readonly>
                </div>
            </div>
            <div class="clearfix col-md-6">
                <div class="col-md-4">
                    <label class="control-label required">Edad : </label>
                </div>
                <div class="col-md-8">
                    <input type="text"  value="{$edad}" class="form-control" readonly>
                </div>
            </div>
        </div>
    </div>  
    <div class="panel-footer"></div>
</div>