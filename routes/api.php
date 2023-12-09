<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('select', function () {
    // $user = User::where('id', 101)->firstOrFail();

    // $user = User::where('id', 101)->first;
    // Combinação de where com fisrt101
    $user = User::firstWhere('id', '<=', 100);

    dd($user);
});

Route::get('where', function (User $user) {
    $users = $user->where('name', '=', request()->get('name'))
        ->orWhere(function ($query) {
            $query->where('email', '<>', 'teste@gmail.com');
            $query->where('email', '<>', 'outro@gmail.com');
        })
        ->toSql();

    dd($users);
});

Route::get('paginacao', function () {
    $users = User::where('email', 'LIKE', '%@%')->paginate(5);

    return $users;
});

Route::get('orderby', function () {
    $users = User::orderBy('name', 'DESC')->get();

    return $users;
});
