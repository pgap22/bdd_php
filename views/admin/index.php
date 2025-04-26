       <!-- Estadísticas Rápidas -->
       <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
           <div class="bg-white p-6 rounded-lg shadow-sm">
               <div class="flex items-center justify-between">
                   <div>
                       <p class="text-sm text-gray-600">Total Estudiantes</p>
                       <p class="text-2xl font-semibold"><?=$totalEstudiantes ?></p>
                   </div>
                   <i class="bx bx-user text-3xl text-blue-500"></i>
               </div>
           </div>
           <div class="bg-white p-6 rounded-lg shadow-sm">
               <div class="flex items-center justify-between">
                   <div>
                       <p class="text-sm text-gray-600">Convocatorias Generales</p>
                       <p class="text-2xl font-semibold"><?=$totalConvocatoriasGenerales ?></p>
                   </div>
                   <i class="bx bx-calendar-event text-3xl text-green-500"></i>
               </div>
           </div>
           <div class="bg-white p-6 rounded-lg shadow-sm">
               <div class="flex items-center justify-between">
                   <div>
                       <p class="text-sm text-gray-600">Convocatorias Especificas</p>
                       <p class="text-2xl font-semibold"><?=$totalConvocatoriasEspecifica ?></p>
                   </div>
                   <i class="bx bx-bullhorn text-3xl text-purple-500"></i>
               </div>
           </div>
       </div>

       <!-- Accesos Rápidos -->
       <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
           <h2 class="text-lg font-semibold mb-4">Acciones Rápidas</h2>
           <div class="grid grid-cols-2 md:grid-cols-2 gap-4">
               <a href="#" class="p-4 text-center border border-gray-200 rounded-lg hover:bg-gray-50">
                   <i class="bx bx-plus text-2xl text-blue-500"></i>
                   <p class="text-sm mt-2">Nuevo Evento</p>
               </a>
               <a href="#" class="p-4 text-center border border-gray-200 rounded-lg hover:bg-gray-50">
                   <i class="bx bx-file text-2xl text-green-500"></i>
                   <p class="text-sm mt-2">Generar Reporte de Asistencias</p>
               </a>
               <!-- <a href="#" class="p-4 text-center border rounded-lg hover:bg-gray-50">
                   <i class="bx bx-user-plus text-2xl text-purple-500"></i>
                   <p class="text-sm mt-2">Agregar Usuario</p>
               </a> -->
           </div>
       </div>