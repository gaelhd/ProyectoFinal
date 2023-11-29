<?php
// Conexión a la base de datos SQLite
$db = new SQLite3('usuarios_db.db');

// Verificar si se han enviado datos por el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recopilar datos del formulario
    $temp = $_POST['temperaturaMedidor'];
    $hum = $_POST['humoMedidor'];

    // Verificar si la tabla "DatosHT" existe, si no, crearla
    $checkTableQuery = "SELECT name FROM sqlite_master WHERE type='table' AND name='DatosHT'";
    $result = $db->querySingle($checkTableQuery);

    if (!$result) {
        // La tabla no existe, así que la creamos
        $createTableQuery = "CREATE TABLE DatosHT (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            temperatura INTEGER NOT NULL,
            humo INTEGER NOT NULL,
            fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
        $db->exec($createTableQuery);
    }

    // Insertar datos en la tabla "DatosHT"
    $insertQuery = "INSERT INTO DatosHT (temperatura, humo) VALUES (:temperatura, :humo)";
    $stmt = $db->prepare($insertQuery);
    $stmt->bindValue(':temperatura', $temp, SQLITE3_INTEGER);
    $stmt->bindValue(':humo', $hum, SQLITE3_INTEGER);

    if ($stmt->execute()) {
        echo "Datos guardados correctamente.";
    } else {
        echo "Error al guardar los datos.";
    }

    // Cerrar la conexión a la base de datos
    $db->close();
}
?>
