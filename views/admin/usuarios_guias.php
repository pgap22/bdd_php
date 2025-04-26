<?php
// usuarios_guias.php (View - located in /views/admin/usuarios_guias.php)
?>

<?php if (isset($_GET['message'])): ?>
    <div class="bg-<?= $_GET['type'] ?? 'green' ?>-200/50 border border-<?= $_GET['type'] ?? 'green' ?>-700 my-4 text-<?= $_GET['type'] ?? 'green' ?>-700 p-4 rounded-md font-bold">
        <p><?= $_GET["message"] ?></p>
    </div>
<?php endif ?>

<div class="bg-white rounded-lg shadow-sm p-6 mb-6">
    <h2 class="text-lg font-semibold mb-4">
        <?= isset($usuarioGuia['id_usuario']) ? 'Editar Usuario Guía' : 'Agregar Nuevo Usuario Guía' ?>
    </h2>
    <form
        method="POST"
        class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <input type="hidden" name="id_usuario" value="<?= $usuarioGuia['id_usuario'] ?? '' ?>" />
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Nombre</label>
            <input
                type="text"
                name="nombre"
                value="<?= $usuarioGuia['nombre'] ?? '' ?>"
                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Ej: Juan"
                required />
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Apellido</label>
            <input
                type="text"
                name="apellido"
                value="<?= $usuarioGuia['apellido'] ?? '' ?>"
                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Ej: Pérez"
                required />
        </div>

        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
            <input
                type="email"
                name="email"
                value="<?= $usuarioGuia['email'] ?? '' ?>"
                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Ej: juan.perez@example.com"
                required />
        </div>

        <div class="md:col-span-2 flex justify-end">
            <button
                class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600">
                <i class="bx bx-save"></i> <?= isset($usuarioGuia['id_usuario']) ? 'Actualizar Guía' : 'Guardar Guía' ?>
            </button>
        </div>
    </form>
    <?php if (!isset($usuarioGuia['id_usuario'])): ?>
        <div class="mt-4 text-sm text-gray-500">
            La creación de nuevos usuarios guía debe realizarse desde la sección de administración de usuarios.
        </div>
    <?php endif; ?>
</div>

<div class="bg-white rounded-lg shadow-sm overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                    ID
                </th>
                <th
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                    Nombre
                </th>
                <th
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                    Apellido
                </th>
                <th
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                    Email
                </th>
                <th
                    class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">
                    Acciones
                </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            <?php foreach ($usuariosGuias as $guia): ?>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        <?= $guia['id_usuario'] ?>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        <?= $guia['nombre'] ?>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        <?= $guia['apellido'] ?>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        <?= $guia['email'] ?>
                    </td>
                    <td
                        class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a
                            href="/admin/usuarios_guias.php?id_usuario=<?= $guia['id_usuario'] ?>"
                            class="text-blue-500 hover:text-blue-700 mr-2">
                            <i class="bx bx-edit"></i>
                        </a>
                        <a
                            href="/admin/usuarios_guias.php?delete=<?= $guia['id_usuario'] ?>"
                            onclick="return confirm('¿Estás seguro de que deseas eliminar a este usuario guía?')"
                            class="text-red-500 hover:text-red-700">
                            <i class="bx bx-trash"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>