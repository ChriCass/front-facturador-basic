document.addEventListener('DOMContentLoaded', () => {
    const generatePdfBtnN = document.querySelector('#generatePdfBtnN'); // Botón de generar PDF
    const alertBox = document.getElementById('alertBox');
    const alertTitle = document.getElementById('alertTitle');
    const alertMessage = document.getElementById('alertMessage');
    const alertIcon = document.getElementById('alertIcon');
    const closeAlert = document.getElementById('closeAlert');

    // Mostrar alertas
    const showAlert = (type, title, message) => {
        const alertClass = type === 'success' ? 'bg-green-100 text-green-500' : 'bg-yellow-100 text-yellow-600';
        alertBox.className = `fixed top-4 right-4 max-w-sm w-full shadow-lg rounded-lg p-4 ${alertClass}`;
        alertIcon.innerHTML = type === 'success'
            ? `<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
               </svg>`
            : `<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v10M15 7v10M19 13H5" />
               </svg>`;
        alertTitle.innerText = title;
        alertMessage.innerText = message;
        alertBox.classList.remove('hidden');
        setTimeout(() => alertBox.classList.add('hidden'), 5000);
    };

    // Función para generar el nombre del archivo
const generateFileName = (razonSocial, ruc) => {
    const date = new Date().toISOString().split('T')[0]; // Fecha en formato YYYY-MM-DD
    const namePart = razonSocial.slice(0, 2).toUpperCase(); // Primeras dos letras de la razón social en mayúsculas
    const rucPart = ruc.slice(-4); // Últimos cuatro dígitos del RUC
    return `${namePart}_${date}_${rucPart}.pdf`;
};

// Descargar PDF desde un blob, ahora usando el nombre personalizado
const downloadPdf = (blob, filename) => {
    const url = window.URL.createObjectURL(blob);
    const link = document.createElement('a');
    link.href = url;
    link.download = filename;
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    window.URL.revokeObjectURL(url);
};


    // Cerrar alerta manualmente
    closeAlert.addEventListener('click', () => {
        alertBox.classList.add('hidden');
    });

    

    generatePdfBtnN.addEventListener('click', async () => {
         // Razon Social y RUC para el nombre del archivo
    const razonSocial = document.getElementById('companyRazonSocial').value;
    const ruc = document.getElementById('companyRuc').value;
    const filename = generateFileName(razonSocial, ruc);
        const token = localStorage.getItem('accessToken'); // Token de autenticación
        if (!token) {
            showAlert('error', 'Error de Autenticación', 'Token de acceso no encontrado.');
            return;
        }

        // Capturar los datos del formulario para enviar al backend
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
            showAlert('warning', 'Preparando Descarga', 'Generando PDF, por favor espere...');

            const response = await fetch('http://127.0.0.1:8000/api/notes/pdf', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${token}`,
                },
                body: JSON.stringify(data),
            });

            if (!response.ok) {
                const errorMessage = await response.text();
                showAlert('error', 'Error al Generar PDF', errorMessage);
                return;
            }

            const blob = await response.blob(); // Leer respuesta como Blob
            downloadPdf(blob, filename);
            showAlert('success', 'Descarga Completa', 'El archivo PDF ha sido descargado exitosamente.');
        } catch (error) {
            showAlert('error', 'Error de Conexión', error.message || 'No se pudo conectar con el servidor.');
        }
    });
});
