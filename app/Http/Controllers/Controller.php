<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Cloudinary;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function __construct()
 {
   \Cloudinary::config(array(
       "cloud_name" => "isama",
       "api_key" => "631229188976387",
       "api_secret" => "OxzZ3Z_H-teBt-AV91ptVOcpiOk"
   ));
 }
}
