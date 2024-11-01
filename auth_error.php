<?php
// Definir URL base
$base_url = 'http://localhost/front/'; // Cambia esto a tu URL base
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Error de Autenticación</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="flex items-center justify-center h-screen">
        <div class="max-w-lg w-full bg-white shadow-lg rounded-lg p-8">
            <div class="flex justify-center mb-4">
                <svg class="w-16 h-16 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M6.938 5h10.124a2 2 0 011.788 1.105l3.982 7.965a2 2 0 010 1.86l-3.982 7.965A2 2 0 0117.062 21H6.938a2 2 0 01-1.788-1.105L1.168 11.93a2 2 0 010-1.86L5.15 2.105A2 2 0 016.938 1z"></path>
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-center text-gray-800">Error de Autenticación</h1>
            <p class="text-center text-gray-600 mt-4">
                No tienes permiso para ver este contenido. Por favor, prueba iniciando sesión.
            </p>
            <div class="flex justify-center mt-6">
                <a href="<?php echo $base_url; ?>" class="px-4 py-2 bg-teal-500 text-white rounded-md hover:bg-teal-600 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2">
                    Iniciar sesión
                </a>
            </div>
        </div>
    </div>
</body>
</html>
