<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;


class UploadController extends Controller
{
  public function upload(Request $request){

    $arr_res = array();
    if($request->hasFile('photos')){
      $files = $request->photos;
      foreach ($files as $file) {
        // $file->move('images', $file->getClientOriginalName());
        // $img = Image::make(public_path('images/'.$file->getClientOriginalName()));
        $img = Image::make($file->getRealPath());
        if($img->width() >= $img->height()){
          $img->resize(1920,1371)->save(public_path('images/' . $file->getClientOriginalName()),100);
        }else{
          $img->resize(1371,1920)->save(public_path('images/' . $file->getClientOriginalName()),100);
        }
        $arr_res[] = $file->getClientOriginalName();
      }

    }
    return view('upload',['uploaded' => $arr_res]);

  }
}
