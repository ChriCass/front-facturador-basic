<?php include 'layout/top.php'; ?>

<!-- Encabezado "Panel" -->
<div class="bg-white mt-0 p-4">
  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <h1 class="text-3xl font-semibold text-gray-800">
      Emitir Nota de credito/debito
    </h1>
  </div>
</div>
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
  <div class="mt-8 rounded-md bg-white shadow-lg p-8">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <!-- Botón 1: Abrir Formulario de Emisión -->
      <button
        id="abrirFormularioBtn"
        class="w-full bg-teal-500 text-white py-4 px-6 rounded-md shadow-lg hover:bg-teal-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-400 flex items-center justify-center space-x-3">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="h-6 w-6"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor">
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M9 12h6M9 12H5m4 0h10M12 5v14M5 12a7 7 0 1114 0 7 7 0 01-14 0z" />
        </svg>
        <span>Abrir Formulario de Emisión</span>
      </button>

      <!-- Botón 2: Generar XML -->
      <!-- Botón 2: Generar XML -->
      <button
        id="generateXmlBtnN"
        disabled
        class="w-full bg-indigo-500 text-white py-4 px-6 rounded-md shadow-lg hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-400 flex items-center justify-center space-x-3 disabled:opacity-50 disabled:cursor-not-allowed">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="h-6 w-6"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor">
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M17 9V7a4 4 0 00-8 0v2m-2 0a6 6 0 0112 0v2a6 6 0 01-12 0v-2m6 8h.01" />
        </svg>
        <span>Generar XML</span>
      </button>

      <!-- Botón 3: Generar PDF -->
      <button
        id="generatePdfBtnN"
        disabled
        class="w-full bg-red-500 text-white py-4 px-6 rounded-md shadow-lg hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-400 flex items-center justify-center space-x-3 disabled:opacity-50 disabled:cursor-not-allowed">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="h-6 w-6"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor">
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M8 16l4-4-4-4m8 0v8" />
        </svg>
        <span>Generar PDF</span>
      </button>
    </div>
  </div>
</div>

<!-- Alerta de éxito o error (inicialmente oculta) -->

<div id="container" class="max-w-7xl mx-auto sm:px-6 lg:px-8">
  <div class="mt-8 rounded-md bg-white shadow p-5">
    <form id="notesForm">
    <div id="responseModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-lg shadow-lg max-w-md w-full p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Respuesta de SUNAT</h2>
        <div id="modalContent" class="text-sm text-gray-700 mb-4"></div>
        <button
            id="closeModal"
            class="px-4 py-2 text-white bg-teal-600 rounded-md hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
            Cerrar
        </button>
    </div>
