<?php if (isset($_GET['message'])): ?>
    <div class="bg-green-200/50 border border-green-700 my-4 text-green-700 p-4 rounded-md font-bold">
        <p><?= $_GET["message"] ?></p>
    </div>
<?php endif ?>
<!-- Formulario -->
<div class="bg-white rounded-lg shadow-sm p-6 mb-6">
    <h2 class="text-lg font-semibold mb-4">Agregar Nuevo Nivel</h2>

    <form method="post" class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Título del Nivel</label>
            <input type="text" name="id_nivelAcademico" hidden value=<?= $nivel['id_nivelAcademico'] ?? '' ?>>
            <input type="text"
                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Ej: Bachillerato General"
                name="nombre"
                value="<?= $nivel['nombre'] ?? '' ?>"
                required>
        </div>
        <div class="md:col-span-2 flex items-end">
            <button class="bg-blue-500 text-white px-6 cursor-pointer py-2 rounded-lg hover:bg-blue-600 w-full md:w-auto">
                <i class="bx bx-save"></i> Guardar Nivel
            </button>
        </div>
    </form>
</div>

<!-- Tabla de Niveles -->
<div class="bg-white rounded-lg shadow-sm overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Título</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Acciones</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            <!-- Ejemplo de datos -->
            <?php foreach ($nivelesAcademicos as $nivelAcademico): ?>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $nivelAcademico['nombre'] ?></td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a href="/admin/nivelesAcademicos.php?id_nivelAcademico=<?= $nivelAcademico['id_nivelAcademico'] ?>">
                            <button class="text-blue-500 hover:text-blue-700 mr-2 cursor-pointer">
                                <i class="bx bx-sm bx-edit"></i>
                            </button>
                        </a>
                        <a href="/admin/nivelesAcademicos.php?delete=<?= $nivelAcademico['id_nivelAcademico'] ?>">
                            <button class=" text-red-500 cursor-pointer hover:text-red-700">
                            <i class="bx bx-sm bx-trash"></i>
                            </button>
                        </a>
                    </td>
                </tr>
            <?php endforeach ?>
            <!-- <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">1</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Educación Básica</td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <button class="text-blue-500 hover:text-blue-700 mr-2">
                        <i class="bx bx-edit"></i>
                    </button>
                    <button class="text-red-500 hover:text-red-700">
                        <i class="bx bx-trash"></i>
                    </button>
                </td>
            </tr>
            <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">2</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Bachillerato Técnico</td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <button class="text-blue-500 hover:text-blue-700 mr-2">
                        <i class="bx bx-edit"></i>
                    </button>
                    <button class="text-red-500 hover:text-red-700">
                        <i class="bx bx-trash"></i>
                    </button>
                </td>
            </tr>
            <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">3</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Educación Parvularia</td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <button class="text-blue-500 hover:text-blue-700 mr-2">
                        <i class="bx bx-edit"></i>
                    </button>
                    <button class="text-red-500 hover:text-red-700">
                        <i class="bx bx-trash"></i>
                    </button>
                </td>
            </tr> -->
        </tbody>
    </table>
</div>