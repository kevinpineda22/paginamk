<?php
// Mostrar errores para diagnóstico
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Clave secreta de tu reCAPTCHA
$secret_key = '6LejBUEqAAAAAIk9FGFkYUc04l_2282wKTcAGYEZ';

// Respuesta del reCAPTCHA enviada por el formulario
$recaptcha_response = $_POST['g-recaptcha-response'];

// Verificar la respuesta del reCAPTCHA con Google
$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret_key&response=$recaptcha_response");
$response_keys = json_decode($response, true);

if (intval($response_keys["success"]) !== 1) {
    die("Error: Por favor, verifica que no eres un robot.");
}

// Conexión a la base de datos
$servername = "localhost";
$username = "urmauqo3ktwbx";
$password = "D83b13I&*%25";
$dbname = "dboscgeuvminkv";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los datos del formulario
$fecha_postulacion = $_POST['fecha_postulacion'];
$nombre_apellido = $_POST['nombre_apellido'];
$nivel_educativo = $_POST['nivel_educativo'];
$cargo = $_POST['cargo'];
$telefono = $_POST['telefono'];
$genero = $_POST['genero'];
$pais_domicilio = $_POST['pais_domicilio'];
$ciudad_domicilio = $_POST['ciudad_domicilio'];
$zona_residencia = $_POST['zona_residencia'];
$barrio = $_POST['barrio'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$tipo_documento = $_POST['tipo_documento'];
$numero_documento = $_POST['numero_documento'];
$recomendado = $_POST['recomendado'];

// Validación del número de documento (debe ser numérico y tener una longitud específica, por ejemplo, 8 a 12 dígitos)
if (!is_numeric($numero_documento) || strlen($numero_documento) < 8 || strlen($numero_documento) > 12) {
    die("Error: El número de documento no es válido. Debe ser numérico y tener entre 8 y 12 dígitos.");
}

// Manejo del archivo adjunto
$hoja_vida_blob = null;
$allowed_types = ['application/pdf', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
$max_file_size = 5 * 1024 * 1024; // 5 MB

if (isset($_FILES['hoja_vida']) && $_FILES['hoja_vida']['error'] == UPLOAD_ERR_OK) {
    $file_type = $_FILES['hoja_vida']['type'];
    $file_size = $_FILES['hoja_vida']['size'];
    
    if (in_array($file_type, $allowed_types) && $file_size <= $max_file_size) {
        $hoja_vida = $_FILES['Hoja_Vida']['tmp_name'];
        $hoja_vida_blob = file_get_contents($hoja_vida);
    } else {
        die("Error: El archivo subido no es válido o excede el tamaño máximo permitido.");
    }
} else {
    $hoja_vida_blob = null; // Si el archivo no se sube, el campo puede ser null
}

// Preparar y ejecutar la consulta
$stmt = $conn->prepare("INSERT INTO postulaciones (fecha_postulacion, nombre_apellido, nivel_educativo, cargo, telefono, genero, 
        pais_domicilio, ciudad_domicilio, zona_residencia, barrio, fecha_nacimiento, tipo_documento, numero_documento, recomendado, hoja_vida)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

if (!$stmt) {
    die("Error en la preparación de la consulta: " . $conn->error);
}

// Usar 'bind_param' para manejar los datos y evitar inyecciones SQL
$stmt->bind_param('sssssssssssssss', $fecha_postulacion, $nombre_apellido, $nivel_educativo, $cargo, $telefono, $genero, 
        $pais_domicilio, $ciudad_domicilio, $zona_residencia, $barrio, $fecha_nacimiento, $tipo_documento, $numero_documento, $recomendado, $hoja_vida_blob);

if ($stmt->execute()) {
    echo "Postulación guardada exitosamente.";
} else {
    echo "Error al ejecutar la consulta: " . $stmt->error;
}

// Cerrar la conexión
$stmt->close();
$conn->close();
?>
