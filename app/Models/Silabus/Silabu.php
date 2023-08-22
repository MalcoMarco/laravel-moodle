<?php

namespace App\Models\Silabus;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Silabu extends Model
{
    use HasFactory;
    use Searchable;
    protected $connection = 'mysql';
    protected $table = 'silabus';
    protected $fillable = [
        'mdl_user_id',
        'state_type_id',
        'curso_name',
        'escuela',
        'ciclo',
        'creditos',
        'horas_teoricas',
        'horas_practicas',
        'pdf_path','pdf_url'
    ];

    public function incomplete_reqs()
    {
        return $this->belongsToMany(SilabuReq::class, 'silabu_incomplete_reqs')
            ->withPivot('description');
    }


    /**
     * Get the indexable data array for the model.
     *
     * @return array<string, mixed>
     */
    public function toSearchableArray(): array {
        return [
            'curso_name' => $this->curso_name,
            'escuela' => $this->escuela,
            'ciclo' => $this->ciclo,
        ];
    }
}
