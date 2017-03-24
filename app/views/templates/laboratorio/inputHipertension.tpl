<label class="control-label required col-sm-3">PAS (mm/Hg)</label>
<div class="col-sm-2">
    <input type="text" name="gl_pas" id="gl_pas" maxlength="4" 
           onKeyPress="return soloNumeros(event)" 
           value="{$gl_pas}" placeholder="" class="form-control" 
           {if $accion == "1"}readonly{/if}/>
</div>
<label class="control-label required col-sm-3">&nbsp;</label>
<div class="col-sm-2">&nbsp;
</div>
<label class="control-label required col-sm-3">PAD (mm/Hg)</label>
<div class="col-sm-2">
    <input type="text" name="gl_pad" id="gl_pad" maxlength="4" 
           onKeyPress="return soloNumeros(event)" 
           value="{$gl_pad}" placeholder="" class="form-control" 
           {if $accion == "1"}readonly{/if}/>
</div>