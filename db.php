<?php
// Mostrar errores para diagnóstico
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Incluir SweetAlert2
echo '
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                // Aquí dentro se ejecutarán las alertas de SweetAlert2
            });
        </script>
    </head>
';


// Clave secreta de tu reCAPTCHA
$secret_key = '6LejBUEqAAAAAIk9FGFkYUc04l_2282wKTcAGYEZ';

// Respuesta del reCAPTCHA enviada por el formulario
$recaptcha_response = $_POST['g-recaptcha-response'];

// Verificar la respuesta del reCAPTCHA con Google
$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret_key&response=$recaptcha_response");
$response_keys = json_decode($response, true);

if (intval($response_keys["success"]) !== 1) {
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Por favor, verifica que no eres un robot.'
            }).then(() => {
                window.location.href = 'trabaja.html';
            });
        });
    </script>";
    exit;
}



// Configuración de la conexión a la base de datos
$servername = "localhost";
$username = "urmauqo3ktwbx";
$password = "7#3;$2_p1Ncq";
$dbname = "dboscgeuvminkv";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                title: 'Error de conexión',
                text: 'No se pudo conectar a la base de datos: " . $conn->connect_error . "'
            }).then(() => {
                window.location.href = 'index.html';
            });
        });
    </script>";
    exit;
}

// Obtener los datos del formulario
$fecha_postulacion = $_POST['fecha-postulacion'];
$nombre_apellido = $_POST['nombre-apellido'];
$nivel_educativo = $_POST['nivel-educativo'];
$cargo = $_POST['cargo'];
$telefono = $_POST['telefono'];
$genero = $_POST['genero'];
$pais_domicilio = $_POST['pais-domicilio'];
$Municipio_domicilio = $_POST['Municipio-domicilio'];
$zona_residencia = $_POST['zona-residencia'];
$barrio = $_POST['barrio'];
$fecha_nacimiento = $_POST['fecha-nacimiento'];
$tipo_documento = $_POST['tipo-documento'];
$numero_documento = $_POST['numero-documento']; // Nuevo campo agregado
$recomendado = $_POST['recomendado'];



// Manejo del archivo adjunto
$hoja_vida_blob = null;
if (isset($_FILES['hoja-vida']) && $_FILES['hoja-vida']['error'] == UPLOAD_ERR_OK) {
    $hoja_vida = $_FILES['hoja-vida']['tmp_name'];
    $hoja_vida_blob = addslashes(file_get_contents($hoja_vida));
} else {
    $hoja_vida_blob = null; // Si el archivo no se sube, el campo puede ser null
}



// Preparar y ejecutar la consulta
$stmt = $conn->prepare("INSERT INTO postulaciones (fecha_postulacion, nombre_apellido, nivel_educativo, cargo, telefono, genero, 
        pais_domicilio, Municipio_domicilio, zona_residencia, barrio, fecha_nacimiento, tipo_documento, numero_documento, recomendado, hoja_vida)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

if (!$stmt) {
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                title: 'Error en la consulta',
                text: 'Error en la preparación de la consulta: " . $conn->error . "'
            }).then(() => {
                window.location.href = 'index.html';
            });
        });
    </script>";
    exit;
}


// Vincular los parámetros a la consulta preparada
$stmt->bind_param('sssssssssssssss', $fecha_postulacion, $nombre_apellido, $nivel_educativo, $cargo, $telefono, $genero, 
        $pais_domicilio, $Municipio_domicilio, $zona_residencia, $barrio, $fecha_nacimiento, $tipo_documento, $numero_documento, $recomendado, $hoja_vida_blob);

// Ejecutar la consulta
if ($stmt->execute()) {
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: 'Postulación guardada',
                text: 'Tu postulación ha sido guardada con éxito.'
            }).then(() => {
                window.location.href = 'index.html';
            });
        });
    </script>";
} else {
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                title: 'Error al guardar',
                text: 'Ocurrió un error al guardar tu postulación: " . $stmt->error . "'
            }).then(() => {
                window.location.href = 'index.html';
            });
        });
    </script>";
}
// Cerrar la conexión
$stmt->close();
$conn->close();


