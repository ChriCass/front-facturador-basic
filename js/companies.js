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
            <td class="py-2 px-4 border-b  text-center">
                <div class="flex">
                <button class="bg-blue-500 text-white px-4 py-1 rounded hover:bg-blue-600 mr-2" onclick="editCompany(${company.id})">Editar</button>
                <button class="bg-red-500 text-white px-4 py-1 rounded hover:bg-red-600" onclick="deleteCompany(${company.id})">Eliminar</button>
                </div>
              
            </td>
        `;

        tableBody.appendChild(row);
    });
}

// Función para editar una compañía
function editCompany(id) {
    console.log(`Editando compañía con ID: ${id}`);
    // Aquí puedes implementar la lógica para editar la compañía
    // Mostrar un formulario modal, por ejemplo, para modificar los datos
}

// Función para eliminar una compañía
async function deleteCompany(id) {
    const token = localStorage.getItem('accessToken'); // Tomar token de localStorage
    if (!token) {
        console.error('No se encontró un token en localStorage.');
        return;
    }

    try {
        const response = await fetch(`${apiUrl}/${id}`, {
            method: 'DELETE',
            headers: {
                'Authorization': `Bearer ${token}`,
                'Content-Type': 'application/json'
            }
        });

        if (!response.ok) {
            throw new Error('Error al eliminar la compañía');
        }

        console.log(`Compañía con ID ${id} eliminada`);
        loadCompanies(); // Recargar los datos

    } catch (error) {
        console.error('Error al eliminar la compañía:', error);
    }
}

// Cargar los datos al iniciar la página
document.addEventListener('DOMContentLoaded', loadCompanies);