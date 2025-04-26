<?php
// editor_aula.php (View - located in /views/admin/editor_aula.php)
?>

<?php if (isset($_GET['message'])): ?>
    <div class="bg-green-200/50 border border-green-700 my-4 text-green-700 p-4 rounded-md font-bold">
        <p><?= $_GET["message"] ?></p>
    </div>
<?php endif ?>

<?php if (isset($_GET['error'])): ?>
    <div class="bg-red-200/50 border border-red-700 my-4 text-red-700 p-4 rounded-md font-bold">
        <p><?= $_GET["error"] ?></p>
    </div>
<?php endif ?>

<h1 class="text-xl font-semibold mb-4">Gestionar Usuarios del Aula: <?= $aula['seccion'] ?></h1>

<div class="bg-white rounded-lg shadow-sm p-6 mb-6">
    <h2 class="text-lg font-semibold mb-4">Agregar Usuario al Aula</h2>
    <form method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <input type="hidden" name="add_usuario" value="1">
        <input type="hidden" name="id_aula" value="<?= $aula['id_aula'] ?>">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Seleccionar Usuario</label>
            <select
                name="id_usuario"
                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                required>
                <option value="">Seleccionar usuario</option>
                <?php foreach ($usuariosDisponibles as $usuario): ?>
                    <option value="<?= $usuario['id_usuario'] ?>">
                        <?= $usuario['nombre'] ?> <?= $usuario['apellido'] ?> (<?= $usuario['rol'] ?> - <?= $usuario['email'] ?>)
                    </option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="flex items-end">
            <button
                class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 w-full md:w-auto">
                <i class="bx bx-plus"></i> Agregar al Aula
            </button>
        </div>
    </form>
</div>

<div class="bg-white rounded-lg shadow-sm overflow-hidden">
    <h2 class="text-lg font-semibold mb-4">Usuarios Actualmente en el Aula</h2>
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nombre</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Apellido</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Rol</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Acciones</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            <?php foreach ($usuariosEnAula as $usuarioAula): ?>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $usuarioAula['id_usuario'] ?></td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $usuarioAula['nombre'] ?></td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $usuarioAula['apellido'] ?></td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $usuarioAula['email'] ?></td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $usuarioAula['rol'] ?></td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <form method="POST">
                            <input type="hidden" name="remove_usuario" value="1">
                            <input type="hidden" name="id_usuarioaula" value="<?= $usuarioAula['id_usuarioaula'] ?>">
                            <button type="submit" class="text-red-500 hover:text-red-700">
                                <i class="bx bx-trash"></i> Remover
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>