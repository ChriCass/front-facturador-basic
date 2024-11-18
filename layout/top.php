<?php
// Definir URL base
$base_url = 'http://localhost/front/'; // Cambia esto a tu URL base
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Panel de Reportes</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link
        href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap"
        rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script
        defer
        src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        /* El contenido estará oculto hasta que se valide la autenticación */
        #main-content {
            display: none;
        }

        /* Estilos personalizados para botones */
        .custom-button {
            background-color: #1d4ed8;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 0.875rem;
            transition: background-color 0.3s ease;
            cursor: pointer;
            text-align: center;
        }

        .custom-button:hover {
            background-color: #2563eb;
        }

        .custom-button-delete {
            background-color: #dc2626;
        }

        .custom-button-delete:hover {
            background-color: #ef4444;
        }
    </style>
</head>

<body class="bg-gray-100">
    <main id="main-content">
        <!-- Segundo Navbar (visible solo en tablet y pantallas pequeñas) -->
        <div class="lg:hidden" x-data="{ openMenu: false }">
            <div class="flex justify-between items-center p-4 bg-white shadow">
                <div>
                    <!-- Aquí puedes colocar el logo -->
                    <!-- Aquí puedes colocar el logo -->
                    <svg
                        width="50"
                        height="50"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 512 512">
                        <!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                        <path
                            d="M504.4 115.8a5.7 5.7 0 0 0 -.3-.7 8.5 8.5 0 0 0 -.5-1.3 6 6 0 0 0 -.5-.7 9.4 9.4 0 0 0 -.7-.9c-.2-.2-.5-.4-.8-.6a8.8 8.8 0 0 0 -.9-.7L404.4 55.6a8 8 0 0 0 -8 0L300.1 111h0a8.1 8.1 0 0 0 -.9 .7 7.7 7.7 0 0 0 -.8 .6 8.2 8.2 0 0 0 -.7 .9c-.2 .2-.4 .5-.5 .7a9.7 9.7 0 0 0 -.5 1.3c-.1 .2-.2 .4-.3 .7a8.1 8.1 0 0 0 -.3 2.1V223.2l-80.2 46.2V63.4a7.8 7.8 0 0 0 -.3-2.1c-.1-.2-.2-.5-.3-.7a8.4 8.4 0 0 0 -.5-1.2c-.1-.3-.4-.5-.5-.7a9.4 9.4 0 0 0 -.7-.9 9.5 9.5 0 0 0 -.8-.6 9.8 9.8 0 0 0 -.9-.7h0L115.6 1.1a8 8 0 0 0 -8 0L11.3 56.5h0a6.5 6.5 0 0 0 -.9 .7 7.8 7.8 0 0 0 -.8 .6 8.2 8.2 0 0 0 -.7 .9c-.2 .3-.4 .5-.6 .7a7.9 7.9 0 0 0 -.5 1.2 6.5 6.5 0 0 0 -.3 .7 8.2 8.2 0 0 0 -.3 2.1v329.7a8 8 0 0 0 4 7l192.5 110.8a8.8 8.8 0 0 0 1.3 .5c.2 .1 .4 .2 .6 .3a7.9 7.9 0 0 0 4.1 0c.2-.1 .4-.2 .6-.2a8.6 8.6 0 0 0 1.4-.6L404.4 400.1a8 8 0 0 0 4-7V287.9l92.2-53.1a8 8 0 0 0 4-7V117.9A8.6 8.6 0 0 0 504.4 115.8zM111.6 17.3h0l80.2 46.2-80.2 46.2L31.4 63.4zm88.3 60V278.6l-46.5 26.8-33.7 19.4V123.5l46.5-26.8zm0 412.8L23.4 388.5V77.3L57.1 96.7l46.5 26.8V338.7a6.9 6.9 0 0 0 .1 .9 8 8 0 0 0 .2 1.2h0a5.9 5.9 0 0 0 .4 .9 6.4 6.4 0 0 0 .4 1v0a8.5 8.5 0 0 0 .6 .8 7.6 7.6 0 0 0 .7 .8l0 0c.2 .2 .5 .4 .8 .6a8.9 8.9 0 0 0 .9 .7l0 0 0 0 92.2 52.2zm8-106.2-80.1-45.3 84.1-48.4 92.3-53.1 80.1 46.1-58.8 33.6zm184.5 4.6L215.9 490.1V397.8L346.6 323.2l45.8-26.2zm0-119.1L358.7 250l-46.5-26.8V131.8l33.7 19.4L392.4 178zm8-105.3-80.2-46.2 80.2-46.2 80.2 46.2zm8 105.3V178L455 151.2l33.7-19.4v91.4h0z" />
                    </svg>
                </div>
                <button
                    @click="openMenu = !openMenu"
                    class="text-gray-600 focus:outline-none">
                    <!-- Icono hamburguesa -->
                    <svg
                        x-show="!openMenu"
                        class="w-6 h-6"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>

            <!-- Menú desplegable a pantalla completa -->
            <div
                x-show="openMenu"
                class="fixed inset-0 bg-white z-50 flex flex-col justify-center items-center space-y-8"
                @click.away="openMenu = false">
                <!-- Botón X en la esquina superior derecha -->
                <button
                    @click="openMenu = false"
                    class="absolute top-4 right-4 text-gray-600 focus:outline-none">
                    <svg
                        class="w-8 h-8"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>

                <!-- Opciones del menú -->
                <a href="#" class="text-gray-600 text-xl hover:text-gray-900">Panel principal</a>
                <a href="companies.html" class="text-gray-600 text-xl hover:text-gray-900">Compañias</a>
                <a href="#" class="text-gray-600 text-xl hover:text-gray-900">Boletas</a>
                <a href="#" class="text-gray-600 text-xl hover:text-gray-900">Facturas</a>
                <a href="#" class="text-gray-600 text-xl hover:text-gray-900">Nota de credito</a>
                <a href="#" class="text-gray-600 text-xl hover:text-gray-900">Nota de debito</a>
                <div class="border-t border-gray-300 w-full"></div>
                <a href="#" class="text-gray-600 text-xl hover:text-gray-900">Perfil</a>
                <a href="#" id="logoutButton" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                    Finalizar sesión
                </a>

            </div>
        </div>

        <!-- Navbar (visible en desktop) -->
        <header class="bg-white shadow hidden lg:block">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 p-4">
                <div class="flex justify-between items-center">
                    <div class="flex items-center">
                        <div>
                            <!-- Aquí puedes colocar el logo -->
                            <!-- Aquí puedes colocar el logo -->
                            <svg
                                width="50"
                                height="50"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 512 512">
                                <!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                <path
                                    d="M504.4 115.8a5.7 5.7 0 0 0 -.3-.7 8.5 8.5 0 0 0 -.5-1.3 6 6 0 0 0 -.5-.7 9.4 9.4 0 0 0 -.7-.9c-.2-.2-.5-.4-.8-.6a8.8 8.8 0 0 0 -.9-.7L404.4 55.6a8 8 0 0 0 -8 0L300.1 111h0a8.1 8.1 0 0 0 -.9 .7 7.7 7.7 0 0 0 -.8 .6 8.2 8.2 0 0 0 -.7 .9c-.2 .2-.4 .5-.5 .7a9.7 9.7 0 0 0 -.5 1.3c-.1 .2-.2 .4-.3 .7a8.1 8.1 0 0 0 -.3 2.1V223.2l-80.2 46.2V63.4a7.8 7.8 0 0 0 -.3-2.1c-.1-.2-.2-.5-.3-.7a8.4 8.4 0 0 0 -.5-1.2c-.1-.3-.4-.5-.5-.7a9.4 9.4 0 0 0 -.7-.9 9.5 9.5 0 0 0 -.8-.6 9.8 9.8 0 0 0 -.9-.7h0L115.6 1.1a8 8 0 0 0 -8 0L11.3 56.5h0a6.5 6.5 0 0 0 -.9 .7 7.8 7.8 0 0 0 -.8 .6 8.2 8.2 0 0 0 -.7 .9c-.2 .3-.4 .5-.6 .7a7.9 7.9 0 0 0 -.5 1.2 6.5 6.5 0 0 0 -.3 .7 8.2 8.2 0 0 0 -.3 2.1v329.7a8 8 0 0 0 4 7l192.5 110.8a8.8 8.8 0 0 0 1.3 .5c.2 .1 .4 .2 .6 .3a7.9 7.9 0 0 0 4.1 0c.2-.1 .4-.2 .6-.2a8.6 8.6 0 0 0 1.4-.6L404.4 400.1a8 8 0 0 0 4-7V287.9l92.2-53.1a8 8 0 0 0 4-7V117.9A8.6 8.6 0 0 0 504.4 115.8zM111.6 17.3h0l80.2 46.2-80.2 46.2L31.4 63.4zm88.3 60V278.6l-46.5 26.8-33.7 19.4V123.5l46.5-26.8zm0 412.8L23.4 388.5V77.3L57.1 96.7l46.5 26.8V338.7a6.9 6.9 0 0 0 .1 .9 8 8 0 0 0 .2 1.2h0a5.9 5.9 0 0 0 .4 .9 6.4 6.4 0 0 0 .4 1v0a8.5 8.5 0 0 0 .6 .8 7.6 7.6 0 0 0 .7 .8l0 0c.2 .2 .5 .4 .8 .6a8.9 8.9 0 0 0 .9 .7l0 0 0 0 92.2 52.2zm8-106.2-80.1-45.3 84.1-48.4 92.3-53.1 80.1 46.1-58.8 33.6zm184.5 4.6L215.9 490.1V397.8L346.6 323.2l45.8-26.2zm0-119.1L358.7 250l-46.5-26.8V131.8l33.7 19.4L392.4 178zm8-105.3-80.2-46.2 80.2-46.2 80.2 46.2zm8 105.3V178L455 151.2l33.7-19.4v91.4h0z" />
                            </svg>
                        </div>

                        <nav class="ml-8 space-x-6 flex">
                            <a
                                href="<?php echo $base_url; ?>dashboard.php"
                                class="text-gray-600 hover:text-gray-900">Panel principal</a>
                            <a
                                href="<?php echo $base_url; ?>companies.php"
                                class="text-gray-600 hover:text-gray-900">Compañias</a>


                        </nav>
                    </div>

                    <div x-data="{ open: false }" class="relative">
                        <button
                            @click="open = !open"
                            class="text-gray-600 focus:outline-none">
                            <span id="userName">Opciones</span> <!-- ID para el nombre del usuario -->
                            <svg
                                class="inline w-4 h-4"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <div
                            x-show="open"
                            @click.away="open = false"
                            class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-md shadow-lg">
                            <a
                                href="#"
                                class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Perfil</a>
                            <div class="border-t border-gray-200"></div>
                            <a
                                href="#"
                                class="block px-4 py-2 text-gray-700 hover:bg-gray-100" id="logoutButton">Finalizar sesión</a>
                        </div>
                    </div>
                </div>
            </div>
        </header>

 