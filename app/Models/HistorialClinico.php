<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialClinico extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "mdl_user_id",
        "talla",
        "peso",
        "imc",
        "grupo_sanguineo",
        "alergia",
        "alergia_especifique",
        "enfermedad",
        "enfermedad_especifique",
        "fecha_consulta",
        "hora_consulta",
        "motivo",
        "examen_fisico",
        "diagnostico",
        "tratamiento",
        "observacion",
        "personal_a_cargo",
        "pa",
        "fc",
        "fr",
        "tc",
    ];
}
