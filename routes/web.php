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
  Route::get('/cache/{id}','ProductController@delete_cache');
  Route::get('/products/delete/{id}','ProductController@destroy');

  Route::get('/product_layers/data','LayerController@data');
  Route::get('/product_layers/create/{id}','LayerController@create_layer');
  Route::resource('/product_layers','LayerController');
  Route::get('/product_layers/addimages/{id}','LayerController@add_image');
  Route::post('/product_layers/addimages','LayerController@save_image');
  Route::get('/product_layers/delete/{id}','LayerController@destroy');

  Route::get('/layer_images/data','LayerImageController@data');
  Route::resource('/layer_images','LayerImageController');
  Route::get('/layer_images/delete/{id}','LayerImageController@destroy');

  Route::get('/customers/data','CustomerController@data');
  Route::resource('/customers','CustomerController');
  Route::get('/customers/delete/{id}','CustomerController@destroy');

  Route::get('/orders/data','OrderController@data');
  Route::get('/orders/items/{id}','OrderController@items');
  Route::get('/orders/details/{id}','OrderController@details');
  Route::get('/orders/assign/{id}','OrderController@assignOrder');
  Route::post('/orders/assign','OrderController@saveAssignOrder');
  Route::resource('/orders','OrderController');
  Route::get('/orders/delete/{id}','OrderController@destroy');
  Route::get('/orders/pdf/{id}','OrderController@order_pdf');

  Route::get('/employees/data','EmployeeController@data');
  Route::resource('/employees','EmployeeController');
  Route::get('/employees/delete/{id}','EmployeeController@destroy');

  Route::resource('/setting','SettingController');

  Route::get('dropzone', 'HomeController@dropzone');
  Route::post('dropzone/store', ['as'=>'dropzone.store','uses'=>'HomeController@dropzoneStore']);
  Route::get('dropzone/delete', ['as'=>'dropzone.delete','uses'=>'HomeController@dropzoneDelete']);
});

//Cart
Route::get('/add', 'CartController@AddToCart');
Route::get('/cart', ['uses'=>'CartController@Cart','as'=>'cart.show']);
Route::get('/delete_item/{id}', ['uses'=>'CartController@DeleteCartItem','as'=>'item.delete']);
Route::get('/decrease_qty/{id}', ['uses'=>'CartController@DecreaseQty','as'=>'decrease.qty']);
Route::get('/increase_qty/{id}', ['uses'=>'CartController@IncreaseQty','as'=>'increase.qty']);
Route::get('clear', ['uses'=>'CartController@Clear','as'=>'cart.clear']);

//privacy
Route::get('/privacy', 'PagesController@privacy');
//faq
Route::get('/faq', 'PagesController@faq');
//terms_conditions
Route::get('/terms_conditions', 'PagesController@terms_conditions');
//about
Route::get('/about', 'PagesController@about');
//contact
Route::get('/contact', 'PagesController@contact');
//all products
Route::get('/','PagesController@shop');
//showmore
Route::get('/showmore','PagesController@showmore');
//product
Route::get('/product/{id}/{id2?}','PagesController@product');
//change image
Route::get('/change_image/{id}/{id2}/{image_index}','PagesController@change_image');
Route::get('/change_image','PagesController@change_image');
//checkout
Route::get('/checkout','PagesController@checkout');
Route::post('/checkout','PagesController@get_checkout_data');
Route::get('/pay','PagesController@pay');
Route::get('/home', 'HomeController@index');

//language
Route::get('/lang/{locale}','PagesController@lang');

Route::get('/api/products','ApiController@get_all_product');
Route::get('/api/product/{id}/{id2?}','ApiController@get_product');
Route::get('/api/change_image','ApiController@change_image');


Route::get('/status',function(){
  $array=['new','confirmed','canceled','making','delivery','delivered'];
  foreach($array as $data){
    $status = new App\OrderStatus();
    $status->name = $data;
    $status->save();
  }
});
