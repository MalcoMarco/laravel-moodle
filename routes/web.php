<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthAdminController;
use App\Http\Controllers\MoodleUserController;
use App\Http\Controllers\SilabuController;
use Illuminate\Support\Facades\DB;
use App\Models\MdlRole;
use App\Models\Permission;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/admincoreui', function () { 
//     return view('dashboard.home');
// });


Route::post('/logout',[AuthAdminController::class, 'logout'])->name('logout');
Route::get('/logout',[AuthAdminController::class, 'logout']);

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () { return redirect('/dashboard'); });
    Route::get('/auth', [AuthAdminController::class, 'authUser']);

    Route::get('/test', function () { 
        return 'test holi';
    })->can('crud_modulo_matricula_estudiante');

    Route::get('/dashboard', function () {
        $roles = MdlRole::get();
        $permissions = Permission::get();
        return view('dashboard.home',compact('roles','permissions'));
    })->name('dashboard');
    
    //users
    Route::get('/search_user',[MoodleUserController::class, 'search_user']);
    
    //silabus
    Route::middleware(['can:cru_gestion-silabus'])->group(function () {
        //silabus como docente
        Route::get('/silabus',[SilabuController::class, 'index'])->name('silabus.index');
        Route::get('/silabus-list',[SilabuController::class, 'list'])->name('silabus.list');
        Route::get('/silabus-create',[SilabuController::class, 'create'])->name('silabus.create');
        Route::post('/silabus-create',[SilabuController::class, 'store'])->name('silabus.store');
        Route::delete('/silabus/{silabu}',[SilabuController::class, 'destroy'])->name('silabus.destroy');


        //silabus como supervisor/admin
        Route::get('/silabus-reqs',[SilabuController::class, 'form_silabuReqs'])->name('silabuReqs.form');
        Route::get('/get-silabus-reqs',[SilabuController::class, 'list_silabuReqs']);
        Route::post('/silabus-reqs',[SilabuController::class, 'create_silabuReqs']);
        Route::post('/silabus-reqs/{silabuReq}',[SilabuController::class, 'update_silabuReqs']);
        Route::delete('/silabus-reqs/{silabuReq}',[SilabuController::class, 'destroy_silabuReqs']);
        //revision y aprobar silabo
        Route::get('/silabus-review/{silabo}',[SilabuController::class, 'review'])->name('silabus.review');
        Route::post('/silabus-review/{silabo}',[SilabuController::class, 'makereview'])->name('silabus.makereview');
        //levantar observaciones
        Route::get('/silabus-observacion/{silabo}',[SilabuController::class, 'observacion'])->name('silabus.observacion');
        Route::post('/silabus-observacion/{silabo}',[SilabuController::class, 'observacionUpdate'])->name('silabus.observacionUpdate');

    });
});
// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified'
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });
