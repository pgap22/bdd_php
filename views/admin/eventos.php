<?php
// eventos.php (View - located in /views/admin/eventos.php)
?>

<?php if (isset($_GET['message'])): ?>
    <div class="bg-green-200/50 border border-green-700 my-4 text-green-700 p-4 rounded-md font-bold">
        <p><?= $_GET["message"] ?></p>
    </div>
<?php endif ?>

<div class="bg-white rounded-lg shadow-sm p-6 mb-6">
    <h2 class="text-lg font-semibold mb-4">
        <?= isset($evento['id_evento']) ? 'Editar Evento' : 'Registrar Nuevo Evento' ?>
    </h2>
    <form
        method="POST"
        class="grid grid-cols-1 md:grid-cols-2 gap-4"
    >
        <input type="hidden" name="id_evento" value="<?= $evento['id_evento'] ?? '' ?>" />
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2"
                >Nombre del Evento</label
            >
            <input
                type="text"
                name="nombre"
                value="<?= $evento['nombre'] ?? '' ?>"
                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Ej: Dia de la familia"
                required
            />
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2"
                >Tipo de Evento</label
            >
            <select
                name="id_tipoEvento"
                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                required
            >
                <option value="" <?= !isset($evento['id_tipoEvento']) ? 'selected' : '' ?>>Seleccionar tipo</option>
                <?php foreach ($tiposEventos as $tipoEventoItem): ?>
                    <option
                        value="<?= $tipoEventoItem['id_tipoEvento'] ?>"
                        <?= (isset($evento['id_tipoEvento']) && $evento['id_tipoEvento'] == $tipoEventoItem['id_tipoEvento']) ? 'selected' : '' ?>
                    >
                        <?= $tipoEventoItem['nombre'] ?> (<?= $tipoEventoItem['tipoAsistencia'] === 'QR' ? 'QR' : 'Padres' ?>)
                    </option>
                <?php endforeach ?>
            </select>
        </div>

        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 mb-2"
                >Descripción</label
            >
            <textarea
                name="descripcion"
                rows="3"
                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Descripción del evento..."
                required
            ><?= $evento['descripcion'] ?? '' ?></textarea>
        </div>

        <div class="md:col-span-2 flex justify-end">
            <button
                class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600"
            >
                <i class="bx bx-save"></i> <?= isset($evento['id_evento']) ? 'Actualizar Evento' : 'Guardar Evento' ?>
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
                    Evento
                </th>
                <th
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase"
                >
                    Tipo
                </th>
                <th
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase"
                >
                    Asistencia
                </th>
                <th
                    class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase"
                >
                    Acciones
                </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            <?php foreach ($eventos as $eventoItem): ?>
                <tr>
                    <!-- <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                    </td> -->
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        <div class="font-medium"><?= $eventoItem['nombre'] ?></div>
                        <div class="text-gray-500 text-xs"><?= $eventoItem['descripcion'] ?></div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        <?= $eventoItem['tipoEventoNombre'] ?>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span
                            class="px-2 py-1 <?= $eventoItem['tipoAsistencia'] === 'QR' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800' ?> text-xs rounded-full"
                        >
                            <i class="bx <?= $eventoItem['tipoAsistencia'] === 'QR' ? 'bx-qr' : 'bx-group' ?>"></i>
                            <?= $eventoItem['tipoAsistencia'] === 'QR' ? 'QR' : 'Padre' ?>
                        </span>
                    </td>
                    <td
                        class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium"
                    >
                        <a
                            href="/admin/eventos.php?id_evento=<?= $eventoItem['id_evento'] ?>"
                            class="text-blue-500 hover:text-blue-700 mr-2"
                        >
                            <i class="bx bx-edit"></i>
                        </a>
                        <a
                            href="/admin/eventos.php?delete=<?= $eventoItem['id_evento'] ?>"
                            onclick="return confirm('¿Estás seguro de que deseas eliminar este evento?')"
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