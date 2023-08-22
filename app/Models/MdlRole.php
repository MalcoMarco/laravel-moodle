<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MdlRole extends Model
{
    use HasFactory;
    protected $connection = 'dbmoodle';
    protected $table = 'mdl_role';
    //public $timestamps = false;
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_has_permissions');
    }
}
