<?php
$host = 'sql308.infinityfree.com';
$dbname = 'if0_39583760_db_libreria';
$username = 'if0_39583760';
$password = 'evanghel262001';

$resultados = []; 
$errorMessage = null; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);


    $sql = "SELECT titulo as Titulo, tipo as Tipo, precio as Precio FROM titulos";
    $stmt = $pdo->query($sql);

    $resultados = $stmt->fetchAll();

    foreach ($resultados as &$book) {
        if (!empty($book['autores_json'])) {
            $autores_raw = explode(';', $book['autores_json']);
            $autores_parsed = [];
            foreach ($autores_raw as $author_json_str) {
                $autores_parsed[] = json_decode($author_json_str, true);
            }
            $authorNames = array_map(function($author) {
                return htmlspecialchars($author['nombre'] ?? '') . ' ' . htmlspecialchars($author['apellido'] ?? '');
            }, $autores_parsed);
            $book['Autor(es)'] = implode(', ', $authorNames);
        } else {
            $book['Autor(es)'] = 'Desconocido';
        }
        unset($book['autores_json']);
    }

} catch (PDOException $e) {
    $errorMessage = "Error: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Libros</title>
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
            <h1 class="text-3xl sm:text-4xl font-bold text-center">Listado de Libros</h1>
            <nav class="mt-4 text-center">
                <a href="libros.php" class="inline-block bg-blue-700 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded-full mx-2 transition duration-300">Libros</a>
                <a href="autores.php" class="inline-block bg-blue-700 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded-full mx-2 transition duration-300">Autores</a>
                <a href="contacto.php" class="inline-block bg-blue-700 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded-full mx-2 transition duration-300">Contacto</a>
            </nav>
        </header>

        <div class="bg-white p-6 rounded-lg shadow-md overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <?php if ($resultados): ?>
                            <?php
                            $columnOrder = ['Titulo', 'Autor(es)', 'Tipo', 'Publicador', 'Precio'];
                            $headerClasses = "px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider";
                            ?>
                            <?php foreach ($columnOrder as $index => $colName): ?>
                                <th scope="col" class="<?php
                                    echo $headerClasses;
                                    if ($index === 0) echo ' rounded-tl-lg';
                                    if ($index === count($columnOrder) - 1) echo ' rounded-tr-lg';
                                ?>"><?php echo htmlspecialchars($colName); ?></th>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php if (isset($errorMessage)): ?>
                        <tr>
                            <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-red-500 text-center"><?php echo $errorMessage; ?></td>
                        </tr>
                    <?php elseif (empty($resultados)): ?>
                        <tr>
                            <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">No se encontraron libros.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($resultados as $fila): ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?php echo htmlspecialchars($fila['Titulo'] ?? 'N/A'); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo htmlspecialchars($fila['Autor(es)'] ?? 'N/A'); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo htmlspecialchars($fila['Tipo'] ?? 'N/A'); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo htmlspecialchars($fila['Publicador'] ?? 'N/A'); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">$<?php echo htmlspecialchars(number_format($fila['Precio'] ?? 0, 2)); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>