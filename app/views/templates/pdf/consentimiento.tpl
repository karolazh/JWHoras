<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
</head>

<body style="font-size: 14px;font-family: Arial">

<br>
<table border="0" width="100%">
    <tr>
        <td align="center">
            <h2>FORMULARIO DE CONSENTIMIENTO</h2>
        </td>
    </tr>
</table>
<br><br>
<table border="0" width="100%">
    <tr>
        <td>
            <p style="text-align: justify">
            He le&iacute;do la informaci&oacute;n proporcionada o me ha sido le&iacute;da. 
            He tenido la oportunidad de preguntar sobre ella y se me ha contestado satisfactoriamente las 
            preguntas que he realizado. 
            <br><br>
            Consiento voluntariamente participar en esta investigaci&oacute;n como participante y entiendo 
            que tengo el derecho de retirarme de la investigaci&oacute;n en cualquier momento sin que me 
            afecte en ninguna manera mi cuidado m&eacute;dico.
            </p>
        </td>
    </tr>
</table>
<br>
<table border="0" width="100%">
    <tr>
        <td width="40%"><strong>Nombre de la Participante</strong></td>
        <td width="1%"><strong>:</strong></td>
        <td><ins>{$nombre_paciente}</ins></td>
    </tr>
    {if $rut_paciente == ""}
    <tr>
        <td><strong>RUN/Pasaporte de la Participante</strong></td>
        <td><strong>:</strong></td>
        <td><ins>{$run_pasaporte}</ins></td>
    </tr>
    <tr>
        <td><strong>C&oacute;digo de Fonasa</strong></td>
        <td><strong>:</strong></td>
        <td><ins>{$codigo_fonasa}</ins></td>
    </tr>
    {else}
    <tr>
        <td><strong>RUT de la Participante</strong></td>
        <td><strong>:</strong></td>
        <td><ins>{$rut_paciente}</ins></td>
    </tr>
    {/if}
    <tr>
        <td><strong>Fecha</strong></td>
        <td><strong>:</strong></td>
        <td><ins>{$fecha_actual}</ins></td>
    </tr>
    <tr>
        <td><strong>Firma de la Participante</strong></td>
        <td><strong>:</strong></td>
        <td>
            <br><br><br>
            <ins>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            </ins>
        </td>
    </tr>
</table>
<br><br><br><br>
<hr size="2px" color="black" />
<br><br><br>
<table border="0" width="100%">
    <tr>
        <td>
            <p style="text-align: justify">
            He le&iacute;do con exactitud a la potencial participante o he sido testigo de la lectura 
            exacta del documento de consentimiento informado para ella. Ella ha tenido la oportunidad de 
            hacer preguntas.
            </p>
        </td>
    </tr>
</table>
<br>
<table border="0" width="100%">
    <tr>
        <td>
            Confirmo que ella ha dado consentimiento libremente.
        </td>
    </tr>
</table>
<br>
<table border="0" width="100%">
    <tr>
        <td width="40%"><strong>Nombre de quien comunica el consentimiento informado</strong></td>
        <td width="1%"><strong>:</strong></td>
        <td><ins>{$nombre_usuario}</ins></td>
    </tr>
    <tr>
        <td><strong>RUT</strong></td>
        <td><strong>:</strong></td>
        <td><ins>{$rut_usuario}</ins></td>
    </tr>
    <tr>
        <td><strong>Firma</strong></td>
        <td><strong>:</strong></td>
        <td>
            <br><br><br>
            <ins>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            </ins>
        </td>
    </tr>        
</table>
<br><br><br>
<table border="0" width="100%">
    <tr>
        <td align="center" style="font-size: 12px;font-family: Arial">
            <strong>Ha sido proporcionada al participante una copia de este documento de Consentimiento Informado.</strong>
        </td>
    </tr>
</table>

</body>
</html>