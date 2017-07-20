<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Images;
use Image;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function dropzone()
     {
       $images = Images::all();
         return view('admin.dropzone-view',compact('images'));
     }

     /**
      * Image Upload Code
      *
      * @return void
      */
     public function dropzoneStore(Request $request)
     {
         $image = $request->file('file');
         $array = explode('.', $image->getClientOriginalName());
         $imageName =$array[0]."_".rand().".".$array[1];
         //create submnails
         $img = Image::make($image->getRealPath());
          $img->resize(150, 150, function ($constraint) {
         	  $constraint->aspectRatio();
          })->save(public_path('images').'/'."sub_".$imageName);
          //create image
         $image->move(public_path('images'),$imageName);
         $image_id = Images::create(array('name'=>$imageName))->id;
         return response()->json(['name'=>$imageName,'id'=>$image_id]);
     }

     public function testing(){
        $images = Images::all();
        return view('admin.testing',compact('images'));
     }
     public function save(Request $request){
       return $request->all();
       return "true";
     }
}
