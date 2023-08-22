<?php

namespace App\Models\Silabus;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SilabuReq extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'name',
        'orden',
    ];
}
