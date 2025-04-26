<?php if (isset($_GET['message'])): ?>
    <div class="bg-green-200/50 border border-green-700 my-4 text-green-700 p-4 rounded-md font-bold">
        <p><?= $_GET["message"] ?></p>
    </div>
<?php endif ?>
<!-- Formulario -->
<div class="bg-white rounded-lg shadow-sm p-6 mb-6">
    <h2 class="text-lg font-semibold mb-4">
        <?= isset($grado['id_grado']) ? 'Editar Grado' : 'Agregar Nuevo Grado' ?>
    </h2>
    <form
        method="POST"
        class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <input type="hidden" name="id_grado" value="<?= $grado['id_grado'] ?? '' ?>" />
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Título del Grado</label>
            <input
                type="text"
                name="nombre"
                value="<?= $grado['nombre'] ?? '' ?>"
                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Ej: Primer Grado"
                required />
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Nivel Académico</label>
            <select
                name="id_nivelAcademico"
                required
                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option disabled <?= !isset($grado['id_nivelAcademico']) ? 'selected' : '' ?> value="">
                    Seleccionar nivel
                </option>
                <?php foreach ($nivelesAcademicos as $nivel): ?>
                    <option
                        value="<?= $nivel['id_nivelAcademico'] ?>"
                        <?= isset($grado['id_nivelAcademico']) && $grado['id_nivelAcademico'] == $nivel['id_nivelAcademico'] ? 'selected' : '' ?>>
                        <?= $nivel['nombre'] ?>
                    </option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="md:col-span-2 flex items-end">
            <button
                class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 w-full md:w-auto">
                <i class="bx bx-save"></i>
                <?= isset($grado['id_grado']) ? 'Actualizar Grado' : 'Guardar Grado' ?>
            </button>
        </div>
    </form>
</div>

<!-- Tabla de Grados -->
<div class="bg-white rounded-lg shadow-sm overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <!-- <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th> -->
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Título</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nivel Académico</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Acciones</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            <?php foreach ($grados as $grado): ?>
                <tr>
                    <!-- <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">

                        </td> -->
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        <?= $grado['nombre'] ?>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        <?= $grado['nivelAcademico'] ?>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a
                            href="/admin/grados.php?id_grado=<?= $grado['id_grado'] ?>"
                            class="text-blue-500 hover:text-blue-700 mr-2">
                            <i class="bx bx-edit"></i>
                        </a>
                        <a
                            href="/admin/grados.php?delete=<?= $grado['id_grado'] ?>"
                            onclick="return confirm('¿Estás seguro de que deseas eliminar este grado?')"
                            class="text-red-500 hover:text-red-700">
                            <i class="bx bx-trash"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>