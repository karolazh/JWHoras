<!DOCTYPE html>
<html lang="es">
    <head>
        {include file="layout/css.tpl"}
    </head>
    <body class="body-login">
        <br/><br/><br/>
        <div class="container">
         
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="login-banner text-center">
                        <br/>
                        <img src="{$static}images/logo_minsal.png" />
                        <br/>
                        <h1 class="text-center">Prevenci&oacute;n de Femicidios</h1>
                        <h4>Inicio de sesión</h4>
                    </div>
                    <div class="portlet portlet-green">
                        <div class="portlet-body">
                            <form role="form" action="{$base_url}/Login/procesar" method="post" id="loginForm">
                                <fieldset>
                                    {*<div class="form-group">
                                    <input class="form-control rut" name="rut" id="rut" type="text" placeholder="Escriba su RUT"/>
                                    </div>*}
                                    <div class="form-group">
                                        <input type="text" class="form-control" maxlength="13" 
                                               onkeyup="formateaRut(this), validaRut(this), this.value = this.value.toUpperCase()"
                                               onkeypress ="return soloLetras(event)"
                                               name="rut" id="rut" placeholder="Ingrese su Rut"/>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" 
                                               name="password" id="password" placeholder="Ingrese su Contraseña"/>
                                    </div>
                                    <div class="form-group hide">
                                        <input type="checkbox" name="recordar" id="recordar" value="1"/> 
                                        Recordarme en este equipo
                                    </div>
                                    <div id="form-error" class="alert alert-danger {$hidden}">
                                        <i class="fa fa-warning fa-2x"></i> &nbsp; {$texto_error}
                                    </div>
                                    <br>
                                    <button id="ingresar" class="btn btn-lg btn-primary btn-block" type="submit" onClick="xModal.info('Iniciando Sesion');">Ingresar&nbsp;&nbsp;<i></i></button>
                                </fieldset>
                                <br>
                                <script>
                                 </script>   
                                <div class="form-group">
                                    <p class="text-center">
                                        <a href="{$base_url}/Login/recuperar_password">¿Olvidó su contraseña?</a>
                                    </p>
                                    {*<table style="width:100%;">
                                    <tr>
                                    <td>
                                        
                                    </td>
                                    <td>
                                    <p class="text-right">
                                        
                                    </p>
                                    </td>
                                    </tr>
                                    </table>*}
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {include file="layout/js.tpl"}
    </body>
</html>