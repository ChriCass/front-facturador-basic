<?php include 'layout/top.php'; ?>
 <!-- Encabezado "Panel" -->
 <div class="bg-white mt-0 p-4">
     <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
         <h1 class="text-3xl font-semibold text-gray-800">crear nueva compañia</h1>
     </div>
 </div>

 <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
     <div class="mt-8 rounded-md bg-white shadow p-5">
         <div id="alertBox" class="hidden fixed top-4 right-4 max-w-sm w-full bg-white shadow-lg rounded-lg p-4">
             <div class="flex items-start">
                 <div id="alertIcon" class="w-6 h-6 mr-3"></div>
                 <div>
                     <h3 id="alertTitle" class="text-lg font-semibold"></h3>
                     <p id="alertMessage" class="text-sm text-gray-600 mt-2"></p>
                 </div>
                 <button id="closeAlert" class="ml-auto text-gray-500 hover:text-gray-900">
                     <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                     </svg>
                 </button>
             </div>
         </div>

         <!-- Formulario de Registro de Compañía -->
         <!-- Formulario de Registro de Compañía -->
         <form id="companyForm" enctype="multipart/form-data">
             <!-- Campos del formulario -->
             <div class="mb-4">
                 <label for="razon_social" class="block text-gray-700">Razón Social</label>
                 <input type="text" name="razon_social" id="razon_social" required class="w-full mb-3 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
             </div>

             <div class="mb-4">
                 <label for="ruc" class="block text-gray-700">RUC</label>
                 <input type="text" name="ruc" id="ruc" required class="w-full mb-3 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
             </div>

             <div class="mb-4">
                 <label for="direccion" class="block text-gray-700">Dirección</label>
                 <input type="text" name="direccion" id="direccion" required class="w-full mb-3 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
             </div>

             <!-- Campo Logo (opcional) -->
             <div class="mb-4">
                 <label for="logo" class="block text-gray-700">Logo (opcional)</label>
                 <input type="file" name="logo" id="logo" class="w-full mb-3 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
             </div>

             <div class="mb-4">
                 <label for="sol_user" class="block text-gray-700">Usuario SOL</label>
                 <input type="text" name="sol_user" id="sol_user" required class="w-full mb-3 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
             </div>

             <div class="mb-4">
                 <label for="sol_pass" class="block text-gray-700">Contraseña SOL</label>
                 <input type="password" name="sol_pass" id="sol_pass" required class="w-full mb-3 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
             </div>

             <!-- Campo Certificado (Archivo) -->
             <div class="mb-4">
                 <label for="cert" class="block text-gray-700">Certificado (Archivo .pem/.txt)</label>
                 <input type="file" name="cert" id="cert" accept=".pem,.txt" required class="w-full mb-3 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
             </div>

             <!-- Campo Client ID (Opcional) -->
             <div class="mb-4">
                 <label for="client_id" class="block text-gray-700">Client ID (opcional)</label>
                 <input type="text" name="client_id" id="client_id" class="w-full mb-3 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500" placeholder="Opcional">
             </div>

             <!-- Campo Client Secret (Opcional) -->
             <div class="mb-4">
                 <label for="client_secret" class="block text-gray-700">Client Secret (opcional)</label>
                 <input type="text" name="client_secret" id="client_secret" class="w-full mb-3 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500" placeholder="Opcional">
             </div>

             <!-- Campo Producción -->
             <div class="mb-4 flex items-center">
                 <input type="checkbox" name="production" id="production" class="mr-2">
                 <label for="production" class="text-gray-700">¿Producción?</label>
             </div>

             <!-- Botón de Envío -->
             <div class="flex justify-between items-center">
                 <button type="submit" class="bg-teal-500 text-white py-2 px-4 rounded-md hover:bg-teal-600 focus:outline-none focus:ring-2 focus:ring-teal-500">
                     Guardar Compañía
                 </button>
             </div>
         </form>
     </div>
 </div>


 <?php include 'layout/bottom.php'; ?>