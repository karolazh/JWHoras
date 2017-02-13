
<section class="content-header">
    <h1><i class="fa fa-pencil"></i><span>&nbsp;Muestras Registradas</span></h1>
    <div class="col-md-12 text-right">
        <button type="button" id="nuevo_registro" onclick="location.href = '{$base_url}/OtrosRegistros/nuevo'"
                class="btn btn-defaultr">
            <i class="fa fa-file"></i><span>&nbsp;&nbsp;Registrar muestra de vigilancia</span>
        </button>
    </div>
    <br/><br/>
</section>

<section class="content">
    <div class="row">

        <form  id="form" name="form" enctype="application/x-www-form-urlencoded" action="" method="post">

            <div class="col-xs-12 col-md-12">
                <div class="box box-primary">

                    <div class="box-body">
                        <div class="form-group ">

                            <div class="form-group ">
                                <table id="tablaPrincipal" class="table table-hover table-striped table-bordered  table-middle dataTable no-footer">
                                    <thead>
                                        <tr role="row">
                                            <th align="center">Especie</th>
                                            <th align="center">Numero de muestra</th>
                                            <th align="center">Region de la muestra</th>
                                            <th align="center" with="1px">Acciones</th>

                                        </tr>
                                    </thead>

                                    <tbody>
                                        
                                            <tr>
                                                <td align="center">?</td>
                                                <td align="center">?</td>
                                                <td align="center">?</td>
                                                <td align="center">
                                                    <button type="button" class="btn btn-sm btn-success btn-flat" 
                                                            onClick="location.href = ''" 
                                                            data-toggle="tooltip" title="Descargar Acta">
                                                        <i class="fa fa-download"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                    </tbody>
                                </table>
                                <br/>
                            </div>


                        </div>

                    </div>
                </div>
            </div>
        </form>

    </div>
</section>