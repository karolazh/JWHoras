<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<section class="content-header">
    <h1>Mantenedor de Comunas</h1>
        <ol class="breadcrumb">
            <li><a href="{$base_url}/Administracion">
            <i class="fa fa-folder-open"></i>Mantenedor de Comunas</a></li>
            <li class="active">Nueva Comuna</>
        </ol>
</section>

<section class="content">
    <div class="box box-primary">
        <div class="box-body">

            <form role="form" class="form-horizontal">
               <div class="col-md-2">
                   <div class="form-group">
                      <label class="control-label required">Region (*)</label>                    
                      <select name="region" id="region" class="form-control" 
                              onchange="Regiones.cargarComunasPorRegion(this.value,'provincias')">
                           <option value="0">-- Seleccione --</option>
                                  {foreach from=$Regiones item=it}
                           <option value="{$it->id_region}">{$it->nombre_region}</option>
                                  {/foreach}                
                      </select>
                  </div>
               </div>

               <div class="col-md-2 col-md-offset-1">
                   <div class="form-group">
                       <label class="control-label required">Provincia (*)</label>
                           <select class="form-control" id="provincias" name="provincias" 
                                   onchange="Regiones.cargarOficinaPorProvincia(this.value,'oficina')">
                               <option value="0">-- Seleccione --</option>
                           </select>
                  </div>
               </div>

               <div class="col-md-6 ">
                   <label  class="control-label required">Nombre (*)</label>
                       <div class="form-group">                        
                           <div class="col-md-12">
                                   <input class="form-control" 
                                          name="nombre" id="nombre" placeholder="Nombre"></input>
                           </div>
                       </div>

                   <button type="button" class="btn btn-success btn-flat" 
                       onclick="">
                   Guardar
                   </button>
                   <br><br><br>
               </div>
           </form>
        </div>
    </div>    
</section>