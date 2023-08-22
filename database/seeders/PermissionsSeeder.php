<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /**
         * sintaxis del permission: {crud}_{permission-name}
         * c:create
         * r:read
         * u:update
         * d:delete
         */
        $data_permissions = [
            ['name'=>'cru_gestion-silabus', 'roles_ids' => [3,4]],
            ['name'=>'ru_gestion-silabus', 'roles_ids' => [1]],//revisa y aprueba los silabos

            ['name'=>'xxx_modulo_matricula_estudiante', 'roles_ids' => [1,5]],
            //['name'=>'', 'roles_ids'=> []],
            //...
        ];


        foreach ($data_permissions as $item) {
           $permision = Permission::firstOrCreate(['name' => $item['name']]);
           foreach ($item['roles_ids'] as $role) {
               DB::table('role_has_permissions')->insert([
                    'permission_id'=>$permision->id,
                    'mdl_role_id'=>$role,
                ]);
           }
        }
        
        //DB::table('permissions')->insert($permission);

    }
}