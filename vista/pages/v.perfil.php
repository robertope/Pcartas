<meta charset="UTF-8">
<table id="tperfil">
    <tr>
        <th>#NOMBRE#</th>
        <th>#IMAGEN#</th>
    </tr>
    <tr>
        <td><span>Cambiar avatar</span> (JPG, 1Mb max)</td>
        <td>
            <form action="index.php" method="post" enctype="multipart/form-data">
                <input name="avatar" type="file"/>
                <input type="submit" value="Cambiar" name="Cavatar"/>
            </form>
        </td>
    </tr>
    <tr>
        <td><span>Correo:</span></td>
        <td>#CORREO#</td>
    </tr>
    <tr>
        <td><span>País:</span></td>
        <td>#PAIS#</td>
    </tr>
    <tr>
        <td><span>Monedas:</span></td>
        <td>#MONEDAS#</td>
    </tr>
    <tr>
        <td><span>Dinero:</span></td>
        <td>#DINERO#</td>
    </tr>
    <tr>
        <td><span>Nº de cartas:</span></td>
        <td>#NCARTAS#</td>
    </tr>
    <tr>
        <td><span>Nº de mazos:</span></td>
        <td>#NMAZOS#</td>
    </tr>
    <tr>
        <td><span>Nº de partidas:</span></td>
        <td>#NPARTIDAS#</td>
    </tr>
    <tr>
        <td><span>Nº de victorias:</span></td>
        <td>#NVICTORIAS#</td>
    </tr>
    <tr>
        <td><span>Nº de derrotas:</span></td>
        <td>#NDERROTAS#</td>
    </tr>
    <tr>
        <td><span>Grafico:</span><button id="botonG">Mostrar Gráfico</button></td>
        <td><canvas id="grafico"></canvas></td>
    </tr>
</table>