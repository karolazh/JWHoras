<div class="row" style="width: 100%; min-height: calc(100vh); margin-left:auto;margin-right:auto;background-color: white; max-width: 100%;">
	<div class="col-xs-10">	
		<form class="form-horizontal" name="form-adjunto" id="form-adjunto" action="{$smarty.const.BASE_URI}/Adjunto/guardarAdjunto" method="post" enctype="multipart/form-data"> 
			<div class="form-group top-spaced">
				<label for="" class="control-label col-xs-2">Adjunto</label>
				<div class="col-xs-10">
					<input type="file" name="adjunto" id="adjunto" class="form-control"/>
				</div>
			</div>

			{if isset($success)}
				{if $success == 1}
					<div class="alert alert-success top-spaced">{$mensaje}</div>
				{else}
					<div class="alert alert-danger top-spaced">{$mensaje}</div>
				{/if}
			{/if}

			<div class="text-center top-spaced">
				<button class="btn btn-xs btn-danger" type="button" onclick="parent.xModal.close();">Cerrar ventana</button>
				<button class="btn btn-xs btn-success" type="button" onclick="parent.Adjunto.guardarAdjunto(this.form,this);">Guardar adjunto</button>
			</div>
		</form>
	</div>
</div>