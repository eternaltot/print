@extends('layouts.print')

@section('content')
<div class="container">
  <div class="gallery">
    <?php
    if(Session::has('tag')){
      $tag = Session::get('tag');
      Session::flash('tag',$tag);
    }
    if(Session::has('choose'))
    $choose = Session::get("choose");
    Session::flash('choose',$choose);
    $directory = public_path("images/");
    if(!File::exists($directory."print/")) {
      File::makeDirectory($directory."print/", $mode = 0777, true, true);
    }
    $count_choose = count($choose);
    $show_width = 200;
    if($count_choose == 1){
      $show_width = 500;
    }elseif($count_choose == 2){
      $show_width = 400;
    }elseif($count_choose == 3){
      $show_width = 250;
    }else {
      $show_width = 200;
    }
    $array_img = array();
    foreach ($choose as $choose_img) {
      if(strpos($choose_img, "https") !== false){
        $path = $choose_img;
        if(strpos($path,"?") !== false){
          $str_tmp = explode("?",$path);
          $tmp_name = $str_tmp[0];
        }else{
          $tmp_name = $path;
        }
        $filename = basename($tmp_name);
        if(!File::exists(public_path('images/ig/' . $filename))) {
          $save_img = Image::make($path);
          if($save_img->width() > $save_img->height()){
            $save_img->resize(1920,1371)->save(public_path('images/ig/' . $filename),100);
          }else{
            $save_img->resize(1371,1920)->save(public_path('images/ig/' . $filename),100);
          }
        }
        // Image::make(public_path('images/' . $filename))->fit(300, 300)->save(public_path('images/crop/' . $filename));
        $img = Image::make(public_path('images/ig/' . $filename));

        if(isset($frames)){
          $frame_name_array = explode('-',$frames);
          $frame_name = $frame_name_array[0];
          // $frame = App\Frame::where("default",'=','1')->orderBy('id','DESC')->first();
          // $frame_name = "blank";
        }else{
          $frame = App\Frame::where("default",'=','1')->orderBy('id','DESC')->first();
          $frame_name = $frame->name;
        }
        $frame_file_name = $frame_name."-horizontal.png";
        if($img->width()<$img->height()){
          $frame_file_name = $frame_name."-vertical.png";
        }

        $frame_img = Image::make(public_path('images/frame/'.$frame_file_name))->resize(($img->width()),($img->height()));
        $canvas = Image::canvas(($img->width()),($img->height()));
        // // $frame->insert($img,"center")->save(public_path('images/print/'.$filename));
        $canvas->insert($img,"center");
        $canvas->insert($frame_img,"center")->save(public_path('images/print/'.$filename),100);
        array_push($array_img, public_path('images\\print\\'.$filename));
        ?>
        <!-- <div class="col-md-4" style="margin-bottom:10px; "> -->
        <!-- <img class="img-thumbnail" src="{{ asset('images').'/print/'.$filename }}" /> -->
        <div class="">
          <img class="img-thumbnail" width="<?php echo $show_width;?>" src="{{ asset('images').'/print/'.$filename }}" />
        </div>
        <!-- </div> -->
        <?php
      }else{
        // Image::make(public_path('images/' . $choose_img))->widen(1920, function ($constraint) {
        //   $constraint->upsize();
        // })->save(public_path('images/' . $choose_img));
        $path = $choose_img;
        $filename = basename($path);
        $img = Image::make(public_path('images/' . $filename));
        // $img = Image::make($choose_img);

        if(isset($frames)){
          $frame_name_array = explode('-',$frames);
          $frame_name = $frame_name_array[0];
          // $frame_name = "blank";
        }else{
          $frame = App\Frame::where("default",'=','1')->orderBy('id','DESC')->first();
          $frame_name = $frame->name;
        }
        $frame_file_name = $frame_name."-horizontal.png";
        if($img->width()<$img->height()){
          $frame_file_name = $frame_name."-vertical.png";
        }
        $frame_img = Image::make(public_path('images/frame/'.$frame_file_name))->resize(($img->width()),($img->height()));
        $canvas = Image::canvas(($img->width()),($img->height()));
        // // $frame->insert($img,"center")->save(public_path('images/print/'.$choose_img));
        $canvas->insert($img,"center");
        $canvas->insert($frame_img,"center")->save(public_path('images/print/'.$filename),100);
        array_push($array_img, public_path('images\\print\\'.$filename));
        ?>
        <!-- <div class="col-md-4" style="margin-bottom:10px; "> -->
        <div class="">
          <img class="img-thumbnail" width="<?php echo $show_width;?>" src="{{asset('images').'/print/'.$filename}}" />
        </div>
        <?php
      }
    }
    ?>
  </div>
</div>
@endsection
