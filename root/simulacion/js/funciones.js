//Esta es la función que se ejecuta al cargar la página.
jQuery(document).ready(function() {
    jQuery('#Busca').focus();
    jQuery('#Busca').select();
    mostrarTabla();
});

//Verifica si hay datos para mostrar al cargar la página
function mostrarTabla() {

    jQuery.ajax({
        url: "consultaBD.php",
        type: 'POST',
        cache: false,
        dataType: 'html',
        data: ({
            action: 'mostrarTabla'
        }),
        beforeSend: function() {
            jQuery("#mensaje").html("Espere un momento por favor estamos verificando si existen jugadas guardadas."); //Muestra mensaje mientras se ejecuta el proceso.
            jQuery('#mensaje').css('color', 'green');
        },
        success: function(data) {
            jQuery("#mensaje").html(data);
            jQuery("#dados").html(" ");
            jQuery('#mensaje').css('color', 'black');

        }
    });
}

function generarAleatorio() {

    jQuery.ajax({
        url: "consultaBD.php",
        type: 'POST',
        cache: false,
        dataType: 'html',
        data: ({
            action: 'generaAleatorio'
        }),
        beforeSend: function() {
            jQuery("#buscando").html("Generando el número aleatorio y consultando en la base de datos..."); //Muestra mensaje mientras se ejecuta el proceso.
            jQuery('#buscando').css('color', 'red');
        },
        success: function(data) {
            jQuery("#buscando").html(data);
            jQuery('#buscando').css('color', 'black');
        }
    });

}
//**************************************************
function lanzarDados() {
    jQuery.ajax({
        url: "consultaBD.php",
        type: 'POST',
        cache: false,
        dataType: 'html',
        data: ({
            action: 'lanzarDados'
        }),
        beforeSend: function() {
            jQuery("#dados").html("Agitando y lanzando los dados..."); //Muestra mensaje mientras se ejecuta el proceso.
            jQuery('#dados').css('color', 'green');
        },
        success: function(data) {
            var datos = data.split(' :: ');
            var dado1 = datos[0];
            var dado2 = datos[1];

            jQuery("#dado1").val(dado1);
            jQuery("#dado2").val(dado2);

            jQuery("#dados").html('Dado 1 = ' + dado1 + '<br>Dado 2 = ' + dado2);
            jQuery('#dados').css('color', 'black');
            if (dado1 === dado2) {
                alert('!Sacaste pares¡ Lanza de nuevo.');
            }
        }
    });
}

//Guardamos el resultado de los dados y mostramos el resultado de la jugada en una tabla.
function guardarDados() {

    var dado1 = jQuery("#dado1").val();
    var dado2 = jQuery("#dado2").val();

    jQuery("#dado1").val("0");
    jQuery("#dado2").val("0");

    //Valida si se lanzaron los dados.
    if (dado1 == 0 || dado2 == 0) {
        alert("Error, debe lanzar los dados primero.")
        return false;
    }

    jQuery.ajax({
        url: "consultaBD.php",
        type: 'POST',
        cache: false,
        dataType: 'html',
        data: ({
            action: 'guardarDados',
            dado1: dado1,
            dado2: dado2
        }),
        beforeSend: function() {
            jQuery("#mensaje").html("Espere un momento por favor estamos guardando su jugada."); //Muestra mensaje mientras se ejecuta el proceso.
            jQuery('#mensaje').css('color', 'green');
        },
        success: function(data) {
            jQuery("#mensaje").html("Su jugada ha sido guardada." + data);
            jQuery("#dados").html(" ");
            jQuery('#mensaje').css('color', 'black');

        }
    });
}

//Cambia el resultado de los datos en la tabla.
function editarDados(i) {

    var dado1 = prompt("Digite el nuevo valor para el Dado 1");
    var dado2 = prompt("Digite el nuevo valor para el Dado 2");

    jQuery("#dado1").val("0");
    jQuery("#dado2").val("0");

    //Valida si se lanzaron los dados.
    if (dado1 == 0 || dado2 == 0) {
        alert("Error, el valor debe se diferente de 0.")
        return false;
    }
    if ((dado1 > 6 || dado1 < 1) || (dado2 > 6 || dado2 < 1)) {
        alert("Error, el valor debe ser un número entre 1 y 6.")
        return false;
    }

    var id = jQuery("#id_dado" + i).val();

    jQuery.ajax({
        url: "consultaBD.php",
        type: 'POST',
        cache: false,
        dataType: 'html',
        data: ({
            action: 'editarDados',
            dado1: dado1,
            dado2: dado2,
            id: id
        }),
        beforeSend: function() {
            jQuery("#mensaje").html("Espere un momento por favor estamos editando su jugada."); //Muestra mensaje mientras se ejecuta el proceso.
            jQuery('#mensaje').css('color', 'green');
        },
        success: function(data) {
            jQuery("#mensaje").html("Su jugada ha sido editada." + data);
            jQuery("#dados").html(" ");
            jQuery('#mensaje').css('color', 'black');

        }
    });
}

//Cambia el estado de los datos en la tabla.
function eliminarDados(i) {

    var x = confirm("Realiza un borrado lógico de la jugada en la tabla. \n ¿Esta seguro?");
    if (!x) {
        return false;
    }

    var id = jQuery("#id_dado" + i).val();

    jQuery.ajax({
        url: "consultaBD.php",
        type: 'POST',
        cache: false,
        dataType: 'html',
        data: ({
            action: 'eliminarDados',
            id: id
        }),
        beforeSend: function() {
            jQuery("#mensaje").html("Espere un momento por favor estamos borrando su jugada."); //Muestra mensaje mientras se ejecuta el proceso.
            jQuery('#mensaje').css('color', 'green');
        },
        success: function(data) {
            jQuery("#mensaje").html("Su jugada ha sido borrada." + data);
            jQuery("#dados").html(" ");
            jQuery('#mensaje').css('color', 'black');

        }
    });
}

//Cambia el resultado de los datos en la tabla.
function borrarTodo() {

    var x = confirm("Se borraran todos los datos de la tabla. \n ¿Esta seguro?");
    if (!x) {
        return false;
    }

    jQuery.ajax({
        url: "consultaBD.php",
        type: 'POST',
        cache: false,
        dataType: 'html',
        data: ({
            action: 'borrarTodo'
        }),
        beforeSend: function() {
            jQuery("#mensaje").html("Espere un momento por favor estamos borrando las jugadas de la base de datos."); //Muestra mensaje mientras se ejecuta el proceso.
            jQuery('#mensaje').css('color', 'green');
        },
        success: function(data) {
            jQuery("#mensaje").html("Todas las jugadas han sido borradas.");
            jQuery("#dados").html(" ");
            jQuery('#mensaje').css('color', 'black');

        }
    });
}













//**************************************************
function checkForEnter(event) {

    // Input actual
    //var currentBoxNumber = input.index(this);
    //Si es la tecla enter (keyCode==13) avanza al siguiente campo
    if (event.keyCode === 13) {
        //if (currentBoxNumber == 0 && jQuery('#username_admin').val() != '') {
        //    jQuery('#clave_admin').focus();
        //    event.preventDefault();
        //}
        // if (currentBoxNumber == 1 && jQuery('#clave_admin').val() != '') {
        //     iniciar_xcaja();
        // }
    }
}

function validar_email(valor)
{
    // creamos nuestra regla con expresiones regulares.
    var filter = /[\w-\.]{3,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
    // utilizamos test para comprobar si el parametro valor cumple la regla
    if (filter.test(valor))
        return true;
    else
        return false;
}

