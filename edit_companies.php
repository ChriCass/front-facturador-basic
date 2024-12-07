<?php include 'layout/top.php'; ?>  

<?php
// Obtener el ID de la URL
$companyId = $_GET['ruc'];
?>

<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-8">
    <div class="bg-white rounded-md shadow p-5">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Editar Compañía</h2>
        <form id="companyForm" enctype="multipart/form-data">
            <!-- Campos del formulario -->
            <div class="mb-4">
                <label for="razon_social" class="block text-gray-700">Razón Social</label>
                <input type="text" name="razon_social" id="razon_social" required class="w-full mb-3 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500">
            </div>
            <div class="mb-4">
                <label for="ruc" class="block text-gray-700">RUC</label>
                <input type="text" name="ruc" id="ruc" required class="w-full mb-3 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500">
            </div>
            <div class="mb-4">
                <label for="direccion" class="block text-gray-700">Dirección</label>
                <input type="text" name="direccion" id="direccion" required class="w-full mb-3 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500">
            </div>

            <!-- Campo Logo (opcional) sin vista previa, solo mostrando la ruta -->
            <div class="mb-4">
                <label for="logo" class="block text-gray-700">Logo (opcional)</label>
                <input type="file" name="logo" id="logo" class="w-full mb-3 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500">
                <p id="logoPath" class="text-gray-500 text-sm"></p>
            </div>

            <!-- Campo Certificado (opcional) sin enlace directo, solo mostrando la ruta -->
            <div class="mb-4">
                <label for="cert" class="block text-gray-700">Certificado (Archivo .pem/.txt)</label>
                <input type="file" name="cert" id="cert" accept=".pem,.txt" class="w-full mb-3 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500">
                <p id="certPath" class="text-gray-500 text-sm"></p>
            </div>

            <div class="mb-4">
                <label for="sol_user" class="block text-gray-700">Usuario SOL</label>
                <input type="text" name="sol_user" id="sol_user" required class="w-full mb-3 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500">
            </div>
            <div class="mb-4">
                <label for="sol_pass" class="block text-gray-700">Contraseña SOL</label>
                <input type="password" name="sol_pass" id="sol_pass" required class="w-full mb-3 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500">
            </div>
            <div class="mb-4 flex items-center">
                <input type="checkbox" name="production" id="production" class="mr-2">
                <label for="production" class="text-gray-700">¿Producción?</label>
            </div>
            <div class="flex justify-between items-center">
                <button type="submit" class="bg-teal-500 text-white py-2 px-4 rounded-md hover:bg-teal-600">Guardar Cambios</button>
            </div>
        </form>
    </div>
</div>

<?php include 'layout/bottom.php'; ?>

