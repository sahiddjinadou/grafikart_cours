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

//la bonne mani_re de recuperer des données par url Request http
//plusieur methode util url() , la methode path() et All()
// lorsqu'il s'agit de recuperer des information oublions les $post $get
// where nouspermet de rajouterdes contraintes
// on peut grouper les liens
//eloquent
//\App\Models\Post::all([je met les champs souhaités]); je recupere tous les éléments de la table post
// \App\Models\Post::find(2) ca filtre et renvoie l'element trouvé findOfail
//first() recupere le premier element et get() recupere tous les elemnts la methode delete() permet de supprimer save() permet d'enregistrer exist() verifie si l'element est dans la base de donnée

Route::prefix('/blog')->name('blog.')->group(function (){

    Route::get('/',function(Request $request){
        // dd($request);
        $post = \App\Models\Post::paginate(3);

        return $post;
        return [
            "link"=>\route('blog.show',['slug'=>'papa','id'=>'12']) ,
            // "nom"=>$_GET["nom"],//mauvaise methode
            "chemin"=>$request->input("nom", "djinadou"),//bonne methode ;le deuxime param est la valeur par defeaut du param  nom
        ];
    })->name('index');

    Route::get('/{slug}-{id}',function(string $slug,string $id,request $request){
        $post =\App\Models\Post::find($id);
        if($post->slug != $slug ){
            return to_route('blog.show',['slug'=>$post->slug,'id'=>$post->id]);
        }
        return $post;
    })->where([
        'id'=>'[0-9]+',
        'slug'=>'[a-zA-Z\-]+',
    ])->name('show');


});


















// //group me sert à grouper les routes
// route::prefix('/blog')->name('blog.')->group(function(){

//     Route::get('/',function(Request $request){
//         // $request->pathinfo()
//         // $post = new \App\Models\Post();
//         // $post->titre = "premier titre ";
//         // $post->slug = "mon-second-article";
//         // $post->contenu = " c'estpas le contenu le plus palpitant ";
//         // $post->save();
//        $post =  \App\Models\Post::create([
//         "titre"=>"troisième",
//         "slug"=>"nouveau-titre-test",
//         "contenu"=>"c'est un nouveau contenu"
//        ])
//        ;
//     //    $post->save();
//         return \App\Models\Post::all('titre',"contenu");
//     })->name('index');
//     //name sert à nommé les route

//     // where permet de conditionner la prise en compte des differents paramettres passés
//     Route::get('/{slug}-{id}',function(string $slug,string $id,request $request){

//         $post = \App\Models\Post::find($id);

//         return $post;
//     })->name("show")->where([
//         'slug'=>'[a-z0-9\-]+',
//         'id'=>'[0-9]+',
//     ]);


// });

