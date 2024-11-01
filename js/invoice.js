document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('invoiceForm');
    const alertBox = document.getElementById('alertBox');
    const alertTitle = document.getElementById('alertTitle');
    const alertMessage = document.getElementById('alertMessage');
    const alertIcon = document.getElementById('alertIcon');
    const closeAlert = document.getElementById('closeAlert');

    // Mostrar alertas
    const showAlert = (type, title, message) => {
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
        alertBox.classList.remove('hidden');
        setTimeout(() => alertBox.classList.add('hidden'), 5000);
    };

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
            tipoOperacion: document.getElementById('tipoOperacion').value,
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
    
        if (!validateFields(data)) return;  // Validar antes de enviar
    
        try {
            const response = await fetch('http://127.0.0.1:8000/api/invoices/send', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${localStorage.getItem('accessToken')}`,
                },
                body: JSON.stringify(data),
            });
    
            const result = await response.json();
    
            if (response.ok) {
                showAlert('success', 'Factura Enviada', 'La factura ha sido enviada exitosamente.');
            } else {
                const errorMessage = result.errors 
                    ? Object.values(result.errors).flat().join(', ') 
                    : result.message || 'Error al enviar la factura.';
                showAlert('error', 'Error al Enviar', errorMessage);
            }
        } catch (error) {
            showAlert('error', 'Error de Conexión', error.message || 'No se pudo conectar con el servidor.');
        }
    });
    
});
