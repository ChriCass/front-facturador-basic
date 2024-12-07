<?php include 'layout/top.php'; ?>
<!-- Encabezado "Panel" -->
<div class="bg-white mt-0 p-4">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h1 class="text-3xl font-semibold text-gray-800">Panel</h1>
    </div>
</div>

<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <!-- Alerta responsive fuera del panel -->
    <div class="container mx-auto mt-3 px-4 sm:px-0">
        <div
            x-data="{ open: true }"
            x-show="open"
            class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-0 sm:text-sm lg:text-base"
            role="alert">
            <span class="block sm:inline">¡Bienvenido! Estamos encantados de tenerte!</span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                <button @click="open = false">
                    <svg
                        class="fill-current h-6 w-6 text-green-500"
                        role="button"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">
                        <title>Cerrar</title>
                        <path
                            d="M14.348 14.849a.5.5 0 11-.707.707l-3.182-3.182-3.182 3.182a.5.5 0 01-.707-.707l3.182-3.182-3.182-3.182a.5.5 0 01.707-.707l3.182 3.182 3.182 3.182z" />
                    </svg>
                </button>
            </span>
        </div>
    </div>

    <!-- Reportes -->
    <div class="mt-8 rounded-md bg-white shadow p-5">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-teal-600">Emisiones disponibles:</h1>
        </div>
        <div class="flex flex-wrap -mx-4">
            <!-- Tarjeta Reporte Caja por Mes -->
            <div class="w-full   px-4 mb-6">
                <div
                    class="bg-white shadow-md rounded-lg p-4 border border-teal-500 hover:bg-teal-50">
                    <a href="<?php echo $base_url; ?>boleta_factura_form.php" class="block">
                        <div class="flex items-center space-x-4">
                            <div
                                class="bg-teal-500 text-white p-2 rounded-full">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    style="
                                                fill: rgba(0, 0, 0, 1);
                                                transform: ;
                                                msfilter: ;
                                            ">
                                    <path
                                        d="M6.012 18H21V4a2 2 0 0 0-2-2H6c-1.206 0-3 .799-3 3v14c0 2.201 1.794 3 3 3h15v-2H6.012C5.55 19.988 5 19.805 5 19s.55-.988 1.012-1zM8 6h9v2H8V6z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3
                                    class="text-lg font-semibold text-gray-700">
                                    emitir factura/boleta
                                </h3>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

  
            <div class="w-full  px-4 mb-6">
                <div
                    class="bg-white shadow-md rounded-lg p-4 border border-teal-500 hover:bg-teal-50">
                    <a href="<?php echo $base_url; ?>nota_deb_cred.php" class="block">
                        <div class="flex items-center space-x-4">
                            <div
                                class="bg-teal-500 text-white p-2 rounded-full">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    style="
                                                fill: rgba(0, 0, 0, 1);
                                                transform: ;
                                                msfilter: ;
                                            ">
                                    <path
                                        d="M6.012 18H21V4a2 2 0 0 0-2-2H6c-1.206 0-3 .799-3 3v14c0 2.201 1.794 3 3 3h15v-2H6.012C5.55 19.988 5 19.805 5 19s.55-.988 1.012-1zM8 6h9v2H8V6z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3
                                    class="text-lg font-semibold text-gray-700">
                                    emitir nota de crédito/debito
                                </h3>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

          
        </div>
    </div>
</div>

<?php include 'layout/bottom.php'; ?>