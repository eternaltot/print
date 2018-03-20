<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use Image;

class PictureController extends Controller
{
    //
    public function index()
    {
        return view('picture');
    }

    public function resizeAll(){
    	set_time_limit(600);
    	$directory = public_path("images/");
        $files = File::files($directory);
        foreach ($files as $file) {
            $file_info = new \SplFileInfo($file);
            if($file_info->getSize()>3000000){
              $img = Image::make(public_path('images/' . $file_info->getFilename()));
              if($img->width()>$img->height()){
                $img->->resize(3900,2786)->save(public_path('images/' . $file_info->getFilename()));
              }else{
                $img->->resize(2786,3900)->save(public_path('images/' . $file_info->getFilename()));
              }
            }
        }
        return redirect("/picture/all");
    }
}
