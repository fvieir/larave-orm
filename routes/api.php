<?php

use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
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

Route::get('softDelete', function () {

    $post = Post::find(request()->get('id'));

    $post->delete();

    return Post::paginate();
});

Route::get('accessor', function () {
    $post = Post::paginate();

    return $post;
});

Route::get('accessor-titleBody', function () {
    $post = Post::find(7);

    return $post->title_and_body;
});

Route::get('casting', function () {
    $post = Post::all();

    return $post;
});


Route::get('insert', function () {
    $post = Post::create([
        'title' => 'Exemplo titulo',
        'body' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim eveniet libero deleniti praesentium totam quasi quaerat explicabo aspernatur, nulla maxime suscipit! Sunt nemo quae sed perspiciatis, placeat ad. Magni, voluptatem?',
        'user_id' => 99,
        'data' => Carbon::now(),
    ]);

    return $post;
});

Route::get('scope_local', function () {
    $post = Post::lastWeek()->get();

    return $post;
});

Route::get('scope_local_between', function () {
    $post = Post::between('10-10-2023', '12-12-2023')
        ->orderBy('created_at', 'ASC')
        ->get();

    return $post;
});
