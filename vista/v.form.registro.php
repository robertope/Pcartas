<meta charset="UTF-8">
<table>
    <form action="index.php" method="post" onsubmit="return validarform()">
        <tr>
            <td>
                <span><span class="adver">*</span>Id:</span>
            </td>
            <td>
                <input id="id" name="id" type="text">
            </td>
        </tr>
        <tr>
            <td>    
                <span><span class="adver">*</span>Contraseña:</span>
            </td>
            <td>
                <input id="pass" name="pass" type="password">
            </td>
        </tr>
        <tr>
            <td>
                <span><span class="adver">*</span>Repita la contraseña:</span>
            </td>
            <td>
                <input id="repass" type="password">
            </td>
        </tr>
        <tr>
            <td>
                <span><span class="adver">*</span>Email:</span>
            </td>
            <td>
                <div id="email">
                  <input id="mail" name="mail" type="email">
                </div> 
            </td>
        </tr>
        <tr>
            <td>
                <span><span class="adver">*</span>Nombre:</span>
            </td>
            <td>
                <input id="nombre" name="nombre" type="text">
            </td>
        </tr>
        <tr>
            <td> 
                <span>País:</span>
            </td>
            <td>
                <input id="pais" name="pais" type="text">
            </td>
        </tr>
        <tr>
            <td rowspan="2">
                <input type="submit" value="Enviar">
            </td>
        </tr>
    </form>    
</table>
