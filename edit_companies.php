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

    // Obtener datos de la compañía para mostrar en el formulario
    if (token && companyId) {
        try {
            const response = await fetch(`http://127.0.0.1:8000/api/companies/${companyId}`, {
                method: 'GET',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Content-Type': 'application/json'
                }
            });
            const company = await response.json();

            // Llenar el formulario con los datos de la compañía
            document.getElementById('razon_social').value = company.razon_social;
            document.getElementById('ruc').value = company.ruc;
            document.getElementById('direccion').value = company.direccion;
            document.getElementById('sol_user').value = company.sol_user;
            document.getElementById('sol_pass').value = company.sol_pass;
            document.getElementById('production').checked = company.production;

            // Mostrar solo la ruta del logo si existe
            if (company.logo_path) {
                document.getElementById('logoPath').textContent = `Ruta actual: ${company.logo_path}`;
            }

            // Mostrar solo la ruta del certificado si existe
            if (company.cert_path) {
                document.getElementById('certPath').textContent = `Ruta actual: ${company.cert_path}`;
            }

        } catch (error) {
            console.error('Error al obtener los datos de la compañía:', error);
        }
    }

    // Guardar cambios
    document.getElementById('companyForm').addEventListener('submit', async (e) => {
        e.preventDefault();

        const formData = new FormData(document.getElementById('companyForm'));

        try {
            const response = await fetch(`http://127.0.0.1:8000/api/companies/${companyId}`, {
                method: 'PUT',
                headers: {
                    'Authorization': `Bearer ${token}`
                },
                body: formData
            });

            if (response.ok) {
                alert('Compañía actualizada con éxito.');
                window.location.href = "<?php echo $base_url; ?>"; // Redirigir a la página principal
            } else {
                console.error('Error al actualizar la compañía:', await response.text());
            }
        } catch (error) {
            console.error('Error al enviar los cambios:', error);
        }
    });
});
</script>
