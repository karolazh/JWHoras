<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<section class="content-header">
    <h1>Documentos
        <small>Histórico</small>
    </h1>
</section>

<section class="content">
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Documentos general</h3>
            <button class="btn btn-xs btn-link pull-right"
                    onClick="location.href='{$base_url}/MantenedorUsuarios/index'"
                    style="float: right">
                <i class="fa fa-backward"></i> Ir Atrás
            </button>
        </div>
        <div class="box-body">
            <form class="form-inline" role="form">
                <div class="form-group">
                    <label class="control-label">Número días</label>
                    <input type="number" min="0" class="form-control" id="numero_dias" name="numero_dias"/>
                    <select class="form-control" name="condicion" id="condicion">
                        <option value="1">Iguales</option>
                        <option value="2">Mayores</option>
                        <option value="3">Ambos</option>
                    </select>
                    <button class="btn btn-success btn-flat" type="button"
                            onclick="Documento.filtrarDocumentos(this.form)">Filtrar No Visados
                    </button>

                </div>
            </form>

            <div class="top-spaced table-responsive" id="contenedor-grilla-asignados">
                {include file="Documentos/Grillas/grilla_todos.tpl"}
            </div>
        </div>
    </div>
</section>

