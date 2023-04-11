<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

Route::get('/', function () {
    return view('welcome');
});

//group me sert à grouper les routes 
route::prefix('/blog')->name('blog.')->group(function(){

    Route::get('/',function(Request $request){
        // $request->pathinfo()
        // $post = new \App\Models\Post();
        // $post->titre = "premier titre ";
        // $post->slug = "mon-second-article";
        // $post->contenu = " c'estpas le contenu le plus palpitant ";
        // $post->save();
       $post =  \App\Models\Post::create([
        "titre"=>"troisième",
        "slug"=>"nouveau-titre-test",
        "contenu"=>"c'est un nouveau contenu"
       ])
       ;
    //    $post->save();
        return \App\Models\Post::all('titre',"contenu");
    })->name('index');
    //name sert à nommé les route 
    
    // where permet de conditionner la prise en compte des differents paramettres passés
    Route::get('/{slug}-{id}',function(string $slug,string $id,request $request){
        
        $post = \App\Models\Post::find($id);

        return $post;
    })->name("show")->where([
        'slug'=>'[a-z0-9\-]+',
        'id'=>'[0-9]+',
    ]);


});

