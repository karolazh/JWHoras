<head>{include file="layout/css.tpl"}</head>

<body style="background: #fff">
<div class="container-fluid contenido">
<br><br>
    <div class="col-xs-12">
        <form class="form" role="form" enctype="multipart/form-data" method="post" action="{$smarty.const.BASE_URI}/Documento/subirArchivo" class="form-inline">
            <div class="form-group">
                <label class="control-label col-xs-2">Adjuntar archivo</label>
				<div class="col-xs-5">
					<input type="file" name="archivo" id="archivo" class="form-control"/>
				</div>	
                <input type="hidden" name="visador" id="visador" value="{$visador}"/>
				<div class="col-xs-5">
					<button type="button" class="btn btn-success btn-sm btn-flat" onclick="this.form.submit();">Adjuntar</button>
				</div>	
            </div>

        </form>

        {if isset($mensaje)}
            <div>{$mensaje}</div>
        {/if}
    </div>
</div>
</body>