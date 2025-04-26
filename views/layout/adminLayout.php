<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Sistema CECE</title>
    <link rel="stylesheet" href="/public/app.min.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 h-screen overflow-hidden">
    <div class="flex h-full">
        <!-- Sidebar -->
        <aside class="bg-gray-800 text-white w-64 flex flex-col">
            <div class="p-4 border-b border-gray-700">
                <div class="flex items-center space-x-2">
                    <span class="text-lg font-semibold">Panel Admin</span>
                </div>
            </div>
            <nav class="flex-grow p-4 overflow-y-auto">
                <ul class="space-y-2">
                    <!-- Mantenimientos -->
                    <li>
                        <a href="/admin" class="block p-2 rounded hover:bg-gray-700 <?= $activeNav == 'admin' ? 'bg-gray-700' : '' ?>">
                            <i class="bx bx-home"></i> Bienvenida
                        </a>
                    </li>
                    <li>
                        <a href="/admin/nivelesAcademicos.php" class="block p-2 rounded hover:bg-gray-700 <?= $activeNav == 'nivelesAcademicos' ? 'bg-gray-700' : '' ?>">
                            <i class="bx bx-layer"></i> Niveles Académicos
                        </a>
                    </li>
                    <li>
                        <a href="/admin/grados.php" class="block p-2 rounded hover:bg-gray-700 <?= $activeNav == 'grados' ? 'bg-gray-700' : '' ?>">
                            <i class="bx bx-certification"></i> Grados
                        </a>
                    </li>
                    <li>
                        <a href="/admin/aulas.php" class="block p-2 rounded hover:bg-gray-700 <?= $activeNav == 'aulas' ? 'bg-gray-700' : '' ?>">
                            <i class="bx bxs-graduation"></i> Aula
                        </a>
                    </li>
                    <li>
                        <a href="/admin/tipos_eventos.php" class="block p-2 rounded hover:bg-gray-700 <?= $activeNav == 'tipos_eventos' ? 'bg-gray-700' : '' ?>">
                            <i class="bx bx-calendar-event"></i> Tipos de Evento
                        </a>
                    </li>
                    <li>
                        <a href="/admin/eventos.php" class="block p-2 rounded hover:bg-gray-700 <?= $activeNav == 'eventos' ? 'bg-gray-700' : '' ?>">
                            <i class="bx bx-star"></i> Eventos
                        </a>
                    </li>
                    <li>
                        <a href="/admin/convocatorias_generales.php" class="block p-2 rounded hover:bg-gray-700 <?= $activeNav == 'convocatoriaGeneral' ? 'bg-gray-700' : '' ?>">
                            <i class="bx bx-line-chart"></i> Convocatoria General
                        </a>
                    </li>
                    <li>
                        <a href="/admin/convocatorias_especificas.php" class="block p-2 rounded hover:bg-gray-700 <?= $activeNav == 'convocatoriaEspecifica' ? 'bg-gray-700' : '' ?>">
                            <i class="bx bx-line-chart"></i> Convocatoria Especifica
                        </a>
                    </li>
                    <li>
                        <a href="/admin/usuarios_guias.php" class="block p-2 rounded hover:bg-gray-700 <?= $activeNav == 'usuarios_guias' ? 'bg-gray-700' : '' ?>">
                            <i class="bx bx-group"></i> Usuarios Guías
                        </a>
                    </li>
                    <li>
                        <a href="/admin/seleccion_aulas.php" class="block p-2 rounded hover:bg-gray-700 <?= $activeNav == 'aulas' ? 'bg-gray-700' : '' ?>">
                            <i class="bx bx-edit-alt"></i> Gestionar Aulas
                        </a>
                    </li>


                    <!-- Reportes -->
                    <li class="pt-4">
                        <span class="text-xs text-gray-400 uppercase">Reportes</span>
                    </li>
                    <li>
                        <a href="#" class="block p-2 rounded hover:bg-gray-700 <?= $activeNav == 'asistenicasConovocatoria' ? 'bg-gray-700' : '' ?>">
                            <i class="bx bx-table"></i> Asistencias Convocatoria
                        </a>
                    </li>
                    <li>
                        <a href="#" class="block p-2 rounded hover:bg-gray-700 <?= $activeNav == 'repEstudiantes' ? 'bg-gray-700' : '' ?>">
                            <i class="bx bx-group"></i> Reporte de estudiantes
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- Perfil -->
            <div class="p-4 border-t border-gray-700">
                <div class="flex items-center space-x-3">
                    <div class="h-10 w-10 rounded-full bg-blue-500 flex items-center justify-center">
                        <i class="bx bx-user text-white"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium"><?= $_SESSION['usuario']['nombre'] ?></p>
                        <p class="text-xs text-gray-400"><?= $_SESSION['usuario']['email'] ?></p>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Contenido Principal -->
        <div class="flex-1 flex flex-col overflow-y-auto">
            <header class="bg-white shadow-sm p-4">
                <h1 class="text-xl font-semibold text-gray-800">
                    <i class="bx bx-home"></i> Bienvenido al Panel de Administración
                </h1>
            </header>

            <main class="p-6">
                <?php include $view ?? '' ?>
            </main>
        </div>
    </div>
</body>

</html>