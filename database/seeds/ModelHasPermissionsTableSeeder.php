<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class ModelHasPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissionsGerente = [
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
        $rol = Role::find(1);
        $rol->givePermissionTo($permissionsGerente);

        $permissionsAdmin = [
            'ver-categorías','mostrar-categoría','actualizar-categoría','borrar-categoría',
            'ver-países','mostrar-país','actualizar-país','borrar-país',
            'ver-ciudades','mostrar-ciudad','actualizar-ciudad','borrar-ciudad',
            'ver-servicios','mostrar-servicio','actualizar-servicio','borrar-servicio',
            'ver-tipos-de-documentos','mostrar-tipo-de-documento','actualizar-tipo-de-documento','borrar-tipo-de-documento',
            'ver-tipos-de-compañías','mostrar-tipo-de-compañia','actualizar-tipo-de-compañia','borrar-tipo-de-compañia',
            'ver-tipos-de-clientes','mostrar-tipo-de-cliente','actualizar-tipo-de-cliente','borrar-tipo-de-cliente',
            'ver-promociones','mostrar-promocion','actualizar-promocion','borrar-promocion',
            'ver-proveedores','mostrar-proveedor','actualizar-proveedor','borrar-proveedor',
            'ver-usuarios','mostrar-usuario','actualizar-usuario','borrar-usuario',
            'ver-comentarios','mostrar-comentario','actualizar-comentario','borrar-comentario',
        ];
        $rol = Role::find(2);
        $rol->givePermissionTo($permissionsAdmin);

        $permissionsFinanciero = [
            'ver-planes','mostrar-plan','actualizar-plan','borrar-plan',
            'ver-promociones','mostrar-promocion','actualizar-promocion','borrar-promocion',
            'ver-proveedores','mostrar-proveedor','actualizar-proveedor','borrar-proveedor',
        ];
        $rol = Role::find(3);
        $rol->givePermissionTo($permissionsFinanciero);

        $permissionsAtencionAlClinte = [
            'ver-proveedores','mostrar-proveedor','actualizar-proveedor','borrar-proveedor',
            'ver-usuarios','mostrar-usuario','actualizar-usuario','borrar-usuario',
            'ver-comentarios','mostrar-comentario','actualizar-comentario','borrar-comentario',
        ];
        $rol = Role::find(4);
        $rol->givePermissionTo($permissionsAtencionAlClinte);
    }
}
