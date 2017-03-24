<label class="control-label required col-sm-3">Colesterol total (mg/dl)</label>
<div class="col-sm-2">
    <input type="text" name="gl_colesterol" id="gl_colesterol" maxlength="4" 
           onKeyPress="return soloNumeros(event)" 
           value="{$gl_colesterol}" placeholder="" class="form-control" 
           {if $accion == "1"}readonly{/if}/>
</div>