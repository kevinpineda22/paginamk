<?php
// Mostrar errores para diagnóstico
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Configuración de la conexión a la base de datos
$servername = "localhost";
$username = "urmauqo3ktwbx"; // Cambia esto por tu usuario
$password = "7#3;$2_p1Ncq"; // Cambia esto por tu contraseña
$dbname = "dboscgeuvminkv"; // Cambia esto por tu base de datos

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si se ha pasado el ID de la postulación
if (isset($_GET['id'])) {
    $id_postulacion = intval($_GET['id']); // Asegurarse de que el ID sea un entero

    // Consultar la base de datos para obtener el archivo
    $sql = "SELECT hoja_vida FROM postulaciones WHERE id = ?";
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("i", $id_postulacion);
        $stmt->execute();
        $stmt->bind_result($hoja_vida_blob);
        $stmt->fetch();
        $stmt->close();

        // Verificar si se encontró el archivo
        if ($hoja_vida_blob) {
            // Verificar que el contenido del blob no esté vacío
            if (empty($hoja_vida_blob)) {
                die("El archivo está vacío.");
            }

            // Establecer encabezados para la descarga
            header('Content-Type: application/pdf'); // Tipo MIME del archivo
            header('Content-Disposition: attachment; filename="hoja_vida.pdf"'); // Nombre del archivo al descargar
            header('Content-Length: ' . strlen($hoja_vida_blob)); // Longitud del contenido

            // Limpiar el buffer de salida
            ob_clean(); // Limpia el buffer de salida
            flush(); // Asegura que se envíe el buffer

            // Enviar el contenido del archivo al navegador
            echo $hoja_vida_blob;
            exit; // Termina el script después de enviar el archivo
        } else {
            echo "Archivo no encontrado.";
        }
    } else {
        echo "Error en la preparación de la consulta.";
    }
} else {
    echo "ID de postulación no especificado.";
}

// Cerrar la conexión
$conn->close();
?>
