<!DOCTYPE html>
<html lang="es">
<head>
<?php
require "connection.php";


?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Libros</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
        }
        .container {
            max-width: 1200px;
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="container mx-auto p-4 sm:p-6 lg:p-8">
        <header class="bg-blue-600 text-white p-6 rounded-lg shadow-md mb-8">
            <h1 class="text-3xl sm:text-4xl font-bold text-center">Nuestro Catálogo de Libros</h1>
            <p class="text-center mt-2 text-blue-100">Explora nuestra colección de títulos.</p>
            <nav class="mt-4 text-center">
                <a href="libros.php" class="inline-block bg-blue-700 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded-full mx-2 transition duration-300">Libros</a>
                <a href="autores.php" class="inline-block bg-blue-700 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded-full mx-2 transition duration-300">Autores</a>
                <a href="contacto.php" class="inline-block bg-blue-700 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded-full mx-2 transition duration-300">Contacto</a>
            </nav>
        </header>
    </div>
   
</body>
</html>