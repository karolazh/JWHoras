{if $visible == "SI" }
	<div class="col-lg-3 margin-remove">
    <div class="col-xs-12 ">
	
		
        <div class="panel panel-{if $disponible == "si"}{$color}{else}default{/if}" style="border-radius:5px{if $disponible != "si"};cursor: not-allowed{/if}" >
            <div class="panel-heading">
                <div class="row">
							<div class="col-xs-4" style="height:65px">
								<div class="card">
										<i class="fa {$icono} fa-4x icono"></i>
								</div>
							</div>

                    <div class="col-xs-8 text-center">
							<h4>{$nombre}</h4>
                    </div>
                </div>
				<div class="row top-spaced">
						<div class="col-xs-12 text-left">
						<h6>{$descripcion}&nbsp;</h6>
					</div>
				</div>				
            </div>
			{if $disponible == "si"}
				{if $id_sistema == 14 or $id_sistema == 18 }
					<a href="http://{$url}&rut={$rut}&encr={$string_validacion}" data-original-title="" title="" target="_blank">
				{elseif $id_sistema == 10}
					<a href="http://{$url}{$rut}/" data-original-title="" title="" target="_blank">
				{else}
				<a href="http://{$url}?rut={$rut}&encr={$string_validacion}" data-original-title="" title="" target="_blank">
				{/if}
			{/if}
                <div class="panel-footer">
                    <span class="pull-left">
						{if $disponible == "si"}
							Ingresar
						{else}
							Sin acceso
						{/if}	
					</span>
                    <span class="pull-right">
						{if $disponible == "si"}
							<i class="fa fa-arrow-circle-right"></i>
						{else}
							<i class="fa fa-lock"></i>						
						{/if}		
                    </span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>		
</div>
{/if}	
