<?php

require_once(APP_PATH . "libs/Helpers/View/Grid.php");

/**
 * 
 * @param array $params
 * @param Smarty $smarty
 * @return string html
 */
function smarty_function_grilla($params, &$smarty) {
    
    $grid = New View_Grid("lista_solicitudes");
    $grid->setModel("DAOMantenedorArchivos");
    $grid->addHelperPath(__DIR__, "");
    $grid->setQuery("queryBusquedaTicket", array("id_carpeta_archivo" => "id_carpeta_archivo",
                                           "nombre" => "nombre",
                                           "gl_comentario" => "gl_comentario",
                                           "fc_fecha_creacion" => "fc_fecha_creacion"), 
                                   array());

    //coloca los nombres de la cabecera de la tabla y permite ordenar los registros
    $grid->setColumns(array(
            array("column_name" => "ID",
                "column_table"  => array("id_carpeta_archivo"),
                "column_type"   => "method",
                "sortable"      => array("active"         => true,
                                         "sortable_field" => "id_carpeta_archivo"),
                "width" => "5%"),
            array("column_name" => "Nombre",
                "column_table"  => array("nombre"),
                "column_type"   => "method",
                "sortable"      => array("active"         => true,
                                         "sortable_field" => "nombre"),
                "width" => "20%"),
            array("column_name" => "Comentario",
                "column_table" => array("gl_comentario"),
                "column_type" => "method",
                "sortable" => array("active" => true,
                                    "sortable_field" => "gl_comentario"),
                "width" => "20%"),
             array("column_name" => "Fecha Creacion",
                "column_table" => array("fc_fecha_creacion"),
                "column_type" => "method",
                "sortable" => array("active" => true,
                                    "sortable_field" => "fc_fecha_creacion"),
                "width" => "20%"),
            array("column_name" => "",
                "column_table" => array("id_carpeta_archivo"),
                "column_type" => "html",
                "column_html" => "<button data-toggle=\"tooltip\" type=\"button\" onclick=\"location.href='".BASE_URI."/MantenedorSolicitudes/editar/%';\" class=\"btn btn-sm btn-flat btn-success\" title=\"Ver Detalle\">"
                                ."<i class=\"fa fa-edit\"></i> Actualizar"
                                ."</button>",
                "column_align" => "center",
                "sortable" => false,
                "width" => "5%")     
        ));
    
    return $grid->getGrid();
}