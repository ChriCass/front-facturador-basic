document.addEventListener('DOMContentLoaded', () => {
    const generateXmlBtnN = document.querySelector('#generateXmlBtnN');
    const alertBox = document.getElementById('alertBox');
    const alertTitle = document.getElementById('alertTitle');
    const alertMessage = document.getElementById('alertMessage');
    const alertIcon = document.getElementById('alertIcon');
    const closeAlert = document.getElementById('closeAlert');

      // Mostrar alertas con botón de "Revisar Respuesta"
      const showAlert = (type, title, message, showReviewButton = false, response = null) => {
        const alertClass = type === 'success' ? 'bg-green-100 text-green-500' : 'bg-red-100 text-red-500';
        alertBox.className = `fixed top-4 right-4 max-w-sm w-full shadow-lg rounded-lg p-4 ${alertClass}`;
        alertIcon.innerHTML = type === 'success'
            ? `<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
               </svg>`
            : `<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
               </svg>`;
        alertTitle.innerText = title;
        alertMessage.innerText = message;
        
        // Limpiar cualquier botón anterior
        const previousButton = alertBox.querySelector('#reviewResponseButton');
        if (previousButton) {
            previousButton.remove();
        }

        // Si se debe mostrar el botón para revisar la respuesta
        if (showReviewButton && response) {
            const reviewButton = document.createElement('button');
            reviewButton.id = 'reviewResponseButton';
            reviewButton.className = 'ml-4 px-3 py-1 bg-teal-600 text-white rounded hover:bg-teal-700 focus:outline-none';
            reviewButton.innerText = 'Revisar Respuesta';
            reviewButton.addEventListener('click', () => {
                if (response) {
                    showModal(response); // Mostrar el modal solo si hay una respuesta válida
                }
            });
            alertBox.appendChild(reviewButton);
        }
        alertBox.classList.remove('hidden');
        setTimeout(() => alertBox.classList.add('hidden'), 10000);
    };


  // Función para generar el nombre del archivo XML
const generateFileName = (razonSocial, ruc) => {
    const date = new Date().toISOString().split('T')[0]; // Fecha en formato YYYY-MM-DD
    const namePart = razonSocial.slice(0, 2).toUpperCase(); // Primeras dos letras de la razón social en mayúsculas
    const rucPart = ruc.slice(-4); // Últimos cuatro dígitos del RUC
    return `${namePart}_${date}_${rucPart}.xml`;
};

// Descargar archivo XML automáticamente, ahora usando el nombre personalizado
const downloadFile = (filename, content) => {
    const element = document.createElement('a');
    element.setAttribute('href', 'data:text/xml;charset=utf-8,' + encodeURIComponent(content));
    element.setAttribute('download', filename);

    document.body.appendChild(element);
    element.click();
    document.body.removeChild(element);
};

    // Cerrar alerta manualmente
    closeAlert.addEventListener('click', () => {
        alertBox.classList.add('hidden');
    });

    generateXmlBtnN.addEventListener('click', async () => {
        const razonSocial = document.getElementById('companyRazonSocial').value;
        const ruc = document.getElementById('companyRuc').value;
        const filename = generateFileName(razonSocial, ruc);
    
        const token = localStorage.getItem('accessToken');
        if (!token) {
            showAlert('error', 'Error de Autenticación', 'Token de acceso no encontrado.');
            return;
        }

        const data = {
            ublVersion: document.getElementById('ublVersion').value,
           
            tipoDoc: document.getElementById('tipoDoc').value,
            serie: document.getElementById('serie').value,
            correlativo: document.getElementById('correlativo').value,
            fechaEmision: document.getElementById('fechaEmision').value,
            formaPago: document.getElementById('formaPago').value,
            tipoMoneda: document.getElementById('tipoMoneda').value,
            company: {
                ruc: document.getElementById('companyRuc').value,
                razonSocial: document.getElementById('companyRazonSocial').value,
                nombreComercial: document.getElementById('companyNombreComercial').value,
                address: {
                    ubigeo: document.getElementById('companyUbigeo').value,
                    departamento: document.getElementById('companyDepartamento').value,
                    provincia: document.getElementById('companyProvincia').value,
                    distrito: document.getElementById('companyDistrito').value,
                    codLocal: document.getElementById('companyCodigoLocal').value,
                },
            },
            client: {
                tipoDoc: document.getElementById('clientTipoDoc').value,
                numDoc: document.getElementById('clientNumDoc').value,
                rznSocial: document.getElementById('clientRazonSocial').value,
            },
            details: [{
                codProducto: document.getElementById('prodCodigo').value,
                unidad: document.getElementById('prodUnidad').value,
                cantidad: parseInt(document.getElementById('prodCantidad').value),
                mtoValorUnitario: parseFloat(document.getElementById('prodMtoValorUnitario').value),
                descripcion: "Descripción del producto",
                mtoBaseIgv: parseFloat(document.getElementById('mtoIGV').value),
                porcentajeIgv: 18,
                igv: parseFloat(document.getElementById('mtoIGV').value),
                mtoValorVenta: parseFloat(document.getElementById('valorVenta').value),
            }],
            mtoOperGravadas: parseFloat(document.getElementById('mtoOperGravadas').value),
            mtoIGV: parseFloat(document.getElementById('mtoIGV').value),
            valorVenta: parseFloat(document.getElementById('valorVenta').value),
            subTotal: parseFloat(document.getElementById('subTotal').value),
            mtoImpVenta: parseFloat(document.getElementById('mtoImpVenta').value),
            legends: [{
                code: document.getElementById('legendCode').value,
                value: document.getElementById('legendValue').value,
            }]
        };
    
        try {
            showAlert('warning', 'Preparando Descarga', 'Generando XML, por favor espere...');

            const response = await fetch('http://127.0.0.1:8000/api/notes/xml', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${token}`,
                },
                body: JSON.stringify(data),
            });

            const result = await response.json();

            if (response.ok && result.xml) {
                downloadFile(filename, result.xml);
                showAlert('success', 'Descarga Completa', 'El archivo XML ha sido descargado exitosamente.');
            } else {
                const errorMessage = result.message || 'Error al generar el XML.';
                showAlert('error', 'Error al Generar XML', errorMessage, true, result);
            }
        } catch (error) {
            showAlert('error', 'Error de Conexión', error.message || 'No se pudo conectar con el servidor.', true, error);
        }
    });
});
