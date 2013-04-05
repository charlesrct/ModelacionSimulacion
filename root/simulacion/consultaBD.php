<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once 'config.php';
require_once 'class/class.php';
require_once 'class/simulaModel.php';
$consultar = new simulaModel();

//Como se utiliza en varias partes el mismo código se hace una función y se llama todas la veces que se necesite.
function dibujaTabla($jugadas) {
    ?>
    <!-- Bloque HTML para hacer la tala. -->
    <table>
        <!-- Encabezado de la tala. -->
        <tr style="font-weight: bold;">
            <td> Jugada </td>
            <td> Dado 1 </td>
            <td> Dado 2 </td>
            <td> Suma </td>
            <td> Editar </td>
            <td> Eliminar </td>
        </tr>
        <?php
        //Llenando el cuerpo de la tabla de forma dinamica.
        for ($i = 0; $i < count($jugadas); $i++) {
            ?>
            <tr class="mini" style="text-align: center;">
                <td><?php echo ($i + 1); ?></td>
                <td><?php echo $jugadas[$i]['dado1']; ?></td>
                <td><?php echo $jugadas[$i]['dado2']; ?></td>
                <td><?php echo ($jugadas[$i]['dado1'] + $jugadas[$i]['dado2']); ?></td>
                <td>
                    <input type="image" id="Editar" src="img/editar.png" value="E"  onclick="editarDados(<?php echo $i; ?>);" class="button mini"/>
                </td>
                <td>
                    <input type="image" id="Eliminar" src="img/borrar.png" value="X"  onclick="eliminarDados(<?php echo $i; ?>);" class="button mini"/>
                </td>
                <td class="oculto"><input type="hidden" id="id_dado<?php echo $i; ?>" value="<?php echo $jugadas[$i]['id']; ?>" /></td>
            </tr>
            <?php
        }
        ?>
    </table>
    <div>
        <br>
        <div class="lado">
            <form id="excel" name="excel" method="post" action="libs/exportexcel.php">
                <input type="hidden" name="jugadas" id="jugadas" value="<?php
                for ($i = 0; $i < count($jugadas); $i++) {
                    echo $jugadas[$i]['dado1'] . " :: " . $jugadas[$i]['dado2'] . " ::: ";
                }
                ?>"/>
                <input type="submit" id="enviarx" value="Exportar a Excel" class="button mini"/>
            </form>
        </div>
        <div class="lado">
            <form id="word" name="word" method="post" action="libs/exportword.php">
                <input type="hidden" name="jugadas" id="jugadas" value="<?php
                for ($i = 0; $i < count($jugadas); $i++) {
                    echo $jugadas[$i]['dado1'] . " :: " . $jugadas[$i]['dado2'] . " ::: ";
                }
                ?>"/>
                <input type="submit" id="enviarw" value="Exportar a Word" class="button mini"/>
            </form>
        </div>
        <div class="lado">
            <form id="pdf" name="pdf" method="post" action="libs/exportpdf.php">
                <input type="hidden" name="jugadas" id="jugadas" value="<?php
                for ($i = 0; $i < count($jugadas); $i++) {
                    echo $jugadas[$i]['dado1'] . " :: " . $jugadas[$i]['dado2'] . " ::: ";
                }
                ?>"/>
                <input type="submit" id="enviarp" value="Exportar a pdf" class="button mini"/>
            </form>
        </div>
        <br>
    </div>
    <?php
}

//echo '<pre>';
//print_r($prueba);
//echo '</pre>';
//echo MSG_INICIAL;
//echo "<br>Hola mundo desde Modelación y Simulacion<br>";
//echo ($numero_aleatorio);

if (isset($_REQUEST['action'])) {
    $action = $_REQUEST['action'];
    switch ($action) {
        case 'generaAleatorio':
            //Consulta los datos de la tabla participantes.
            $prueba = $consultar->consulta();
            $numero_aleatorio = rand(0, 6);
            for ($i = 0; $i < count($prueba); $i++) {
                if ($i == $numero_aleatorio) {
                    echo ($prueba[$i]['nombre'] . " " . $prueba[$i]['apellido'] . " C.C. " . $prueba[$i]['identificacion'] . " e-mail: " . $prueba[$i]['correo'] );
                }
            }
            break;

        case 'mostrarTabla':
            //Muestra las jugadas almacenadas en la base de datos al cargar la página
            $jugadas = $consultar->mostrarTabla();
            if (!empty($jugadas)) {
                dibujaTabla($jugadas);
            }
            break;

        case 'lanzarDados':
            //Genera 2 números aleatorios y muestra el resultado.
            $dado1 = rand(1, 6);
            $dado2 = rand(1, 6);
            echo $dado1 . ' :: ' . $dado2;
            break;

        case 'guardarDados':
            //Guarda en la base de datos los 2 dados lanzados y muestra todas las jugadas almacenadas.
            $dado1 = $_REQUEST['dado1'];
            $dado2 = $_REQUEST['dado2'];
            $jugadas = $consultar->guardarDados($dado1, $dado2);
            //echo '<pre>';
            //print_r ($jugadas);
            dibujaTabla($jugadas);
            break;

        case 'editarDados':
            //Guarda en la base de datos los 2 dados lanzados y muestra todas las jugadas almacenadas.
            $dado1 = $_REQUEST['dado1'];
            $dado2 = $_REQUEST['dado2'];
            $id = $_REQUEST['id'];
            $jugadas = $consultar->editarDados($dado1, $dado2, $id);
            //echo '<pre>';
            //print_r ($jugadas);
            dibujaTabla($jugadas);
            break;

        case 'eliminarDados':
            //Borra de la base de datos los 2 dados y muestra todas las jugadas almacenadas.
            $id = $_REQUEST['id'];
            $jugadas = $consultar->eliminarDados($id);
            dibujaTabla($jugadas);
            break;



        case 'borrarTodo':
            //Borra todos los datos de la base.
            $consultar->borrarTodo();
            break;
    }
}
?>