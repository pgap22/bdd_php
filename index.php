<?php
require('config/database.php');
require('controllers/LoginController.php');
require('middleware/no_auth.php');


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $loginController = new LoginController($db);
    $message == $loginController->login($_POST['email'], $_POST['password']);
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Sistema De Asistencia CECE</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 h-screen flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-md p-8">
        <!-- Logo o Título -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-semibold text-gray-800">Sistema De Asistencia CECE</h1>
            <p class="text-gray-600 mt-2">Inicia sesión para continuar</p>
        </div>

        <!-- Formulario de Inicio de Sesión -->
        <form method="post">
            <div class="mb-6">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Correo Electrónico</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="usuario@example.com"
                    required>
            </div>

            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Contraseña</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="********"
                    required>
            </div>

            <!-- Botón de Inicio de Sesión -->
            <button
                type="submit"
                class="w-full bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                Iniciar Sesión
            </button>
        </form>

        <!-- Enlaces Adicionales -->
        <div class="mt-6 text-center">
            <a href="#" class="text-sm text-blue-500 hover:text-blue-700">¿Olvidaste tu contraseña?</a>
        </div>

    </div>
</body>

</html>