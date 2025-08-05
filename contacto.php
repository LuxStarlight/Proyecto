<?php
$host = 'sql308.infinityfree.com';
$dbname = 'if0_39583760_db_libreria';
$username = 'if0_39583760';
$password = 'evanghel262001';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $mensaje = '';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nombre = $_POST['name'] ?? '';
        $correo = $_POST['email'] ?? '';
        $asunto = $_POST['subject'] ?? '';
        $comentario = $_POST['comment'] ?? '';

        $sql = "INSERT INTO contacto (nombre, correo, asunto, comentario, fecha)
                VALUES (:nombre, :correo, :asunto, :comentario, NOW())";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nombre' => $nombre,
            ':correo' => $correo,
            ':asunto' => $asunto,
            ':comentario' => $comentario
        ]);

        $mensaje = "¡Mensaje enviado con éxito!";
    }
} catch (PDOException $e) {
    $mensaje = "Error de conexión: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Contacto</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6; 
        }
        .container {
            max-width: 800px; 
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="container mx-auto p-4 sm:p-6 lg:p-8">
        <header class="bg-blue-600 text-white p-6 rounded-lg shadow-md mb-8">
            <h1 class="text-3xl sm:text-4xl font-bold text-center">Contáctanos</h1>
            <p class="text-center mt-2 text-blue-100">Envíanos tus preguntas, comentarios o sugerencias.</p>
            <nav class="mt-4 text-center">
                <a href="libros.php" class="inline-block bg-blue-700 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded-full mx-2 transition duration-300">Libros</a>
                <a href="autores.php" class="inline-block bg-blue-700 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded-full mx-2 transition duration-300">Autores</a>
                <a href="contacto.php" class="inline-block bg-blue-700 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded-full mx-2 transition duration-300">Contacto</a>
            </nav>
        </header>

        <div class="bg-white p-8 rounded-lg shadow-md">
            <?php if (!empty($mensaje)): ?>
                <p class="mb-4 text-center text-green-600 font-semibold">
                    <?= htmlspecialchars($mensaje) ?>
                </p>
            <?php endif; ?>

            <form class="space-y-6" method="POST" action="">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nombre:</label>
                    <input type="text" id="name" name="name" required
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Correo Electrónico:</label>
                    <input type="email" id="email" name="email" required
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>
                <div>
                    <label for="subject" class="block text-sm font-medium text-gray-700">Asunto:</label>
                    <input type="text" id="subject" name="subject" required
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>
                <div>
                    <label for="comment" class="block text-sm font-medium text-gray-700">Comentario:</label>
                    <textarea id="comment" name="comment" rows="5" required
                              class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"></textarea>
                </div>
                <div>
                    <button type="submit"
                            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-300">
                        Enviar Mensaje
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>