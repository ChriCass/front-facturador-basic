 
    <?php include 'layout/top.php'; ?>    
        <div class="bg-white mt-0 p-4">
              <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                  <h1 class="text-3xl font-semibold text-gray-800">Compañias</h1>
              </div>
          </div>
  
          <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
         
              <!-- Reportes -->
              <div class="mt-8 rounded-md bg-white shadow p-5">
                <div class="mb-4">
                    <a href="<?php echo $base_url; ?>registrar_companies.php" class="bg-teal-500 text-white px-4 py-2 rounded-md hover:bg-green-600">
                        Registrar Compañía
                    </a>
                </div>
                  <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-300">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border-b">Id</th>
                                <th class="py-2 px-4 border-b">Razón Social</th>
                                <th class="py-2 px-4 border-b">RUC</th>
                                <th class="py-2 px-4 border-b">Dirección</th>
                                <th class="py-2 px-4 border-b">Certificado</th>
                                <th class="py-2 px-4 border-b">Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="companiesTableBody" class="text-gray-600">
                            <!-- Aquí se agregarán dinámicamente las filas -->
                        </tbody>
                    </table>
                  </div>
                  
           
              </div>
          </div>

<!-- Modal de Confirmación -->
<div id="confirmationModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center hidden">
    <div class="bg-white rounded-lg p-6 w-96">
        <h2 class="text-xl font-semibold text-gray-800">Advertencia</h2>
        <p class="mt-4 text-gray-600" id="modalText">
            ¿Estás seguro de que deseas eliminar la compañía <span id="companyName"></span> con el RUC <span id="companyRUC"></span>?
        </p>
        <div class="mt-4 flex justify-end gap-4">
            <button id="cancelButton" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">Cancelar</button>
            <button id="confirmDeleteButton" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">Eliminar Ahora</button>
        </div>
    </div>
</div>
<!-- Alerta de éxito/error -->
<div id="alertBox" class="fixed top-4 right-4 max-w-sm w-full shadow-lg rounded-lg p-4 hidden">
    <div class="flex items-center" id="alertIcon"></div>
    <p id="alertMessage" class="ml-3"></p>
</div>

          <?php include 'layout/bottom.php'; ?>