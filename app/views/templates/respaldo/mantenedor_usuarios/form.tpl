<form id="form" name="form-inline" enctype="application/x-www-form-urlencoded" action="" method="post">
    <input type="hidden" name="id" id="id" value="{$item->id}"/>
    <div class="col-md-6 text-left">
        <div class="form-group clearfix">
            <label for="rut" class="control-label required">Rut (*)</label>
            <input type="text" name="rut" id="rut" value="{$item->rut}" class="form-control rut"/>
            <span class="help-block hidden"></span>
        </div>
    </div>
    <div class="col-md-6 text-left">
        <div class="form-group clearfix">
            <label for="rut" class="control-label required">Perfil (*)</label>
            <select class="form-control" id="perfil" name="perfil">
                <option value="">Seleccione...</option>
                <option value="1" {if $item->id_perfil == 1} selected {/if}>Administrador</option>
                <option value="2" {if $item->id_perfil == 2} selected {/if}>Visador</option>
                <option value="3" {if $item->id_perfil == 3} selected {/if}>Auditoría</option>
            </select>
            <span class="help-block hidden"></span>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-md-6 text-left">
        <div class="form-group clearfix">
            <label for="nombre" class="control-label required">Nombres (*)</label>
            <input type="text" name="nombre" id="nombre" value="{$item->nombres}" class="form-control"/>
            <span class="help-block hidden"></span>
        </div>
    </div>
    <div class="col-md-6 text-left">
        <div class="form-group clearfix">
            <label for="apellido" class="control-label required">Apellidos (*)</label>
            <input type="text" name="apellido" id="apellido" value="{$item->apellidos}" class="form-control"/>
            <span class="help-block hidden"></span>
        </div>
    </div>
    <div class="col-md-6 text-left">
        <div class="form-group clearfix">
            <label for="email" class="control-label required">Email (*)</label>
            <input type="text" name="email" id="email" value="{$item->email}" class="form-control"/>
            <span class="help-block hidden"></span>
        </div>
    </div>
    <div class="col-md-6 text-left">
        <div class="form-group clearfix">
            <label for="email" class="control-label required">Contraseña (*)</label>
            <input type="text" name="password" id="password" value="" class="form-control"/>
            {if !$nuevo}
                <span class="help-description">Deje el campo en blanco si no desea cambiar la contraseña</span>
            {/if}
            <span class="help-block hidden"></span>
        </div>
    </div>
    <div class="clearfix"></div>
    
    <div class="clearfix"></div>
    

    <div class="clearfix"></div>

    <div id="form-error" class="alert alert-danger hidden">
        <i class="fa fa-warning fa-2x"></i> &nbsp; <strong> ¡Error! </strong> Existen problemas en los datos, revise los
        campos en rojo.
    </div>

    <div class="col-md-12 text-right">
        <button type="button" id="guardar" class="btn btn-success btn-sm btn-flat">
            <i class="fa fa-save"></i> Guardar
        </button>
        <button type="button" id="cancelar" onclick="location.href='{$base_url}/MantenedorUsuarios/index'"
                class="btn btn-default btn-sm btn-flat">
            <i class="fa fa-remove"></i> Cancelar
        </button>
    </div>

</form>
