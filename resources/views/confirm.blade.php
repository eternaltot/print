
@extends('layouts.edit')

@section('content')
<div class="container">
  <div class="container" style="margin-top: 20px;">
    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-12">
            <div class="row">
              <?php
              // if(Session::has('tag')){
              //   $tag = Session::get('tag');
              //   Session::flash('tag',$tag);
              // }
              if(Session::has('choose'))
              $choose = Session::get("choose");
              Session::flash('choose',$choose);
              $directory = public_path("images/");
              if(!File::exists($directory."print/")) {
                File::makeDirectory($directory."print/", $mode = 0777, true, true);
              }
              $array_img = array();
              foreach ($choose as $choose_img) {
                if(strpos($choose_img, "https") !== false){
                  $path = $choose_img;
                  $filename = basename($path);
                  if(!File::exists(public_path('images/ig/' . $filename))) {
                    $save_img = Image::make($path);
                    if($save_img->width() > $save_img->height()){
                      $save_img->resize(1920,1371)->save(public_path('images/ig/' . $filename),100);
                    }else{
                      $save_img->resize(1371,1920)->save(public_path('images/ig/' . $filename),100);
                    }
                  }

                  $img = Image::make(public_path('images/ig/' . $filename));
                  array_push($array_img, public_path('images\\ig\\'.$filename));
                  ?>
                  <div class="col-md-4" style="margin-bottom:10px; ">
                    <img class="img-thumbnail" src="{{ asset('images').'/ig/'.$filename }}" />
                  </div>
                  <?php
                }else{
                  $path = $choose_img;
                  $filename = basename($path);
                  Image::make(public_path('images/' . $filename))->widen(1920, function ($constraint) {
                    $constraint->upsize();
                  })->save(public_path('images/' . $filename));

                  array_push($array_img, public_path('images\\'.$filename));
                  ?>
                  <div class="col-md-4" style="margin-bottom:10px; ">
                    <img class="img-thumbnail" src="{{asset('images').'/'.$filename}}" />
                  </div>
                  <?php
                }
              }
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
