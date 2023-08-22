<?php
namespace App\Traits;
use Illuminate\Support\Facades\DB;

trait PermissionTrait
{
    // Aquí puedes agregar los métodos y propiedades que deseas utilizar en el modelo MoodleUser

    /**
     * Get the mdl_role shortname in array .
     *
     * @return array<string, mixed>
     */
    public function roles(): array  {
        $roles =  DB::connection('dbmoodle')->table('mdl_role_assignments')
            ->join('mdl_role','mdl_role.id','mdl_role_assignments.roleid')
            ->where('userid',$this->id)
            ->where('contextid',2)
            ->select('shortname')
            ->get();
        $roles = $roles->pluck('shortname')->toArray();
        if ($this->isSiteadmin()) {
            array_push($roles,'siteadmin');
        }
        return $roles;
    }

    /**
     * user has role  .
     * @param string $role_name nombre del rol
     *
     * @return bool
     */
    function hasRole(string $role_name):bool  {
        return in_array($role_name,$this->roles());
    }

    /**
     * el usuario tiene el rol siteadmin .
     *
     * @return bool
     */
    public function isSiteadmin():bool {
        $value = DB::connection('dbmoodle')->table('mdl_config')
            ->select('value')->find(23);//[id:23, name:siteadmins, value:2,3,x....]
        $ids = explode(',',$value->value);

        return in_array($this->id,$ids);
    }

    /**
     * user permissions list .
     * @param string $ability nombre del permiso (Permissions->name)
     *
     * @return array<string, mixed>
     */
    public function permissions():array {
        $roles = DB::connection('dbmoodle')->table('mdl_role_assignments')
        ->join('mdl_role','mdl_role.id','mdl_role_assignments.roleid')
        ->join(env('DB_DATABASE').'.role_has_permissions','roleid','role_has_permissions.mdl_role_id')
        ->join(env('DB_DATABASE').'.permissions','role_has_permissions.permission_id','permissions.id')
        ->where('userid',3)
        ->where('contextid',2)
        ->get();
        $roles = array_values(array_unique($roles->pluck('name')->toArray()));
        return $roles; 
    }
    /**
     * verifica si un tiene un permiso. (el rol siteadmin tien acceso a todo)
     * @param string $ability nombre del permiso (Permissions->name)
     *
     * @return bool
     */
    public function hasPermission(string $ability):bool {
        return $this->isSiteadmin() || in_array($ability,$this->permissions());
    }

}