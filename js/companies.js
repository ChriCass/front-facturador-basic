const apiUrl = 'http://127.0.0.1:8000/api/companies'; // Ajusta la URL de la API según sea necesario

// Función para cargar los datos desde la API
async function loadCompanies() {
    const token = localStorage.getItem('accessToken'); // Tomar token de localStorage
    if (!token) {
        console.error('No se encontró un token en localStorage.');
        return; // Detener si no hay token
    }

    try {
        const response = await fetch(apiUrl, {
            method: 'GET',
            headers: {
                'Authorization': `Bearer ${token}`, // Usar el token de autenticación
                'Content-Type': 'application/json'
            }
        });

        if (!response.ok) {
            throw new Error('Error al obtener los datos de la API');
        }

        const companies = await response.json(); // Obtener los datos de la API
        renderTable(companies); // Llamar a la función para renderizar los datos en la tabla

    } catch (error) {
        console.error('Error al cargar los datos:', error);
    }
}

// Función para renderizar los datos en la tabla
function renderTable(companies) {
    const tableBody = document.getElementById('companiesTableBody');
    tableBody.innerHTML = ''; // Limpiar el contenido anterior

    companies.forEach(company => {
        const row = document.createElement('tr');

        row.innerHTML = `
            <td class="py-2 px-4 border-b text-center">${company.id}</td>
            <td class="py-2 px-4 border-b">${company.razon_social}</td>
            <td class="py-2 px-4 border-b">${company.ruc}</td>
            <td class="py-2 px-4 border-b">${company.direccion}</td>
            <td class="py-2 px-4 border-b">${company.cert_path}</td>
            <td class="py-2 px-4 border-b text-center">
                <div class="flex gap-3">
                    <a href="edit_companies.php?ruc=${company.ruc}" class="bg-blue-500 text-white px-4 py-1 rounded hover:bg-blue-600">Editar</a>
                    <button class="bg-red-500 text-white px-4 py-1 rounded hover:bg-red-600" onclick="showDeleteModal('${company.ruc}', '${company.razon_social}')">Eliminar</button>
                </div>
            </td>
        `;

        tableBody.appendChild(row);
    });
}

// Función para mostrar el modal de confirmación
function showDeleteModal(ruc, razonSocial) {
    // Asignar el nombre de la compañía y el RUC al modal
    document.getElementById('companyName').textContent = razonSocial;
    document.getElementById('companyRUC').textContent = ruc;

    // Mostrar el modal
    document.getElementById('confirmationModal').classList.remove('hidden');

    // Función para confirmar la eliminación
    document.getElementById('confirmDeleteButton').onclick = async function() {
        await deleteCompany(ruc); // Eliminar la compañía usando el RUC
        closeModal(); // Cerrar el modal
    };

    // Función para cancelar y cerrar el modal
    document.getElementById('cancelButton').onclick = function() {
        closeModal(); // Cerrar el modal
    };
}

// Función para eliminar una compañía usando el RUC
 // Función para eliminar una compañía
async function deleteCompany(ruc) {
    const token = localStorage.getItem('accessToken'); // Tomar token de localStorage
    if (!token) {
        console.error('No se encontró un token en localStorage.');
        return;
    }

    try {
        const response = await fetch(`${apiUrl}/${ruc}`, {
            method: 'DELETE',
            headers: {
                'Authorization': `Bearer ${token}`,
                'Content-Type': 'application/json'
            }
        });

        if (!response.ok) {
            throw new Error('Error al eliminar la compañía');
        }

        // Mostrar alerta de éxito
        showAlert('success', 'Compañía eliminada correctamente.');

        // Recargar la lista de compañías
        loadCompanies();
    } catch (error) {
        // Mostrar alerta de error
        showAlert('error', 'Hubo un error al eliminar la compañía.');
    }
}

// Función para mostrar la alerta
function showAlert(type, message) {
    const alertBox = document.getElementById('alertBox');
    const alertIcon = document.getElementById('alertIcon');
    const alertMessage = document.getElementById('alertMessage');

    const alertClass = type === 'success' ? 'bg-green-100 text-green-500' : 'bg-red-100 text-red-500';
    alertBox.className = `fixed top-4 right-4 max-w-sm w-full shadow-lg rounded-lg p-4 ${alertClass} transition-all ease-in-out duration-300`;

    alertMessage.textContent = message;

    // Definir el ícono según el tipo de alerta
    alertIcon.innerHTML = type === 'success'
        ? `<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
           </svg>`
        : `<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
           </svg>`;

    // Mostrar la alerta
    alertBox.classList.remove('hidden');
    
    // Ocultar la alerta después de 3 segundos
    setTimeout(() => {
        alertBox.classList.add('hidden');
    }, 3000);
}

// Cerrar el modal
function closeModal() {
    document.getElementById('confirmationModal').classList.add('hidden');
}

// Cargar los datos al iniciar la página
document.addEventListener('DOMContentLoaded', loadCompanies);
