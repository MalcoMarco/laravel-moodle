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

    //Add extra attribute
    protected $attributes = ['picture_url'];

    //Make it available in the json response
    protected $appends = ['picture_url'];

    //implement the attribute
    public function getPictureUrlAttribute()
    {
        $default_avatar = config('app.url_moodle')."/theme/image.php/boost/core/1689475891/u/f1";
        if ($this->picture==0) {
            return $default_avatar;
        }
        $mdl_file = DB::table(config('app.db_name_moodle').'.mdl_files')->select('id','contextid')->find($this->picture);
        if (!$mdl_file) {
            return $default_avatar;
        }

        return config('app.url_moodle')."/pluginfile.php/$mdl_file->contextid/user/icon/boost/f1?rev=$mdl_file->id";
    }

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
