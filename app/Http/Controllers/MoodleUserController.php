<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MoodleUser;

class MoodleUserController extends Controller
{
    /**
     * busqueda y paginacion de usuarios
     *
     * @param string $request->q query de busqueda
     * @param integer $request->per_page Cantidad de items a retornar. default 100
     * @param string $request->order_by Nombre de columna x ordenar. default 'lastname'
     * @param string $request->order_mode ASC||DES . deafult DES
     * @return paginate paginacion de usuarios
     * @throws TipoDeExcepción Descripción de la excepción lanzada
     */
    function search_user(Request $request ) {
        $query = $request->q ?? '';
        $perPage = $request->per_page ?? 100;
        $orderBy = $request->order_by ?? 'lastname';
        $orderMode = $request->order_mode ?? 'DES';
        return MoodleUser::search($query)->orderBy($orderBy , $orderMode)
        ->query(function ($builder) {
            $builder->select('id','username','firstname','lastname','email','picture','phone1','phone2','address')
            ->where('id','!=', '1'); // quita el usuario invitado
        })->paginate($perPage);

        //url default del usuario: /theme/image.php/boost/core/1689475891/u/f1
        //small avatar: "/theme/image.php/boost/core/1689475891/u/f2"
    }
    
}
