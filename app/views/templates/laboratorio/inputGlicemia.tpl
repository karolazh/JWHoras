{if $fc_resultado or $perfil != "3"}
<label class="control-label required col-sm-3">Glicemia (mg/dl)</label>
<div class="col-sm-2">
    <input type="text" name="gl_glicemia" id="gl_glicemia" maxlength="4" 
           onKeyPress="return soloNumeros(event)" 
           value="{$gl_glicemia}" placeholder="" class="form-control" 
           {if $accion == "1"}readonly{/if}/>
</div>
{/if}