<?php
// A) Generar variables que contengan los datos de enlace y conexión a la base de datos
$servername = "localhost";
$nombre = "nombre";
$archivo = "archivo";
$musica = "musica";

// B) Declarar la variable de conexión a la base de datos con la función MySQLi
$conn = new mysqli($servername, $nombre, $archivo, $musica);

// C) Verificar la conexión con la base de datos
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// D) Obtener el valor de los datos del formulario con los métodos POST
$nombre = $_POST['nombre'];
$archivo = $_FILES['archivo']['name'];
$archivo_tmp = $_FILES['archivo']['tmp_name'];
$directorio_destino = "uploads/" . basename($archivo);

// Mover el archivo cargado al directorio de destino
if (move_uploaded_file($archivo_tmp, $directorio_destino)) {
    // E) Ejecutar la consulta SQL
    $sql = "INSERT INTO canciones (nombre, archivo) VALUES ('$nombre', '$archivo')";
    $sql = "SELECT * FROM `canciones`;";

    if ($conn->query($sql) === TRUE) {
        echo "Nueva canción registrada exitosamente.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Error al cargar el archivo.";
}

// Cerrar la conexión
$conn->close();
?>