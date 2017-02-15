<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<section class="content-header">
    <h1><i class="fa fa-plus"></i> Ingresar DAU</h1>
        <ol class="breadcrumb">
            <li><a href="{$base_url}/Administracion/noticias">
            <i class="fa fa-folder-open"></i> DAU</a></li>
            <li class="active"> Ingresar DAU</li>
        </ol>
</section>

<section class="content">
    <div class="box box-primary">
        <div class="box-body">
            
            <form id="form">
                <div class="form-group">
                    <div class="form-group col-md-12">
                        <div class="form-group col-md-3">
                            <label for="region" class="control-label required">Rut Paciente (*)</label>
                            <input type="text" name="rut" id="rut" value="" 
                                   placeholder="Rut paciente" class="form-control"/>
                            <span class="help-block hidden"></span>
                        </div>

                        <div class="form-group col-md-1">
                            <label for="busqueda" class="control-label required">&nbsp;</label>
                            <button type="button" id="buscar" class="btn btn-info btn-sm form-control">
                                    <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div class="form-group col-md-12">
                        <div class="form-group clearfix col-md-6">
                            <label for="agno" class="control-label required">Nombres (*)</label>
                            <input type="text" name="agno" id="fecha" value=""
                                   placeholder="Nombres" class="form-control"/>
                            <span class="help-block hidden"></span>
                        </div>

                        <div class="form-group clearfix col-md-6">
                            <label for="semestre" class="control-label required">Apellidos (*)</label>
                            <input type="text" name="Semestre" id="rut" value="" 
                                   placeholder="Apellidos" class="form-control"/>
                            <span class="help-block hidden"></span>
                        </div>
                    </div>
                    
                    <div class="form-group col-md-12">
                        <div class="form-group clearfix col-md-6">
                            <label for="agno" class="control-label required">Fecha Nacimiento (*)</label>
                            <input type="text" name="agno" id="fecha" value=""
                                   placeholder="Nombres" class="form-control"/>
                            <span class="help-block hidden"></span>
                        </div>

                        <div class="form-group clearfix col-md-3">
                            <label for="semestre" class="control-label required">Edad (*)</label>
                            <input type="text" name="Semestre" id="rut" value="" 
                                   placeholder="Apellidos" class="form-control"/>
                            <span class="help-block hidden"></span>
                        </div>
                        
                        <div class="form-group clearfix col-md-3">
                            <label for="semestre" class="control-label required">G&eacute;nero (*)</label>
                            <input type="text" name="Semestre" id="rut" value="" 
                                   placeholder="Apellidos" class="form-control"/>
                            <span class="help-block hidden"></span>
                        </div>
                    </div>
                </div>

            </form>

        </div>
    </div>    
</section>