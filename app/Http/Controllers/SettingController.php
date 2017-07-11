<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Settings;

class SettingController extends Controller
{
    public function index(){
       $setting = Settings::find('1');
       if(empty($setting)){
         $data=[
           'slider_show'=>2
         ];
         Settings::Create($data);
       }
      $setting = Settings::find(1);
      return view('admin.settings.show_slider',compact('setting'));
    }
    public function update($id,Request $request){
        $setting = Settings::find($id)->update(array('slider_show'=>$request->slider_show));
        return redirect()->route("setting.index")->with("success","The setting updated successfully");
    }
}
