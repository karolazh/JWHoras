<head>{include file="layout/css.tpl"}</head>
<link href="{$static}template/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
<section class="content">
    <div class="box box-success">
        <div class="box-body">
            <form class="form-horizontal" role="form">
                <div class="form-group">
                    <div class="">
                        <div class="input-group">
                             <table class="table table-hover table-striped table-bordered no-footer">
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
                            <!--<div class="input-group-btn">
                                <button type="button" class="btn btn-success btn-flat" onclick="this.form.submit();">
                                    Adjuntar
                                </button>
                            </div>-->
                            <!--<div class="input-group-btn">
                                <button type="button" class="btn btn-primary btn-flat" onclick="parent.xModal.close();">
                                    Cerrar
                                </button>

                            </div>-->
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

    function guardar(){
        var codigo=document.getElementById('codigo').value
        var glosa=document.getElementById('glosa').value
        var cantidad=document.getElementById('cantidad').value
        var precio=document.getElementById('precio').value
        var total=document.getElementById('total').value
        //alert(codigo)

        var param={
            'codigo':codigo,
            'glosa':glosa,
            'cantidad':cantidad,
            'precio':precio,
            'total':total,
        }
        $.ajax({
            url:'{$base_url}/documento/guardarDetalleBoleta',
            type:'POST',
            data:param,
            beforeSend:function(){},
            success:function(obj){
                alert("suceso")

            }
        })
    }
</script>