<script>
 document.addEventListener('DOMContentLoaded', async () => {
    const token = localStorage.getItem('accessToken');
    const companyId = "<?php echo $companyId; ?>";

    console.log('ID de la compañía:', companyId);

    let initialCompanyData = {}; // Variable para almacenar los datos iniciales de la compañía

    if (token && companyId) {
        try {
            const response = await fetch(`http://127.0.0.1:8000/api/companies/${companyId}`, {
                method: 'GET',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Content-Type': 'application/json'
                }
            });

            if (!response.ok) {
                throw new Error('Error al obtener los datos de la compañía.');
            }

            const company = await response.json();
            console.log('Datos de la compañía obtenidos:', company);

            // Guardar los datos iniciales de la compañía
            initialCompanyData = company;

            // Asignar valores al formulario
            document.getElementById('razon_social').value = company.razon_social || '';
            document.getElementById('ruc').value = company.ruc || '';
            document.getElementById('direccion').value = company.direccion || '';
            document.getElementById('sol_user').value = company.sol_user || '';
            document.getElementById('sol_pass').value = company.sol_pass || '';
            document.getElementById('production').checked = company.production || false;

            // Mostrar las rutas solo si existen
            if (company.logo_path) {
                document.getElementById('logoPath').textContent = `Ruta actual: ${company.logo_path}`;
            } else {
                document.getElementById('logoPath').textContent = 'No se ha asignado un logo.';
            }

            if (company.cert_path) {
                document.getElementById('certPath').textContent = `Ruta actual: ${company.cert_path}`;
            } else {
                document.getElementById('certPath').textContent = 'No se ha asignado un certificado.';
            }

        } catch (error) {
            console.error('Error al obtener los datos de la compañía:', error);
            alert('Hubo un error al cargar los datos de la compañía.');
        }
    } else {
        console.log('No se encontraron el token o el ID de la compañía.');
    }

    document.getElementById('companyForm').addEventListener('submit', async (e) => {
        e.preventDefault();

        // Crear un objeto para ver los datos del formulario en formato JSON
        const formObject = {};

        // Recoger los datos del formulario
        formObject['razon_social'] = document.getElementById('razon_social').value;
        formObject['ruc'] = document.getElementById('ruc').value;
        formObject['direccion'] = document.getElementById('direccion').value;
        formObject['sol_user'] = document.getElementById('sol_user').value;
        formObject['sol_pass'] = document.getElementById('sol_pass').value;
        formObject['production'] = document.getElementById('production').checked ? 1 : 0;

        // Revisa si algún campo ha sido editado
        let updatedData = {};

        // Comparar los valores actuales con los valores iniciales
        if (formObject['razon_social'] !== initialCompanyData.razon_social) {
            updatedData['razon_social'] = formObject['razon_social'];
        }
        if (formObject['ruc'] !== initialCompanyData.ruc) {
            updatedData['ruc'] = formObject['ruc'];
        }
        if (formObject['direccion'] !== initialCompanyData.direccion) {
            updatedData['direccion'] = formObject['direccion'];
        }
        if (formObject['sol_user'] !== initialCompanyData.sol_user) {
            updatedData['sol_user'] = formObject['sol_user'];
        }
        if (formObject['sol_pass'] !== initialCompanyData.sol_pass) {
            updatedData['sol_pass'] = formObject['sol_pass'];
        }
        if (formObject['production'] !== initialCompanyData.production) {
            updatedData['production'] = formObject['production'];
        }

        // Si el logo fue cambiado, lo enviamos
        if (document.getElementById('logo').files.length > 0) {
            updatedData['logo'] = document.getElementById('logo').files[0];
        }
        // Si el certificado fue cambiado, lo enviamos
        if (document.getElementById('cert').files.length > 0) {
            updatedData['cert'] = document.getElementById('cert').files[0];
        }

        // Ver el contenido de los datos actualizados antes de enviarlos
        console.log('Datos que serán enviados:', updatedData);

        // Si no hubo cambios, no enviamos nada
        if (Object.keys(updatedData).length === 0) {
            alert('No se han realizado cambios.');
            return;
        }

        // Convertir los datos actualizados en formato x-www-form-urlencoded
        const urlEncodedData = new URLSearchParams();
        for (const [key, value] of Object.entries(updatedData)) {
            if (value instanceof File) {
                // Si es un archivo, lo omitimos aquí, porque no puedes enviarlo en x-www-form-urlencoded
                // necesitarías manejar el archivo de una manera diferente.
                continue;
            }
            urlEncodedData.append(key, value);
        }

        try {
            const response = await fetch(`http://127.0.0.1:8000/api/companies/${companyId}`, {
                method: 'PUT',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Content-Type': 'application/x-www-form-urlencoded' // Usamos el tipo adecuado
                },
                body: urlEncodedData.toString() // Enviar los datos en formato urlencoded
            });

            if (response.ok) {
                alert('Compañía actualizada con éxito.');
                window.location.reload();
            } else {
                const errorText = await response.text();
                alert(`Hubo un error al actualizar la compañía: ${errorText}`);
            }
        } catch (error) {
            console.error('Error al enviar los cambios:', error);
            alert('Hubo un error al intentar actualizar la compañía.');
        }
    });
});

</script>
