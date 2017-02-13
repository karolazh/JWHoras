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
                    </div>
                    <div class="portlet portlet-green">
                        <div class="portlet-body">
                            <form role="form" action="{$base_url}/Login/procesar" method="post" id="loginForm">
                                <fieldset>
                                    <div class="alert alert-warning">
                                        Para recuperar su contraseña, ingrese su Rut.
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control mailbox-attachment" 
                                               name="mail" id="mail" placeholder="Ingrese su Rut"/>
                                    </div>
                                    <br>
                                    <div id="form-error" class="alert alert-danger hidden">
                                        <i class="fa fa-warning fa-2x"></i> &nbsp; No se encontro un usuario para el Rut ingresado.
                                    </div>
                                    
                                    <button id="enviar" class="btn btn-lg btn-primary btn-block" type="button">Enviar</button>                                    
                                    {*<button class="btn btn-lg btn-primary btn-block" type="submit">Ingresar</button>*}
                                </fieldset>
                                <br>
                                
                                <div class="form-group">
                                    <p class="text-center">
                                        <a href="javascript:history.back();">Volver</a>
                                    </p>
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