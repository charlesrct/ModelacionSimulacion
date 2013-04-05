<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Números Aleatorios</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="css/estilos.css" />
        <link rel="shortcut icon" href="/favicon.ico" />
        <script src="js/jquery-1.8.3.min.js" type="text/javascript"></script>
        <script src="js/funciones.js" type="text/javascript"></script>
    </head>
    <body>
        <header>
            <h1>Modelación y Simulación</h1>
            <p>Números Aleatorios en HTML5, JavaScript y PHP</p>
        </header>
        <!--*******************************-->
        <hr>
        <section>
            <article>
                <h2>Utilizando números aleatorios para mostrar resultados de una base de datos. </h2>
                <p> Clic en el botón para generar resultados aleatorios: </p>
                <div id="buscando">

                </div>

                <input type="button" id="Busca" value="Generar Aleatorio"  onclick="generarAleatorio();" class="button" />
            </article>
        </section>
        <hr>
        <!--*******************************-->
        <section>
            <article>
                <h2>Variables Aleatorias: Jugando a los dados</h2>
                <p> Clic en el botón para lanzar los dados: </p>
                <div id="dados">

                </div>
                <input type="button" id="Busca" value="Lanzar Dados"  onclick="lanzarDados();" class="button" />
                <br>
                <br>
                <input type="button" id="Guardar" value="Guardar Jugada"  onclick="guardarDados();" class="button" />
                <input type="button" id="Guardar" value="Borrar Todas las Jugadas"  onclick="borrarTodo();" class="button" />
                <div id="mensaje">

                </div>
                <input type="hidden" id="dado1" value="" />
                <input type="hidden" id="dado2" value="" />
            </article>
        </section>
        <!--*******************************-->
        <aside>
            <hr>
            <br>
            <br>
        </aside>

        <footer id="footer">
            ..::::..<br>
            Creado por: Grupo de Modelación y Simulación 2013.
        </footer>
    </body>
</html>



