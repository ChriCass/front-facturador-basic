document.addEventListener('DOMContentLoaded', () => {
    // Referencias a elementos del DOM
    const abrirFormularioBtn = document.querySelector('#abrirFormularioBtn');
    const invoiceForm = document.querySelector('#container');

    // Referencias a los botones para generar XML y PDF (factura)
    const generarXmlBtn = document.querySelector('#generateXmlBtn');
    const generarPdfBtn = document.querySelector('#generatePdfBtn');

    // Referencias a los botones para generar XML y PDF (nota de crédito/débito)
    const generarXmlBtnN = document.querySelector('#generateXmlBtnN');
    const generarPdfBtnN = document.querySelector('#generatePdfBtnN');

    // Ocultar el formulario al cargar la página
    if (invoiceForm) {
        invoiceForm.style.display = 'none';
    }

    // Mostrar/Ocultar formulario y cambiar color y texto del botón
    abrirFormularioBtn.addEventListener('click', () => {
        // Toggle de visibilidad del formulario
        const isHidden = invoiceForm.style.display === 'none';
        invoiceForm.style.display = isHidden ? 'block' : 'none';

        // Cambiar apariencia del botón y el estado de los botones adicionales
        if (isHidden) {
            abrirFormularioBtn.style.backgroundColor = '#ffc107'; // Color amarillo (tipo warning)
            abrirFormularioBtn.style.color = '#212529'; // Texto oscuro
            abrirFormularioBtn.querySelector('span').textContent = 'Cerrar Formulario de Emisión';

            // Habilitar todos los botones para generar XML/PDF
            if (generarXmlBtn) generarXmlBtn.disabled = false;
            if (generarPdfBtn) generarPdfBtn.disabled = false;
            if (generarXmlBtnN) generarXmlBtnN.disabled = false;
            if (generarPdfBtnN) generarPdfBtnN.disabled = false;
        } else {
            abrirFormularioBtn.style.backgroundColor = '#319795'; // Color teal original
            abrirFormularioBtn.style.color = 'white';
            abrirFormularioBtn.querySelector('span').textContent = 'Abrir Formulario de Emisión';

            // Deshabilitar todos los botones para generar XML/PDF
            if (generarXmlBtn) generarXmlBtn.disabled = true;
            if (generarPdfBtn) generarPdfBtn.disabled = true;
            if (generarXmlBtnN) generarXmlBtnN.disabled = true;
            if (generarPdfBtnN) generarPdfBtnN.disabled = true;
        }
    });
});
