<?php
// register.php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $db = new SQLite3('usuarios_db.db');
    $query = "INSERT INTO usuarios (username, password) VALUES ('$username', '$password')";
    $db->exec($query);

    echo "Registro exitoso. Ahora puedes iniciar sesión.";
    header("Location: login.html");

    $db->close();
}
?>
