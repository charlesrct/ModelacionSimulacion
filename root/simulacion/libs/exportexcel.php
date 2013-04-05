<?php
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=tabla-excel.xls");
header("Pragma: no-cache");
header("Expires: 0");
$jugada = $_REQUEST["jugadas"];
?>
<table>
    <!-- Encabezado de la tala. -->
    <tr style="font-weight: bold;">
        <td> Jugada </td>
        <td> Dado 1 </td>
        <td> Dado 2 </td>
        <td> Suma </td>
    </tr>
    <?php
    //Llenando el cuerpo de la tabla de forma dinamica.
    $jugada1 = explode(" ::: ", $jugada);
    for ($i = 0; $i < (count($jugada1) - 1); $i++) {
        $jugadas = explode(" :: ", $jugada1[$i]);
        ?>
        <tr class="mini" style="text-align: center;">
            <td><?php echo ($i + 1); ?></td>
            <td><?php echo $jugadas[0]; ?></td>
            <td><?php echo $jugadas[1]; ?></td>
            <td><?php echo ($jugadas[0] + $jugadas[1]); ?></td>
        </tr>
        <?php
    }
    ?>
</table>

<?php
?>