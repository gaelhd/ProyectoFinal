<?php
// login.php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $db = new SQLite3('usuarios_db.db');
    $query = "SELECT * FROM usuarios WHERE username = '$username'";
    $result = $db->query($query);

    $row = $result->fetchArray();
    
    if ($row && password_verify($password, $row['password'])) {
        echo "Login exitoso. ¡Bienvenido $username";
        header("Location: index.html");
    } else {
        echo "Credenciales incorrectas. Inténtalo de nuevo.";
        header("Location: login.html");
    }

    $db->close();
}
?>
