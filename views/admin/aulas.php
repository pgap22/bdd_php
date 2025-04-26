<?php
// aulas.php (View - located in /views/admin/aulas.php)
?>

<?php if (isset($_GET['message'])): ?>
    <div class="bg-green-200/50 border border-green-700 my-4 text-green-700 p-4 rounded-md font-bold">
        <p><?= $_GET["message"] ?></p>
    </div>
<?php endif ?>

<div class="bg-white rounded-lg shadow-sm p-6 mb-6">
    <h2 class="text-lg font-semibold mb-4">
        <?= isset($aula['id_aula']) ? 'Editar Aula' : 'Agregar Nueva Aula' ?>
    </h2>
    <form
        method="POST"
        class="grid grid-cols-1 md:grid-cols-4 gap-4"
    >
        <input type="hidden" name="id_aula" value="<?= $aula['id_aula'] ?? '' ?>" />
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Sección del Aula</label>
            <input
                type="text"
                name="seccion"
                value="<?= $aula['seccion'] ?? '' ?>"
                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Ej: Sección A"
                required
            />
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Grado</label>
            <select
                name="id_grado"
                required
                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
                <option disabled <?= !isset($aula['id_grado']) ? 'selected' : '' ?> value="">
                    Seleccionar grado
                </option>
                <?php foreach ($grados as $gradoItem): ?>
                    <option
                        value="<?= $gradoItem['id_grado'] ?>"
                        <?= isset($aula['id_grado']) && $aula['id_grado'] == $gradoItem['id_grado'] ? 'selected' : '' ?>
                    >
                        <?= $gradoItem['nombre'] ?>
                    </option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="md:col-span-2 flex items-end">
            <button
                class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 w-full md:w-auto"
            >
                <i class="bx bx-save"></i>
                <?= isset($aula['id_aula']) ? 'Actualizar Aula' : 'Guardar Aula' ?>
            </button>
        </div>
    </form>
</div>

<div class="bg-white rounded-lg shadow-sm overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Sección</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Grado</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Acciones</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            <?php foreach ($aulas as $aulaItem): ?>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        <?= $aulaItem['seccion'] ?>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        <?= $aulaItem['nombreGrado'] ?>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a
                            href="/admin/aulas.php?id_aula=<?= $aulaItem['id_aula'] ?>"
                            class="text-blue-500 hover:text-blue-700 mr-2"
                        >
                            <i class="bx bx-edit"></i>
                        </a>
                        <a
                            href="/admin/aulas.php?delete=<?= $aulaItem['id_aula'] ?>"
                            onclick="return confirm('¿Estás seguro de que deseas eliminar esta aula?')"
                            class="text-red-500 hover:text-red-700"
                        >
                            <i class="bx bx-trash"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>