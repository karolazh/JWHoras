<section class="content-header">
    <h1>Inicio</h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12 col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Noticias</h3>
                </div>
                <div class="box-body">
                    <h1>{$titulo}</h1>
                    <br/>
                    <h3>{$resumen}</h3>
                    <br/>
                    {$cuerpo}
                    <br/><br/>
                    <div class="col-md-12 text-right">
                        <button type="button" id="aceptar" onclick="location.href='{$base_url}/Home/dashboard'"
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