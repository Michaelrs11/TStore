<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Route si admin
Route::get('/admin', function(){
    //tinggal manggil blade buat admin
    return 'You are admin';
})->middleware(['auth','auth.admin']);

//manggil user controller, ada except maksudnya yg di except ngga ush di panggil
Route::namespace('Admin')->prefix('admin')->middleware(['auth','auth.admin'])->name('admin.')->group(function(){
    Route::resource('/users','UserController',['except'=>['show','create','store']]);
});

//category
Route::group(['prefix' => 'category', 'middleware' => 'auth'], function(){

        //balik ke tampilan
        Route::get('index', 'CategoryController@index')->name('category.index'); 
        //membuat category
        Route::get('create', 'CategoryController@create')->name('category.create'); 
        //edit categorynya
        Route::get('{id}/edit', 'CategoryController@edit')->name('category.edit'); 
        //data yang diedit diubah menjadi edit
        Route::post('{id}/update', 'CategoryController@update')->name('category.update'); 
        //menghapus category
        Route::post('{id}/destroy', 'CategoryController@destroy')->name('category.destroy'); 
        //simpan datanya
        Route::post('store', 'CategoryController@store')->name('category.store'); 
});

//product
Route::group(['prefix' => 'fashion', 'middleware' => 'auth'], function(){
    //buat pisahin berdasarkan nama category
    Route::get('/category/{name}', 'FashionController@group')->name('fashion.group'); 
    //buat ngeadd produk
    Route::get('create', 'FashionController@create')->name('fashion.create'); 
    //edit produk
    Route::get('{id}/edit', 'FashionController@edit')->name('fashion.edit'); 
    // update produk
    Route::post('{id}/update', 'FashionController@update')->name('fashion.update'); 
    //delete produk
    Route::post('{id}/destroy', 'FashionController@destroy')->name('fashion.destroy');
     //simpan produk
    Route::post('store', 'FashionController@store')->name('fashion.store'); 
    //melihat detail produknya
    Route::get('{id}/show', 'FashionController@show')->name('fashion.view'); 

});
//transaction
Route::group(['prefix' => 'transaction', 'middleware' => 'auth'], function(){
    //save
    Route::post('store', 'TransactionController@store')->name('transaction.store');
    //tampilin data
    Route::get('index','TransactionController@index')->name('transaction.index');

});

//cart
Route::group(['prefix' =>'cart','middleware' => 'auth'],function(){
    //tampilin cart
    Route::get('index','CartController@index')->name('cart.index');
    //detail cartnya
    Route::get('view','CartController@view')->name('cart.view');
    //simpan cart
    Route::post('store','CartController@store')->name('cart.store');
    //hapus cart
    Route::post('{id}/delete','CartController@destroy')->name('cart.delete');
});


//route bagian store
Route::group(['prefix' => 'store', 'middleware' => 'auth'], function(){

    //index buat tampilan awalnya
	Route::get('index', 'StoreController@index')->name('store.index'); 
    //create buat ngecreate storenya
    Route::get('create', 'StoreController@create')->name('store.create'); 
    //edit buat ngedit
    Route::get('{id}/edit', 'StoreController@edit')->name('store.edit'); 
    //update buat ngecek validasi di method update dan nge update
    Route::post('{id}/update', 'StoreController@update')->name('store.update');
    //destroy buat ngapus
    Route::post('{id}/destroy', 'StoreController@destroy')->name('store.destroy'); 
    //store buat simpen datanya
    Route::post('store', 'StoreController@store')->name('store.store'); 

});

//buat ngedit profile
Route::group(['prefix' => 'profile', 'middleware' => 'auth'], function()
{
    //edit profile
    Route::get('edit', 'ProfileController@edit')->name('profile.edit');
    //update datanya
    Route::post('update', 'ProfileController@update')->name('profile.update');
});

