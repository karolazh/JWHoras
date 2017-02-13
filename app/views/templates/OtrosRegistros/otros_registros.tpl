
<section class="content-header">
    <h1><i class="fa fa-pencil"></i><span>&nbsp;Otros Registros</span></h1>
    <div class="col-md-12 text-right">
        <button type="button" id="nuevo_registro" onclick="location.href = '{$base_url}/OtrosRegistros/nuevo'"
                class="btn btn-sucess">
            <i class="fa fa-file"></i><span>&nbsp;&nbsp;Registrar Nuevo</span>
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
                        <div class="box-header">
                            <h3 class="box-title">Listado de Registros</h3>
                        </div>
                        <br>

                        <div class="form-group ">
                            <div class="form-group col-md-12">
                                <div class="form-group clearfix col-md-6">
                                    <label for="microchip" class="control-label required">Microchip de mascota</label>
                                    <input type="text" name="microchip" id="microchip" value=""
                                           placeholder="Buscar" class="form-control"/>
                                    <span class="help-block hidden"></span>
                                </div>

                                <div class="form-group clearfix col-md-6">
                                    <label for="buscar" class="control-label required">&nbsp;</label>
                                    <div class="col-xs-12">
                                    <button type="button" id="Buscar" class="btn btn-success">
                                        <i class="fa fa-search"></i>  Buscar
                                    </button>
                                    </div>
                                </div>
                            </div>
                            <br/>
                            <div class="form-group ">
                                <table id="tablaPrincipal" class="table table-hover table-striped table-bordered  table-middle dataTable no-footer">
                                    <thead>
                                        <tr role="row">
                                            <th align="center">Tipo de Registro</th>
                                            <th align="center">Observaciones</th>

                                        </tr>
                                    </thead>

                                    <tbody>
                                        {foreach $arrResultado as $item}
                                            <tr>
                                                <td align="center">?</td>
                                                <td align="center">?</td>
                                            </tr>
                                        {/foreach}
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