</div>
      <div
        id="alertBox"
        class="hidden fixed top-4 right-4 max-w-sm w-full bg-white shadow-lg rounded-lg p-4">
        <div class="flex items-start">
          <div id="alertIcon" class="w-6 h-6 mr-3"></div>
          <div>
            <h3 id="alertTitle" class="text-lg font-semibold"></h3>
            <p id="alertMessage" class="text-sm text-gray-600 mt-2"></p>
          </div>
          <button
            id="closeAlert"
            class="ml-auto text-gray-500 hover:text-gray-900">
            <svg
              class="w-5 h-5"
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
        </div>
      </div>
      <!-- UBL Version y Tipo Operación -->
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
        <div>
          <label class="block text-gray-700">UBL Version</label>
          <input
            type="text"
            id="ublVersion"
            value="2.1"
            class="w-full mb-3 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500" />
        </div>
    
      </div>

      <!-- Tipo Documento, Serie y Correlativo -->
      <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
        <div>
          <label class="block text-gray-700">Tipo de Documento</label>
          <input
            type="text"
            id="tipoDoc"
            value="07"
            class="w-full mb-3 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500" />
        </div>
        <div>
          <label class="block text-gray-700">Serie</label>
          <input
            type="text"
            id="serie"
            value="FC01"
            class="w-full mb-3 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500" />
        </div>
        <div>
          <label class="block text-gray-700">Correlativo</label>
          <input
            type="text"
            id="correlativo"
            value="1"
            class="w-full mb-3 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500" />
        </div>
      </div>

      <!-- Fecha Emisión, Forma Pago y Tipo Moneda -->
      <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
        <div>
          <label class="block text-gray-700">Fecha de Emisión</label>
          <input
            type="text"
            id="fechaEmision"
            value="2023-07-25T00:00:00-05:00"
            class="w-full mb-3 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500" />
        </div>
        <div>
          <label class="block text-gray-700">Tipo de documento afectado</label>
          <input
            type="text"
            id="tipDocAfectado"
            value="01"
            class="w-full mb-3 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500" />
        </div>
        <div>
          <label class="block text-gray-700">Numero de documento afectado</label>
          <input
            type="text"
            id="numDocfectado"
            value="F001-12"
            class="w-full mb-3 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500" />
        </div>
        <div>
          <label class="block text-gray-700">Codigo de motivo</label>
          <input
            type="text"
            id="codMotivo"
            value="01"
            class="w-full mb-3 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500" />
        </div>
        <div>
          <label class="block text-gray-700">Descripcion de motivo</label>
          <input
            type="text"
            id="desMotivo"
            value="ANULACION DE LA OPERACION"
            class="w-full mb-3 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500" />
        </div>
        <div>
          <label class="block text-gray-700">Forma de Pago</label>
          <input
            type="text"
            id="formaPago"
            value="Contado"
            class="w-full mb-3 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500" />
        </div>
        <div>
          <label class="block text-gray-700">Tipo de Moneda</label>
          <input
            type="text"
            id="tipoMoneda"
            value="PEN"
            class="w-full mb-3 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500" />
        </div>
      </div>

      <!-- Empresa: Datos de la Compañía -->
      <h2 class="text-xl font-bold mb-4 text-gray-800">
        Datos de la Compañía
      </h2>
      <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
        <div>
          <label class="block text-gray-700">RUC</label>
          <input
            type="text"
            id="companyRuc"
            value="20609278235"
            class="w-full mb-3 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500" />
        </div>
        <div>
          <label class="block text-gray-700">Razón Social</label>
          <input
            type="text"
            id="companyRazonSocial"
            value="Coders Free S.A.C"
            class="w-full mb-3 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500" />
        </div>
        <div>
          <label class="block text-gray-700">Nombre Comercial</label>
          <input
            type="text"
            id="companyNombreComercial"
            value="Coders Free "
            class="w-full mb-3 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500" />
        </div>
      </div>

      <!-- Dirección de la Compañía -->
      <div class="grid grid-cols-1 sm:grid-cols-5 gap-4 mb-6">
        <div>
          <label class="block text-gray-700">Ubigeo</label>
          <input
            type="text"
            id="companyUbigeo"
            value="150101"
            class="w-full mb-3 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500" />
        </div>
        <div>
          <label class="block text-gray-700">Departamento</label>
          <input
            type="text"
            id="companyDepartamento"
            value="LIMA"
            class="w-full mb-3 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500" />
        </div>
        <div>
          <label class="block text-gray-700">Provincia</label>
          <input
            type="text"
            id="companyProvincia"
            value="LIMA"
            class="w-full mb-3 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500" />
        </div>
        <div>
          <label class="block text-gray-700">Distrito</label>
          <input
            type="text"
            id="companyDistrito"
            value="LIMA"
            class="w-full mb-3 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500" />
        </div>
        <div>
          <label class="block text-gray-700">Código Local</label>
          <input
            type="text"
            id="companyCodigoLocal"
            value="0000"
            class="w-full mb-3 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500" />
        </div>
        <div>
          <label class="block text-gray-700">Direccion</label>
          <input
            type="text"
            id="direccion"
            value="Av. Villa Nueva 221"
            class="w-full mb-3 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500" />
        </div>
      </div>

      <!-- Datos del Cliente -->
      <h2 class="text-xl font-bold mb-4 text-gray-800">
        Datos del Cliente
      </h2>
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
        <div>
          <label class="block text-gray-700">Tipo de Documento</label>
          <input
            type="text"
            id="clientTipoDoc"
            value="6"
            class="w-full mb-3 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500" />
        </div>
        <div>
          <label class="block text-gray-700">Número de Documento</label>
          <input
            type="text"
            id="clientNumDoc"
            value="20000000001"
            class="w-full mb-3 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500" />
        </div>
        <div class="col-span-2">
          <label class="block text-gray-700">Razón Social</label>
          <input
            type="text"
            id="clientRazonSocial"
            value="EMPRESA X"
            class="w-full mb-3 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500" />
        </div>
      </div>

      <!-- Totales -->
      <h2 class="text-xl font-bold mb-4 text-gray-800">Totales</h2>
      <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
        <div>
          <label class="block text-gray-700">Monto Operaciones Gravadas</label>
          <input
            type="text"
            id="mtoOperGravadas"
            value="100"
            class="w-full mb-3 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500" />
        </div>
        <div>
          <label class="block text-gray-700">Monto IGV</label>
          <input
            type="text"
            id="mtoIGV"
            value="18"
            class="w-full mb-3 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500" />
        </div>
        <div>
          <label class="block text-gray-700">Total de impuestos</label>
          <input
            type="text"
            id="total_impuestos"
            value="18"
            class="w-full mb-3 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500" />
        </div>
      
        <div>
          <label class="block text-gray-700">Valor Venta</label>
          <input
            type="text"
            id="valorVenta"
            value="100"
            class="w-full mb-3 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500" />
        </div>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
        <div>
          <label class="block text-gray-700">SubTotal</label>
          <input
            type="text"
            id="subTotal"
            value="118"
            class="w-full mb-3 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500" />
        </div>
        <div>
          <label class="block text-gray-700">Monto Impuesto Venta</label>
          <input
            type="text"
            id="mtoImpVenta"
            value="118"
            class="w-full mb-3 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500" />
        </div>
      </div>

      <!-- Detalles del Producto -->
      <h2 class="text-xl font-bold mb-4 text-gray-800">
        Detalles del Producto
      </h2>
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
      <div>
          <label class="block text-gray-700">Tipo afe. igv</label>
          <input
            type="text"
            id="tipAfeIgv"
            value="10"
            class="w-full mb-3 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500" />
        </div>
        <div>
          <label class="block text-gray-700">Código Producto</label>
          <input
            type="text"
            id="prodCodigo"
            value="P001"
            class="w-full mb-3 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500" />
        </div>
        <div>
          <label class="block text-gray-700">Unidad</label>
          <input
            type="text"
            id="prodUnidad"
            value="NIU"
            class="w-full mb-3 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500" />
        </div>
        <div>
          <label class="block text-gray-700">Descripcion</label>
          <input
            type="text"
            id="descripcion"
            value="PRODUCTO 1"
            class="w-full mb-3 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500" />
        </div>
        <div>
          <label class="block text-gray-700">Cantidad</label>
          <input
            type="number"
            id="prodCantidad"
            value="2"
            class="w-full mb-3 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500" />
        </div>
        <div>
          <label class="block text-gray-700">Monto Valor Unitario</label>
          <input
            type="text"
            id="prodMtoValorUnitario"
            value="50"
            class="w-full mb-3 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500" />
        </div>
        <div>
          <label class="block text-gray-700">Monto Valor de venta</label>
          <input
            type="text"
            id="mtoValorVenta"
            value="100"
            class="w-full mb-3 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500" />
        </div>
        <div>
          <label class="block text-gray-700">Monto Base Igv</label>
          <input
            type="text"
            id="mtoBaseIgv"
            value="100"
            class="w-full mb-3 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500" />
        </div>
        <div>
          <label class="block text-gray-700">Porcentaje Igv</label>
          <input
            type="text"
            id="porcentajeIgv"
            value="18"
            class="w-full mb-3 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500" />
        </div>
        <div>
          <label class="block text-gray-700"> Igv</label>
          <input
            type="text"
            id="Igv"
            value="18"
            class="w-full mb-3 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500" />
        </div>
        <div>
          <label class="block text-gray-700">Total Impuesto</label>
          <input
            type="text"
            id="totalImpuestos"
            value="18"
            class="w-full mb-3 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500" />
        </div>
        <div>
          <label class="block text-gray-700">monto precio unitario</label>
          <input
            type="text"
            id="mtoPrecioUnitario"
            value="59"
            class="w-full mb-3 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500" />
        </div>
      </div>

      <!-- Leyenda -->
      <h2 class="text-xl font-bold mb-4 text-gray-800">Leyenda</h2>
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
        <div>
          <label class="block text-gray-700">Código</label>
          <input
            type="text"
            id="legendCode"
            value="1000"
            class="w-full mb-3 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500" />
        </div>
        <div>
          <label class="block text-gray-700">Valor</label>
          <input
            type="text"
            id="legendValue"
            value="SON DOSCIENTOS TREINTA Y SEIS CON 00/100 SOLES"
            class="w-full mb-3 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500" />
        </div>
      </div>
      <button
        type="submit"
        class="px-4 font-bold py-2 text-white bg-teal-600 rounded-md hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
        enviar a sunat
      </button>
    </form>
  </div>
</div>

<?php include 'layout/bottom.php'; ?>