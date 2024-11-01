<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex justify-center items-center h-screen">
    <div class="max-w-md w-full bg-white p-8 rounded-lg shadow-lg">
        <!-- Título del formulario -->
        <h1 class="text-2xl font-semibold text-gray-800 text-center mb-6">Registro de Usuario</h1>

        <!-- Formulario -->
        <form id="registerForm">
            <!-- Campo Nombre -->
            <div class="mb-4">
                <label for="name" class="block text-gray-700">Nombre</label>
                <input type="text" name="name" id="name" required class="w-full mb-3 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
            </div>

            <!-- Campo Correo Electrónico -->
            <div class="mb-4">
                <label for="email" class="block text-gray-700">Correo Electrónico</label>
                <input type="email" name="email" id="email" required class="w-full mb-3 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
            </div>

            <!-- Campo Contraseña -->
            <div class="mb-4">
                <label for="password" class="block text-gray-700">Contraseña</label>
                <input type="password" name="password" id="password" required class="w-full mb-3 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
            </div>

            <!-- Campo Confirmar Contraseña -->
            <div class="mb-4">
                <label for="password_confirmation" class="block text-gray-700">Confirmar Contraseña</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required class="w-full mb-3 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
            </div>

            <!-- Botón -->
            <div class="flex justify-center items-center">
                <button type="submit" class="bg-teal-500 text-white py-2 px-4 rounded-md hover:bg-teal-600 focus:outline-none focus:ring-2 focus:ring-teal-500">
                    Registrarse
                </button>
            </div>
        </form>

        <!-- Alerta -->
        <div id="alert" class="hidden mt-4 p-4 text-white text-center rounded-md"></div>
    </div>

    <script src="./js/auth.js"></script>
</body>
</html>
