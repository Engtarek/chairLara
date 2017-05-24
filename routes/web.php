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
Auth::routes();
Route::group(['prefix' => 'admin','middleware' => ['auth', 'is-admin']], function () {

  Route::get('/products/data','ProductController@data');
  Route::resource('/products','ProductController');

  Route::get('/product_layers/data','LayerController@data');
  Route::get('/product_layers/create/{id}','LayerController@create_layer');
  Route::resource('/product_layers','LayerController');
  Route::get('/product_layers/addimages/{id}','LayerController@add_image');
  Route::post('/product_layers/addimages','LayerController@save_image');

  Route::get('/layer_images/data','LayerImageController@data');
  Route::resource('/layer_images','LayerImageController');


  Route::get('/customers/data','CustomerController@data');
  Route::resource('/customers','CustomerController');

  Route::get('/orders/data','OrderController@data');
  Route::get('/orders/items/{id}','OrderController@items');
    Route::get('/orders/details/{id}','OrderController@details');
    Route::get('/orders/assign/{id}','OrderController@assignOrder');
    Route::post('/orders/assign','OrderController@saveAssignOrder');
  Route::resource('/orders','OrderController');

  Route::get('/employees/data','EmployeeController@data');
  Route::resource('/employees','EmployeeController');

});

//product
Route::get('/','TestController@show_product');
Route::get('/product/{id}/{id2?}','TestController@product');

//Cart
Route::get('/add/{id}/{id2}/{id3}', 'CartController@AddToCart');
Route::get('/cart', [
  'uses'=>'CartController@Cart',
  'as'=>'cart.show'
]);
Route::get('/delete_item/{id}', [
    'uses'=>'CartController@DeleteCartItem',
    'as'=>'item.delete'
]);
Route::get('/decrease_qty/{id}', [
  'uses'=>'CartController@DecreaseQty',
  'as'=>'decrease.qty'
]);
Route::get('/increase_qty/{id}', [
  'uses'=>'CartController@IncreaseQty',
  'as'=>'increase.qty'
]);
Route::get('clear', [
  'uses'=>'CartController@Clear',
  'as'=>'cart.clear'
]);

Route::get('checkout', [
  'uses'=>'CartController@checkout',
]);


Route::post('test', [
  'uses'=>'CartController@test',
]);
//create PDF
Route::get('/order','TestController@order');
Route::get('/orderpdf','TestController@orderpdf');

//user

Route::get('/user/login', 'UserController@login');
Route::post('/user/login', 'UserController@save_login');
Route::get('/user/register', 'UserController@register');
Route::post('/user/register', 'UserController@save_register');
Route::get('/user/logout', 'UserController@logout');

Route::get('/home', 'HomeController@index');

Route::get('/status',function(){
  $array=['new','confirmed','canceled','making','delivery','delivered'];
  foreach($array as $data){
    $status = new App\OrderStatus;
    $status->name = $data;
    $status->save();
  }
});
