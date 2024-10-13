document.addEventListener("DOMContentLoaded", () => {
    console.log("DOM completamente cargado y analizado.");

    // Referencias a elementos del DOM
    const loginForm = document.getElementById("loginForm");
    const registerForm = document.getElementById("registerForm");
    const alertDiv = document.getElementById("alert");
    const mainContent = document.getElementById("main-content");

    // Tiempo de expiración del token
    const TOKEN_EXPIRATION_TIME = 60 * 60 * 1000; // 1 hora en milisegundos

    // Función para mostrar alertas
    const showAlert = (message) => {
        console.log("Mostrando alerta: ", message);
        alertDiv.className = "bg-red-500 p-3 text-white";
        alertDiv.innerText = message;
        alertDiv.classList.remove("hidden"); // Mostrar el mensaje de error
    };

    // Función para guardar el token y la marca de tiempo
    const saveToken = (token) => {
        console.log("Guardando token...");
        const currentTime = new Date().getTime();
        localStorage.setItem("accessToken", token);
        localStorage.setItem("tokenTimestamp", currentTime);
        console.log("Token guardado: ", token);
    };

    // Función para verificar si el token ha expirado
    const isTokenExpired = () => {
        const tokenTimestamp = localStorage.getItem("tokenTimestamp");
        if (!tokenTimestamp) {
            console.log("No hay timestamp. El token ha expirado.");
            return true;
        }
        const currentTime = new Date().getTime();
        const timeElapsed = currentTime - tokenTimestamp;
        console.log(
            `Verificando expiración del token. Tiempo transcurrido: ${timeElapsed} ms`
        );
        return timeElapsed > TOKEN_EXPIRATION_TIME;
    };

    // Función para verificar si el usuario está autenticado
    const isAuthenticated = () => {
        const token = localStorage.getItem("accessToken");
        if (!token) {
            console.log(
                "No hay token guardado. El usuario no está autenticado."
            );
            return false;
        }

        if (isTokenExpired()) {
            console.log("El token ha expirado. Eliminando...");
            localStorage.removeItem("accessToken");
            localStorage.removeItem("tokenTimestamp");
            return false;
        }

        console.log("El usuario está autenticado.");
        return true;
    };

    // Proteger las páginas que requieren autenticación
    const protectPage = () => {
        console.log("Verificando si la página está protegida...");
        if (!isAuthenticated()) {
            console.log(
                "El usuario no está autenticado. Redirigiendo a auth_error.html."
            );
            window.location.href = "auth_error.html";
        } else if (mainContent) {
            console.log("El usuario está autenticado. Mostrando el contenido.");
            mainContent.style.display = "block";
        }
    };

    // Función para manejar el envío del formulario de inicio de sesión
    const handleLogin = async (event) => {
        event.preventDefault();

        const email = document.getElementById("email").value;
        const password = document.getElementById("password").value;

        console.log("Intentando iniciar sesión con el correo: ", email);

        if (!email || !password) {
            showAlert("Por favor ingresa tu email y contraseña.");
            return;
        }

        const body = JSON.stringify({ email, password });

        try {
            console.log("Enviando solicitud de inicio de sesión...");
            const response = await fetch("http://127.0.0.1:8000/api/login", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                },
                body: body,
            });

            const data = await response.json();
            console.log("Respuesta recibida del servidor:", data);

            if (response.ok) {
                console.log("Inicio de sesión exitoso.");
                saveToken(data.access_token);
                window.location.href = "dashboard.html";
            } else {
                console.error(
                    "Error en el inicio de sesión:",
                    data.error || "Datos incorrectos."
                );
                showAlert(
                    "Error en el inicio de sesión: " +
                        (data.error || "Datos incorrectos.")
                );
            }
        } catch (error) {
            console.error(
                "Error de conexión durante el inicio de sesión:",
                error
            );
            showAlert(
                "Error de conexión con el servidor. Verifica que el backend esté activo."
            );
        }
    };

    // Función para manejar el envío del formulario de registro
    const handleRegister = async (event) => {
        event.preventDefault();

        const name = document.getElementById("name").value;
        const email = document.getElementById("email").value;
        const password = document.getElementById("password").value;
        const password_confirmation = document.getElementById(
            "password_confirmation"
        ).value;

        console.log("Intentando registrar al usuario:", email);

        if (
            !name ||
            !email ||
            !password ||
            password !== password_confirmation
        ) {
            console.error(
                "Error en la validación de campos del formulario de registro."
            );
            showAlert(
                "Verifica que todos los campos estén completos y que las contraseñas coincidan."
            );
            return;
        }

        const body = JSON.stringify({
            name,
            email,
            password,
            password_confirmation,
        });

        try {
            console.log("Enviando solicitud de registro...");
            const response = await fetch("http://127.0.0.1:8000/api/register", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                },
                body: body,
            });

            const data = await response.json();
            console.log("Respuesta recibida del servidor:", data);

            if (response.ok) {
                console.log("Registro exitoso.");
                saveToken(data.access_token);
                window.location.href = "dashboard.html";
            } else {
                console.error("Error en el registro:", data.message);
                showAlert("Error en el registro: " + data.message);
            }
        } catch (error) {
            console.error("Error de conexión durante el registro:", error);
            showAlert("Error de conexión con el servidor.");
        }
    };

    // Función para cerrar la sesión
    const logout = () => {
        console.log("Cerrando sesión...");
        localStorage.removeItem("accessToken");
        localStorage.removeItem("tokenTimestamp");
        window.location.href = "index.html";
    };

    // Evento de envío del formulario de inicio de sesión
    if (loginForm) {
        loginForm.addEventListener("submit", handleLogin);
    }

    // Evento de envío del formulario de registro
    if (registerForm) {
        registerForm.addEventListener("submit", handleRegister);
    }

    // Agregar el event listener al botón de cierre de sesión
    document.addEventListener("click", (event) => {
        if (event.target && event.target.id === "logoutButton") {
            event.preventDefault();
            console.log("Botón de cierre de sesión presionado.");
            logout();
        }
    });

    // Verificar si la página está protegida
    const protectedPages = [
        "dashboard.html",
        "nota_credito.html",
        "nota_debito.html",
        "registrar_companies.html",
        "companies.html",
        "boleta_factura_form",
    ];

    if (protectedPages.includes(window.location.pathname.split("/").pop())) {
        protectPage();
    } else if (mainContent) {
        console.log("Página no protegida. Mostrando contenido.");
        mainContent.style.display = "block";
    }
});
