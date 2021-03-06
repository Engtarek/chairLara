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

  // Route::get('/api_tokens/data','ApiTokenController@data');
  // Route::resource('/api_tokens','ApiTokenController');
  // Route::get('/api_tokens/delete/{id}','ApiTokenController@destroy');


  Route::resource('/setting','SettingController');

  Route::get('/users/delete/{id}','UserController@destroy');
  Route::get('/users/data','UserController@data');
  Route::resource('/users','UserController');


  Route::get('/licenses/{id}','LicenseController@all_license');
  Route::get('/licenses/delete/{id}','LicenseController@destroy');
  Route::get('/licenses/create/{user_id}','LicenseController@create_license');
  Route::get('/create_new_user','LicenseController@create_new_user');
  Route::post('/create_new_user','LicenseController@save_new_user');
  Route::get('/enable_update/{id}','LicenseController@enable_update');
  Route::resource('/licenses','LicenseController');

  Route::get('dropzone', 'HomeController@dropzone');
  Route::post('dropzone/store', ['as'=>'dropzone.store','uses'=>'HomeController@dropzoneStore']);
  Route::get('dropzone/delete', ['as'=>'dropzone.delete','uses'=>'HomeController@dropzoneDelete']);
  Route::get('outh/api', 'HomeController@outh_api');


});

Route::get('/admin/register','UserController@register');
Route::post('/admin/register','UserController@save_reqister');
Route::get('/admin/login','UserController@login');
Route::post('/admin/login','UserController@save_login');

Route::get('/change_password','UserController@change_password');
Route::post('/save_change_password','UserController@save_change_password');

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
Route::get('/wp/','PagesController@wp_shop');
//showmore
Route::get('/showmore','PagesController@showmore');
//product
Route::get('/product/{id}/{id2?}','PagesController@product');
Route::get('/wp/product/{id}/{id2?}','PagesController@wp_product');
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
//API
Route::get('/api/product/{id}/{id2?}','ApiController@get_product');
Route::get('/api/change_image','ApiController@change_image');
//API PRODUCT
Route::get('/api/products','ApiController@get_all_product');
Route::post('/api/save_product','ApiController@save_product');
Route::post('/api/update_product','ApiController@update_product');
Route::get('/api/delete_product/{id}','ApiController@delete_product');
Route::get('/api/show_pro/{id}','ApiController@show_pro');
// Route::get('/api/get_woo_product','ApiController@get_woo_product');
//API LAYER
Route::post('/api/save_layer','ApiController@save_layer');
Route::get('/api/get_woo_layer','ApiController@get_woo_layer');
Route::get('/api/delete_layer/{id}','ApiController@delete_layer');
Route::get('/api/show_layer/{id}','ApiController@show_layer');
Route::post('/api/update_layer','ApiController@update_layer');
//API IMAGES
Route::get('/api/get_image','ApiController@get_image');
Route::get('/api/delete_image/{id}','ApiController@delete_image');
Route::get('/api/show_image/{id}','ApiController@show_image');
Route::post('/api/save_image','ApiController@save_image');
Route::post('/api/update_image','ApiController@update_image');
Route::get('/api/check_token','ApiController@check_token');
Route::post('/api/check_license','ApiController@check_license');

Route::get('/status',function(){
  $array=['new','confirmed','canceled','making','delivery','delivered'];
  foreach($array as $data){
    $status = new App\OrderStatus();
    $status->name = $data;
    $status->save();
  }
});
