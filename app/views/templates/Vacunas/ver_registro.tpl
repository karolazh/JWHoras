<section class="content-header">
    <h1><i class="fa fa-plus"></i><span>&nbsp;Vacunas</span></h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12 col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Detalle de Vacuna Antirr&aacute;bica</h3>
                </div>
                <div class="box-body">
                    <br/>
                    <label class="control-label required">Instituci&oacute;n</label><br>
                    {$institucion}
                    <br/><br/>
                    <label class="control-label required">Responsable</label><br>
                    {$responsable}
                    <br/><br/>
                    <label class="control-label required">Especie</label><br>
                    {$especie}
                    <br/><br/>
                    <label class="control-label required">Cantidad de vacunas</label><br>
                    {$cantidad}
                    <br/><br/>
                    <label class="control-label required">Periodo</label><br>
                    {$periodo}
                    <br/><br/>
                    <label class="control-label required">Año</label><br>
                    {$agno}
                    <br/><br/>
                    <label class="control-label required">Comuna</label><br>
                    {$comuna}
                    <br/><br/>
                    <label class="control-label required">Provincia</label><br>
                    {$provincia}
                    <br/><br/>
                    <label class="control-label required">Regi&oacute;n</label><br>
                    {$region}
                    <br/><br/>
                    <div class="col-md-12 text-right">
                        <button type="button" id="aceptar" onclick="location.href='{$base_url}/Vacunas/buscar'"
                                class="btn btn-success btn-sm">
                            <i class="fa fa-check"></i>&nbsp;&nbsp;Aceptar
                        </button>
                        <br/><br/>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</section>