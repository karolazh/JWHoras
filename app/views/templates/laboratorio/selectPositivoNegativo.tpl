<!-- 
* SEGÚN VALORES INGRESADOS EN EMPA *
0 = POSITIVO
1 = NEGATIVO
-->
<label class="control-label required col-sm-3">Resultado examen</label>
<label><input type="radio" name="gl_resultado" 
            id="gl_resultado_0" value="0" 
            {if $accion == "1"}readonly{/if} {$gl_resultado_0}>
  <span class="label label-success">POSITIVO</span>
</label>&nbsp;&nbsp;
<label><input type="radio" name="gl_resultado" 
            id="gl_resultado_1" value="1" 
            {if $accion == "1"}readonly{/if} {$gl_resultado_1}>
  <span class="label label-danger" style="color:#ffffff">NEGATIVO</span>
</label>