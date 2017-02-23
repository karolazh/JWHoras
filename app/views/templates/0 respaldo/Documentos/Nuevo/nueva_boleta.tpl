<link href="{$static}template/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css"/>

<section class="content-header">
    <h1>Nuevo Registro de boleta
        <small>Ingresar nueva boleta</small>
    </h1>
</section>

<section class="content">
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Formulario de Registro</h3>
        </div>
        <div class="box-body">
            <form role="form" class="form-horizontal">
                <div class="row">
                    <div class="col-md-6 top-spaced">
                        <div class="margin-bottom-10"></div>
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="col-lg-4 control-label">Subsecretaria</label>
                            <div class="col-lg-8">
                                <select class="form-control" name="subsecretaria_boleta" id="subsecretaria_boleta"
                                        onchange="Documento.cargarCentrosResponsabilidad(this.value,'centro_responsabilidad');">
                                    <option value="0">-- Seleccione --</option>
                                    {foreach from=$subsecretarias item=item}
                                        <option value="{$item->id_subsecretaria}">{$item->nombre_subsecretaria}</option>
                                    {/foreach}
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1" class="col-lg-4 control-label">Tipo boleta</label>
                            <div class="col-lg-8">


                                <select class="form-control" id="tipo_boleta" name="tipo_boleta">
                                    <option value="0">-- Seleccione --</option>
                                    {foreach from=$tipo_boleta item=item}
                                        <option value="{$item->id_tipo}">{$item->nombre}</option>
                                    {/foreach}
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1" class="col-lg-4 control-label">Nro de la boleta</label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control numbers" id="numero_boleta"
                                       name="numero_boleta" placeholder="">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 top-spaced">
                        <div class="margin-bottom-10"></div>

                        <div class="form-group">
                            <label for="exampleInputEmail1" class="col-lg-4 control-label">Fecha ingreso a Oficina de
                                partes</label>
                            <div class="col-md-3 col-xs-12">
                                <div class="input-group">
                                    <input type="text" class="form-control datepicker" readonly
                                           style="border-radius: 0" id="fecha_oficina_boleta"
                                           name="fecha_oficina_boleta"
                                           placeholder="">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                       
                        <div class="form-group">
                            <label for="exampleInputPassword1" class="col-lg-4 control-label">RUT emisor</label>
                            <div class="col-lg-7">
                                <input type="text" class="form-control typeahead" id="rut_emisor" name="rut_emisor_boleta"
                                       placeholder="Escriba rut">

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1" class="col-lg-4 control-label">Nombre Emisor</label>
                            <div class="col-lg-7">
                                <input type="text" class="form-control" id="nombre_emisor" name="nombre_emisor_boleta"
                                       placeholder="" readonly="true">
                            </div>
                        </div>
                       
                    </div>
                </div>

                <div class="margin-bottom-10"></div>
                <div id="g">
                    <button id="guardarBoleta" type="button" class="btn btn-success pull-right btn-flat"
                            onclick="Documento.guardarNuevaBoleta(this.form,this); habilitar() ">
                        Guardar boleta
                    </button>
                </div>
                
            </form>
            <div id="h" style="display:none">
                <button id="guardarBoleta" type="button" class="btn btn-success pull-right btn-flat"
                            onclick="xModal.open('{$smarty.const.BASE_URI}/Documento/detalleBoleta','Adjuntar Archivos',50,'adjuntar',true,280);">
                        Agregar Detalle
                </button>
            </div>
        </div>
    </div>
         
</section>


<section class="content" id="tabla-detalle" style="display:none">
    <div class="box box-success">
        <div class="box-body">
            <form class="form-horizontal" role="form">
                <div class="form-group">
                    <div class="row">
                    <div class="col-md-12">
                        <div class="input-group">
                             <table class="table table-hover table-striped table-bordered no-footer" width="100%">
                               <thead>
                                   <th>Código producto</th>
                                   <th>Glosa</th>
                                   <th>Cantidad</th>
                                   <th>Precio</th>
                                   <th>TOTAL</th>
                               </thead>
                               <tbody>
                                   <td><input type="text" class="form-control numbers" id="codigo" name="codigo" placeholder=""></td>
                                   <td><textarea class="form-control " id="glosa" name="glosa" placeholder=""></textarea></td>
                                   <td><input type="text" class="form-control numbers" id="cantidad" name="cantidad" placeholder=""></td>
                                   <td><input type="text" class="form-control numbers" id="precio" name="precio" placeholder="" onblur="sumar()"></td>
                                   <td><input readonly="true" type="text" class="form-control numbers" id="total" name="total" placeholder=""></td>
                               </tbody>
                            </table>
                           
                        </div>
                    </div>
                        <div class="col-md-6">

                            <!--<button id="guardarBoleta" type="button" class="btn btn-success pull-right btn-flat"  onclick="addLine()">Agregar nuevo item 
                            </button> -->

                            <button id="guardarBoleta" type="button" class="btn btn-success pull-right btn-flat" onclick="Documento.guardarDetalle(this.form,this)">Guardar detalle
                            </button> 
                            
                            
                        </div>
                   </div>
                </div>

            </form>
        </div>
    </div>
   
</section>

<script type="text/javascript">
    function sumar(){
         var precio=document.getElementById('precio').value
         var cantidad=document.getElementById('cantidad').value
         var totaliozar=precio*cantidad
         document.getElementById('total').value=totaliozar
    }
    
    function addLine() {
         var tbl = document.getElementById('tabla');
         var lastRow = tbl.rows.length;
         var row = tbl.insertRow(lastRow);

         var productNoCell = row.insertCell(0);
         var qtyCell = row.insertCell(0);
         var qtyCell2 = row.insertCell(0);
         var qtyCell3 = row.insertCell(0);
         var qtyCell4 = row.insertCell(0);


         productNoCell.innerHTML = '<input readonly="true" type="text" class="form-control numbers " id="total" name="total" placeholder="">';
         qtyCell.innerHTML = '<input type="text" class="form-control numbers " id="precio" name="precio"  placeholder="" onblur="sumar()">';
         qtyCell2.innerHTML = '<input type="text" class="form-control numbers " id="cantidad" name="cantidad" placeholder="">';
         qtyCell3.innerHTML = '<textarea class="form-control  " id="glosa" name="glosa" placeholder="">';
         qtyCell4.innerHTML = '<input type="text" class="form-control numbers inventada " id="codigo" name="codigo" placeholder="">';
         return false;
    }

    function asignar(){
        var rutaAsignada='';
        $(".inventada").each(function(){
            if(this.value>''){
            //guiasSeleccion.push(this.value);  
            rutaAsignada+=this.value+',';
            }

        })
       alert(rutaAsignada)  
    }

    function habilitar(){
        document.getElementById("tabla-detalle").style.display = "block";
        //document.getElementById("h").style.display = "block";
    }
</script>



   