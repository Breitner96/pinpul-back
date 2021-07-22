<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'ver-categorías','mostrar-categoría','actualizar-categoría','borrar-categoría',
            'ver-países','mostrar-país','actualizar-país','borrar-país',
            'ver-ciudades','mostrar-ciudad','actualizar-ciudad','borrar-ciudad',
            'ver-planes','mostrar-plan','actualizar-plan','borrar-plan',
            'ver-servicios','mostrar-servicio','actualizar-servicio','borrar-servicio',
            'ver-tipos-de-documentos','mostrar-tipo-de-documento','actualizar-tipo-de-documento','borrar-tipo-de-documento',
            'ver-tipos-de-compañías','mostrar-tipo-de-compañia','actualizar-tipo-de-compañia','borrar-tipo-de-compañia',
            'ver-tipos-de-clientes','mostrar-tipo-de-cliente','actualizar-tipo-de-cliente','borrar-tipo-de-cliente',
            'ver-promociones','mostrar-promocion','actualizar-promocion','borrar-promocion',
            'ver-proveedores','mostrar-proveedor','actualizar-proveedor','borrar-proveedor',
            'ver-usuarios','mostrar-usuario','actualizar-usuario','borrar-usuario',
            'ver-comentarios','mostrar-comentario','actualizar-comentario','borrar-comentario',
            'ver-roles','mostrar-rol','actualizar-rol','borrar-rol',
            'ver-permisos','mostrar-permiso','actualizar-permiso','borrar-permiso',
            'ver-calificaciones','mostrar-calificación','actualizar-calificación','borrar-calificación',
        ];

        for($i= 0; $i <= count($permissions) - 1; $i++){
            Permission::create([
                'name' => $permissions[$i],
                'guard_name' => 'api',
            ]);
        }
    }
}
