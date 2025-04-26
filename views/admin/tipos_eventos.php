<?php
// tipos_eventos.php (View - located in /views/admin/tipos_eventos.php)
?>

<?php if (isset($_GET['message'])): ?>
    <div class="bg-green-200/50 border border-green-700 my-4 text-green-700 p-4 rounded-md font-bold">
        <p><?= $_GET["message"] ?></p>
    </div>
<?php endif ?>

<div class="bg-white rounded-lg shadow-sm p-6 mb-6">
    <h2 class="text-lg font-semibold mb-4">
        <?= isset($tipoEvento['id_tipoEvento']) ? 'Editar Tipo de Evento' : 'Agregar Nuevo Tipo de Evento' ?>
    </h2>
    <form
        method="POST"
        class="grid grid-cols-1 md:grid-cols-3 gap-4"
    >
        <input type="hidden" name="id_tipoEvento" value="<?= $tipoEvento['id_tipoEvento'] ?? '' ?>" />
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2"
                >Nombre</label
            >
            <input
                type="text"
                name="nombre"
                value="<?= $tipoEvento['nombre'] ?? '' ?>"
                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Ej: Actividad Cultural"
                required
            />
        </div>

        <div class="space-y-2">
            <label class="block text-sm font-medium text-gray-700 mb-2"
                >Tipo de Asistencia</label
            >
            <div class="flex flex-col space-y-2">
                <label class="inline-flex items-center">
                    <input
                        type="radio"
                        name="tipoAsistencia"
                        value="QR"
                        class="h-4 w-4 text-blue-500 border-gray-300 focus:ring-blue-500"
                        <?= (isset($tipoEvento['tipoAsistencia']) && $tipoEvento['tipoAsistencia'] === 'QR') ? 'checked' : (!isset($tipoEvento['tipoAsistencia']) ? 'checked' : '') ?>
                    />
                    <span class="ml-2 text-sm">Solo QR Estudiante</span>
                </label>
                <label class="inline-flex items-center">
                    <input
                        type="radio"
                        name="tipoAsistencia"
                        value="PADRE_FAMILIA"
                        class="h-4 w-4 text-blue-500 border-gray-300 focus:ring-blue-500"
                        <?= (isset($tipoEvento['tipoAsistencia']) && $tipoEvento['tipoAsistencia'] === 'PADRE_FAMILIA') ? 'checked' : '' ?>
                    />
                    <span class="ml-2 text-sm">Solo Padre de Familia</span>
                </label>
            </div>
        </div>

        <div class="md:col-span-3 flex justify-end">
            <button
                class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600"
            >
                <i class="bx bx-save"></i> <?= isset($tipoEvento['id_tipoEvento']) ? 'Actualizar' : 'Guardar' ?>
            </button>
        </div>
    </form>
</div>
<div class="bg-white rounded-lg shadow-sm overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <!-- <th
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase"
                >
                    ID
                </th> -->
                <th
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase"
                >
                    Tipo de Evento
                </th>
                <th
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase"
                >
                    Asistencia Requerida
                </th>
                <th
                    class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase"
                >
                    Acciones
                </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            <?php foreach ($tiposEventos as $tipoEventoItem): ?>
                <tr>
                
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        <?= $tipoEventoItem['nombre'] ?>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span
                            class="px-2 py-1 <?php echo $tipoEventoItem['tipoAsistencia'] === 'QR' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800'; ?> text-xs rounded-full"
                        >
                            <i class="bx <?php echo $tipoEventoItem['tipoAsistencia'] === 'QR' ? 'bx-qr' : 'bx-group'; ?>"></i>
                            <?= $tipoEventoItem['tipoAsistencia'] === 'QR' ? 'QR' : 'Padre' ?>
                        </span>
                    </td>
                    <td
                        class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium"
                    >
                        <a
                            href="/admin/tipos_eventos.php?id_tipoEvento=<?= $tipoEventoItem['id_tipoEvento'] ?>"
                            class="text-blue-500 hover:text-blue-700 mr-2"
                        >
                            <i class="bx bx-edit"></i>
                        </a>
                        <a
                            href="/admin/tipos_eventos.php?delete=<?= $tipoEventoItem['id_tipoEvento'] ?>"
                            onclick="return confirm('¿Estás seguro de que deseas eliminar este tipo de evento?')"
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