<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Egresado extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'mdl_user_id',
        'especialidad',
        'programa_estudios',
        'ingreso',
        'egreso',
        'nivel',
        'parentesco',
        'fullname',
        'num_documento',
        'direccion',
        'email',
        'phone',
        'empresa',
        'ocupacion',
        'email',
        'direccion_empresa',
        'evidencia',
    ];
}
