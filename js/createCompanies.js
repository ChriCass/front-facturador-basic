document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('companyForm');
    const alertBox = document.getElementById('alertBox');
    const alertTitle = document.getElementById('alertTitle');
    const alertMessage = document.getElementById('alertMessage');
    const alertIcon = document.getElementById('alertIcon');
    const closeAlert = document.getElementById('closeAlert');

    // Función para mostrar la alerta
    const showAlert = (type, title, message) => {
        if (type === 'success') {
            alertBox.classList.remove('bg-red-100', 'text-red-500');
            alertBox.classList.add('bg-green-100', 'text-green-500');
            alertIcon.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            `;
        } else {
            alertBox.classList.remove('bg-green-100', 'text-green-500');
            alertBox.classList.add('bg-red-100', 'text-red-500');
            alertIcon.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            `;
        }

        alertTitle.innerText = title;
        alertMessage.innerText = message;
        alertBox.classList.remove('hidden');

        setTimeout(() => {
            alertBox.classList.add('hidden');
        }, 5000);
    };

    closeAlert.addEventListener('click', () => {
        alertBox.classList.add('hidden');
    });

    form.addEventListener('submit', async (event) => {
        event.preventDefault();

        const formData = new FormData(form);  // Usamos FormData para incluir archivos

        try {
            const response = await fetch('http://127.0.0.1:8000/api/companies', {
                method: 'POST',
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('accessToken')}`
                },
                body: formData
            });

            const result = await response.json();

            if (response.ok) {
                showAlert('success', 'Compañía Registrada', 'La compañía ha sido creada exitosamente.');
            } else {
                showAlert('error', 'Error al Registrar', result.message || 'Hubo un error al registrar la compañía.');
            }
        } catch (error) {
            showAlert('error', 'Error de Conexión', 'No se pudo conectar con el servidor.');
        }
    });
});