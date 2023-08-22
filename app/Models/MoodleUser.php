<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Scout\Searchable;
use Illuminate\Support\Facades\DB;
use App\Traits\PermissionTrait;
class MoodleUser  extends Authenticatable
{
    use HasFactory;
    use Searchable;
    use PermissionTrait;

    protected $connection = 'dbmoodle';
    protected $table = 'mdl_user';
    public $timestamps = false;
    
    protected $fillable = [
        'username',
        'email',
        'password',
        'firstname',
        'lastname',
        //....
    ];

    protected $hidden = [
        'password',
    ];


    /**
     * Get the indexable data array for the model.
     *
     * @return array<string, mixed>
     */
    public function toSearchableArray(): array {
        return [
            'username' => $this->username,
            'email' => $this->email,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,

        ];
    }



}
