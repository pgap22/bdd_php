<?php
// convocatorias_especificas.php (View - located in /views/admin/convocatorias_especificas.php)
?>

<?php if (isset($_GET['message'])): ?>
    <div class="bg-green-200/50 border border-green-700 my-4 text-green-700 p-4 rounded-md font-bold">
        <p><?= $_GET["message"] ?></p>
    </div>
<?php endif ?>

<div class="bg-white rounded-lg shadow-sm p-6 mb-6">
    <h2 class="text-lg font-semibold mb-4">
        <?= isset($convocatoriaEspecifica['id_convocatoriaEspecifica']) ? 'Editar Convocatoria Específica' : 'Nueva Convocatoria Específica' ?>
    </h2>
    <form
        method="POST"
        class="grid grid-cols-1 md:grid-cols-2 gap-4"
    >
        <input type="hidden" name="id_convocatoriaEspecifica" value="<?= $convocatoriaEspecifica['id_convocatoriaEspecifica'] ?? '' ?>" />
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2"
                >Evento</label
            >
            <select
                name="id_evento"
                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                required
            >
                <option value="" <?= !isset($convocatoriaEspecifica['id_evento']) ? 'selected' : '' ?>>Seleccionar evento</option>
                <?php foreach ($eventos as $eventoItem): ?>
                    <option
                        value="<?= $eventoItem['id_evento'] ?>"
                        <?= (isset($convocatoriaEspecifica['id_evento']) && $convocatoriaEspecifica['id_evento'] == $eventoItem['id_evento']) ? 'selected' : '' ?>
                    >
                        <?= $eventoItem['nombre'] ?> (<?= $eventoItem['tipoAsistencia'] === 'QR' ? 'QR' : 'Padres' ?>)
                    </option>
                <?php endforeach ?>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2"
                >Aula</label
            >
            <select
                name="id_aula"
                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                required
            >
                <option value="" <?= !isset($convocatoriaEspecifica['id_aula']) ? 'selected' : '' ?>>Seleccionar aula</option>
                <?php foreach ($aulas as $aulaItem): ?>
                    <option
                        value="<?= $aulaItem['id_aula'] ?>"
                        <?= (isset($convocatoriaEspecifica['id_aula']) && $convocatoriaEspecifica['id_aula'] == $aulaItem['id_aula']) ? 'selected' : '' ?>
                    >
                        <?= $aulaItem['seccion'] ?> | <?= $aulaItem['nombreGrado'] ?>
                    </option>
                <?php endforeach ?>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2"
                >Fecha y Hora</label
            >
            <input
                type="datetime-local"
                name="fecha"
                value="<?= isset($convocatoriaEspecifica['fecha']) ? date('Y-m-d\TH:i', strtotime($convocatoriaEspecifica['fecha'])) : '' ?>"
                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                required
            />
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2"
                >Lugar</label
            >
            <input
                type="text"
                name="lugar"
                value="<?= $convocatoriaEspecifica['lugar'] ?? '' ?>"
                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Ej: Aula Magna"
                required
            />
        </div>

        <div class="md:col-span-2 flex justify-end">
            <button
                class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600"
            >
                <i class="bx bx-save"></i> <?= isset($convocatoriaEspecifica['id_convocatoriaEspecifica']) ? 'Actualizar Convocatoria' : 'Programar Convocatoria' ?>
            </button>
        </div>
    </form>
</div>

<div class="bg-white rounded-lg shadow-sm overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase"
                >
                    Evento
                </th>
                <th
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase"
                >
                    Aula
                </th>
                <th
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase"
                >
                    Fecha/Hora
                </th>
                <th
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase"
                >
                    Lugar
                </th>
                <th
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase"
                >
                    Tipo
                </th>
                <th
                    class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase"
                >
                    Acciones
                </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            <?php foreach ($convocatoriasEspecificas as $convocatoria): ?>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        <div class="font-medium"><?= $convocatoria['eventoNombre'] ?></div>
                        <div class="text-xs text-gray-500"><?= $convocatoria['eventoDescripcion'] ?></div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        <?= $convocatoria['aulaSeccion'] ?> | <?= $convocatoria['gradoNombre'] ?>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        <?= date('d/m/Y H:i', strtotime($convocatoria['fecha'])) ?>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        <?= $convocatoria['lugar'] ?>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span
                            class="px-2 py-1 <?= $convocatoria['eventoTipoAsistencia'] === 'QR' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800' ?> text-xs rounded-full"
                        >
                            <i class="bx <?= $convocatoria['eventoTipoAsistencia'] === 'QR' ? 'bx-qr' : 'bx-group' ?>"></i>
                            <?= $convocatoria['eventoTipoAsistencia'] === 'QR' ? 'QR' : 'Padre' ?>
                        </span>
                    </td>
                    <td
                        class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium"
                    >
                        <a
                            href="/admin/convocatorias_especificas.php?id_convocatoriaEspecifica=<?= $convocatoria['id_convocatoriaEspecifica'] ?>"
                            class="text-blue-500 hover:text-blue-700 mr-2"
                        >
                            <i class="bx bx-edit"></i>
                        </a>
                        <a
                            href="/admin/convocatorias_especificas.php?delete=<?= $convocatoria['id_convocatoriaEspecifica'] ?>"
                            onclick="return confirm('¿Estás seguro de que deseas eliminar esta convocatoria específica?')"
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