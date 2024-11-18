document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('notesForm');
    const alertBox = document.getElementById('alertBox');
    const alertTitle = document.getElementById('alertTitle');
    const alertMessage = document.getElementById('alertMessage');
    const alertIcon = document.getElementById('alertIcon');
    const closeAlert = document.getElementById('closeAlert');
    
    // Elementos del modal
    const modal = document.getElementById('responseModal');
    const modalContent = document.getElementById('modalContent');
    const closeModalButton = document.getElementById('closeModal');

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

 // Mostrar el modal con la información de la API
// Mostrar el modal con la información de la API
const showModal = (data) => {
    const { xml, hash, sunatResponse } = data;
    const { success, cdrZip, cdrResponse } = sunatResponse;
    
    modalContent.innerHTML = `
        <div class="p-4 bg-gray-100 rounded-lg">
            <h3 class="text-lg font-semibold mb-3 text-teal-700">Resultado de SUNAT</h3>
            <div class="mb-4">
                <strong class="text-sm font-bold text-gray-800">Éxito:</strong>
                <span class="text-sm text-gray-700">${success ? 'Sí' : 'No'}</span>
            </div>
            <div class="mb-4">
                <strong class="text-sm font-bold text-gray-800">Hash:</strong>
                <span class="text-sm text-gray-700">${hash}</span>
            </div>
            <div class="mb-4">
                <strong class="text-sm font-bold text-gray-800">Descripción:</strong>
                <span class="text-sm text-gray-700">${cdrResponse.description}</span>
            </div>
            <div class="mb-4">
                <strong class="text-sm font-bold text-gray-800">Código de Respuesta:</strong>
                <span class="text-sm text-gray-700">${cdrResponse.code}</span>
            </div>
            <div class="mb-4">
                <strong class="text-sm font-bold text-gray-800">XML:</strong>
                <div class="bg-white p-2 rounded-md border border-gray-300 max-h-48 overflow-auto">
                    <pre class="text-xs text-gray-700">${xml}</pre>
                </div>
            </div>
        </div>
    `;
    modal.classList.remove('hidden');
};


    // Cerrar el modal
    closeModalButton.addEventListener('click', () => {
        modal.classList.add('hidden');
    });

    // Resaltar inputs en rojo si hay error
    const highlightError = (inputId) => {
        const input = document.getElementById(inputId);
        if (input) {
            input.classList.add('border-red-500', 'focus:ring-red-500');
        }
    };

    const clearErrors = () => {
        const inputs = document.querySelectorAll('input');
        inputs.forEach(input => input.classList.remove('border-red-500', 'focus:ring-red-500'));
    };

    // Validar campos obligatorios
    const validateFields = (data) => {
        let valid = true;
        clearErrors();

        if (!data.company || !data.company.ruc) {
            showAlert('error', 'Error de Validación', 'El RUC de la compañía es obligatorio.');
            highlightError('companyRuc');
            valid = false;
        }
        if (!data.company.address) {
            showAlert('error', 'Error de Validación', 'La dirección de la compañía es obligatoria.');
            highlightError('companyUbigeo'); // Resalta el primer input relacionado
            valid = false;
        }
        if (!data.client) {
            showAlert('error', 'Error de Validación', 'Los datos del cliente son obligatorios.');
            highlightError('clientTipoDoc');
            valid = false;
        }
        if (!Array.isArray(data.details) || data.details.length === 0) {
            showAlert('error', 'Error de Validación', 'Debe haber al menos un detalle del producto.');
            highlightError('prodCodigo');
            valid = false;
        }

        return valid;
    };

    // Cerrar alerta manualmente
    closeAlert.addEventListener('click', () => {
        alertBox.classList.add('hidden');
    });

    form.addEventListener('submit', async (event) => {
        event.preventDefault();  // Prevenir envío predeterminado del formulario
    
        const data = {
            ublVersion: document.getElementById('ublVersion').value,
            
            tipoDoc: document.getElementById('tipoDoc').value,
            serie: document.getElementById('serie').value,
            correlativo: document.getElementById('correlativo').value,
            fechaEmision: document.getElementById('fechaEmision').value,
            tipDocAfectado: document.getElementById('tipDocAfectado').value,
            numDocfectado: document.getElementById('numDocfectado').value,
            codMotivo: document.getElementById('codMotivo').value,
            desMotivo: document.getElementById('desMotivo').value,
            formaPago: {
                moneda: document.getElementById('tipoMoneda').value,
                tipo: document.getElementById('formaPago').value,
            },
            tipoMoneda: document.getElementById('tipoMoneda').value,
            company: {
                ruc: document.getElementById('companyRuc').value,
                razonSocial: document.getElementById('companyRazonSocial').value,
                nombreComercial: document.getElementById('companyNombreComercial').value,
                address: {
                    ubigueo: document.getElementById('companyUbigeo').value,
                    departamento: document.getElementById('companyDepartamento').value,
                    provincia: document.getElementById('companyProvincia').value,
                    distrito: document.getElementById('companyDistrito').value,
                    urbanizacion: '-', // Valor fijo según el ejemplo
                    direccion: document.getElementById('direccion').value,
                    codLocal: document.getElementById('companyCodigoLocal').value,
                },
            },
            client: {
                tipoDoc: document.getElementById('clientTipoDoc').value,
                numDoc: document.getElementById('clientNumDoc').value,
                rznSocial: document.getElementById('clientRazonSocial').value,
            },
            details: [{
                tipAfeIgv: document.getElementById('tipAfeIgv').value,
                codProducto: document.getElementById('prodCodigo').value,
                unidad: document.getElementById('prodUnidad').value,
                descripcion: document.getElementById('descripcion').value,
                cantidad: parseInt(document.getElementById('prodCantidad').value),
                mtoValorUnitario: parseFloat(document.getElementById('prodMtoValorUnitario').value),
                mtoValorVenta: parseFloat(document.getElementById('mtoValorVenta').value),
                mtoBaseIgv: parseFloat(document.getElementById('mtoBaseIgv').value),
                porcentajeIgv: parseFloat(document.getElementById('porcentajeIgv').value),
                igv: parseFloat(document.getElementById('Igv').value),
                totalImpuestos: parseFloat(document.getElementById('totalImpuestos').value),
                mtoPrecioUnitario: parseFloat(document.getElementById('mtoPrecioUnitario').value),
            }],
            mtoOperGravadas: parseFloat(document.getElementById('mtoOperGravadas').value),
            mtoIGV: parseFloat(document.getElementById('mtoIGV').value),
            totalImpuestos: parseFloat(document.getElementById('total_impuestos').value),
            valorVenta: parseFloat(document.getElementById('valorVenta').value),
            subTotal: parseFloat(document.getElementById('subTotal').value),
            mtoImpVenta: parseFloat(document.getElementById('mtoImpVenta').value),
            legends: [{
                code: document.getElementById('legendCode').value,
                value: document.getElementById('legendValue').value,
            }]
        };
        
        console.log(data);
        if (!validateFields(data)) return;  // Validar antes de enviar
    
        try {
            const response = await fetch('http://127.0.0.1:8000/api/notes/send', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${localStorage.getItem('accessToken')}`,
                },
                body: JSON.stringify(data),
            });
    
            const result = await response.json();
    
            if (result.sunatResponse && result.sunatResponse.success) {
                showAlert('success', 'Nota Enviada', 'La Nota ha sido enviada exitosamente.', true, result);
            }   else {
                const errorMessage = result.sunatResponse && result.sunatResponse.error
                    ? `Error en SUNAT: ${result.sunatResponse.error.message}`
                    : 'Error al enviar la factura a SUNAT.';
                showAlert('error', 'Error al Enviar', errorMessage, false, result);
            }
        } catch (error) {
            showAlert('error', 'Error de Conexión', error.message || 'No se pudo conectar con el servidor.', true, { error: error.message });
        }
    });
});
