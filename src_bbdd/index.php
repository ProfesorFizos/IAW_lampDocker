<?php
// index.php
require 'config.php';

// Insertar un nombre en la base de datos si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['name'])) {
    $name = $_POST['name'];
    $stmt = $pdo->prepare('INSERT INTO users (name) VALUES (?)');
    $stmt->execute([$name]);
}

// Obtener todos los nombres de la tabla `users`
$stmt = $pdo->query('SELECT * FROM users');
$users = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplicación PHP con MySQL</title>
</head>
<body>
    <h1>Agregar un nombre a la base de datos</h1>
    <form method="POST">
        <input type="text" name="name" placeholder="Nombre" required>
        <button type="submit">Agregar</button>
    </form>

    <h2>Lista de nombres</h2>
    <ul>
        <?php foreach ($users as $user): ?>
            <li><?= htmlspecialchars($user['name']) ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
