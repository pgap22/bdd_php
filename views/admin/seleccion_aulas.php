<?php
// seleccion_aulas.php (View - located in /views/admin/seleccion_aulas.php)
?>

<h1 class="text-xl font-semibold mb-4">Seleccionar Aula para Editar Usuarios</h1>

<?php if (isset($_GET['error'])): ?>
    <div class="bg-red-200/50 border border-red-700 my-4 text-red-700 p-4 rounded-md font-bold">
        <p><?= $_GET["error"] ?></p>
    </div>
<?php endif ?>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    <?php foreach ($aulas as $aula): ?>
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h3 class="text-lg font-semibold mb-2">Aula: <?= $aula['aulaNombre'] ?></h3>
            <form method="POST">
                <input type="hidden" name="id_aula" value="<?= $aula['id_aula'] ?>">
                <button
                    type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                    <i class="bx bx-edit-alt"></i> Editar Usuarios
                </button>
            </form>
        </div>
    <?php endforeach ?>
    <?php if (empty($aulas)): ?>
        <div class="col-span-full text-gray-500">No hay aulas disponibles.</div>
    <?php endif; ?>
</div>