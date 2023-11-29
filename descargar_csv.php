<?php
// Conexión a la base de datos SQLite
$db = new SQLite3('usuarios_db.db');

// Verificar si la conexión se realizó con éxito
if (!$db) {
    die("Error en la conexión a la base de datos.");
}

// Consulta SQL para seleccionar todos los registros de la tabla "datos"
$query = "SELECT * FROM DatosHT";

// Ejecutar la consulta SQL
$result = $db->query($query);

// Configurar encabezados para descargar como archivo CSV
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="datos.csv"');

// Abrir el archivo de salida
$output = fopen('php://output', 'w');

// Encabezados del archivo CSV
fputcsv($output, array('Id','Temperatura', 'Humedad', 'Fecha'));

// Recorrer los resultados y escribirlos en el archivo CSV
while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    fputcsv($output, $row);
}

// Cerrar la conexión a la base de datos
$db->close();
?>
