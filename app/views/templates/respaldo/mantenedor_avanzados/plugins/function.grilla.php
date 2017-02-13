<?php

require_once(APP_PATH . "libs/Helpers/View/Grid.php");

/**
 * 
 * @param array $params
 * @param Smarty $smarty
 * @return string html
 */
function smarty_function_grilla($params, &$smarty) {
    $grid = New View_Grid("lista_perfiles");
    $grid->setModel("DAOPerfil");
    $grid->addHelperPath(__DIR__, "");
    $grid->setQuery("queryBusquedaPerfil", array("id" => "id",
                                           "nombre" => "nombre",
                                           "gl_descripcion"=>"gl_descripcion"), 
                                   array());
    //coloca los nombres de la cabecera de la tabla y permite ordenar los registros
    $grid->setColumns(array(
            array("column_name" => "Id",
                "column_table" => array("id"),
                "column_type" => "method",
                "sortable" => array("active" => true,
                                    "sortable_field" => "p.id"),
                "width" => "5%"),
            array("column_name" => "Perfil",
                "column_table" => array("nombre"),
                "column_type" => "method",
                "sortable" => array("active" => true,
                                    "sortable_field" => "p.nombre"),
                "width" => "20%"),
           array("column_name" => "Descripción",
                "column_table" => array("gl_descripcion"),
                "column_type" => "method",
                "sortable" => array("active" => true,
                                    "sortable_field" => "p.gl_descripcion"),
                "width" => "20%"),
                       
            array("column_name" => "",
                "column_table" => array("id"),
                "column_type" => "html",
                "column_html" => "<button data-toggle=\"tooltip\" type=\"button\" onclick=\"location.href='".BASE_URI."/Perfiles/editar/%';\" class=\"btn btn-sm btn-flat btn-success\" title=\"Ver Detalle\">"
                                ."<i class=\"fa fa-edit\"></i> Editar"
                                ."</button>",
                "column_align" => "center",
                "sortable" => false,
                "width" => "5%")
        ));
    
    return $grid->getGrid();
}