document.addEventListener('DOMContentLoaded', () => {
    const abrirFormularioBtn = document.querySelector('#abrirFormularioBtn');
    const invoiceForm = document.querySelector('#container');
    const generarXmlBtn = document.querySelector('#generateXmlBtn');
    const generarPdfBtn = document.querySelector('#generatePdfBtn');

    // Ocultar el formulario al cargar la página
    invoiceForm.style.display = 'none';

    // Mostrar/Ocultar formulario y cambiar color y texto del botón
    abrirFormularioBtn.addEventListener('click', () => {
        const isHidden = invoiceForm.style.display === 'none';
        invoiceForm.style.display = isHidden ? 'block' : 'none';

        if (isHidden) {
            abrirFormularioBtn.style.backgroundColor = '#ffc107'; // Color warning de Bootstrap
            abrirFormularioBtn.style.color = '#212529'; // Texto oscuro (Bootstrap)
            abrirFormularioBtn.querySelector('span').textContent = 'Cerrar Formulario de Emisión';

            // Habilitar botones
            generarXmlBtn.disabled = false;
            generarPdfBtn.disabled = false;
        } else {
            abrirFormularioBtn.style.backgroundColor = '#319795'; // Teal original
            abrirFormularioBtn.style.color = 'white';
            abrirFormularioBtn.querySelector('span').textContent = 'Abrir Formulario de Emisión';

            // Deshabilitar botones
            generarXmlBtn.disabled = true;
            generarPdfBtn.disabled = true;
        }
    });
});