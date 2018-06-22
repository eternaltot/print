@extends('layouts.frame')

@section('content')
<div class="container" style="text-align:center;">
  <div class="gallery row">
    <?php
    if(Session::has('choose')){
      $choose = Session::get('choose');
      Session::flash('choose',$choose);
    }
    $directory = public_path("images/");
    if(!File::exists($directory."temp/")) {
      File::makeDirectory($directory."temp/", $mode = 0777, true, true);
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
        $data_align = "horizontal";
        if($img->width()<$img->height()){
          $data_align = "vertical";
          $frame_file_name = $frame_name."-vertical.png";
        }

        // $frame_img = Image::make(public_path('images/frame/'.$frame_file_name))->resize(($img->width()),($img->height()));
        $canvas = Image::canvas(($img->width()),($img->height()));
        // // $frame->insert($img,"center")->save(public_path('images/print/'.$filename));
        // $canvas->insert($img,"center");
        $canvas->insert($img,"center")->save(public_path('images/temp/'.$filename),100);
        // $canvas->insert($frame_img,"center")->save(public_path('images/temp/'.$filename),100);
        array_push($array_img, public_path('images\\print\\'.$filename));
        ?>
        <!-- <div class="col-md-4" style="margin-bottom:10px; "> -->
        <!-- <img class="img-thumbnail" src="{{ asset('images').'/print/'.$filename }}" /> -->
        <div class="image1">
          <img class="preview" width="<?php echo $show_width;?>" src="{{ asset('images').'/temp/'.$filename }}" />
          <img class="frame" data-align="{{ $data_align }}" width="<?php echo $show_width;?>" src="{{ asset('images/frame/'.$frame_file_name)}}"/>
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
        $data_align = "horizontal";
        $frame_file_name = $frame_name."-horizontal.png";
        if($img->width()<$img->height()){
          $data_align = "vertical";
          $frame_file_name = $frame_name."-vertical.png";
        }
        // $frame_img = Image::make(public_path('images/frame/'.$frame_file_name))->resize(($img->width()),($img->height()));
        $canvas = Image::canvas(($img->width()),($img->height()));
        // // $frame->insert($img,"center")->save(public_path('images/print/'.$choose_img));
        $canvas->insert($img,"center")->save(public_path('images/temp/'.$filename),100);
        // $canvas->insert($frame_img,"center")->save(public_path('images/print/'.$filename),100);
        array_push($array_img, public_path('images\\print\\'.$filename));

        ?>
        <!-- <div class="col-md-4" style="margin-bottom:10px; "> -->
        <div class="image1">

          <img class="img-thumbnail preview" width="<?php echo $show_width;?>" src="{{asset('images').'/temp/'.$filename}}" />
          <img class="frame" data-align="{{$data_align}}" width="<?php echo $show_width;?>" src="{{ asset('images/frame/'.$frame_file_name)}}"/>
        </div>
        <?php
      }
    }
    ?>
  </div>
  <div class="row choose_frame">
      <?php

    set_time_limit(600);
    $i = 1;
    $directory = public_path("images/frame/");
    // $files = File::files($directory);
    $files = App\Frame::where('use',1)->get();
    $checked = 1;
    foreach ($files as $file) {
      if($file->default)
        $check = $i;
      if($i==5)
        break;
      // $file_info = new \SplFileInfo($file);
      $img = Image::make(public_path('images/frame/' . $file->horizontal));
      if($img->getWidth() > $img->getHeight()){
        ?>
        <div class="col-md-3">
          <div class="form-check">
            <input id="check-{{$i}}" data-choosed="choosed-{{$i}}" data-img="img-{{$i}}" type="checkbox" name="frames" value="{{$file->horizontal}}" class="form-check-input" style="display:none;">
            <a href="javascript:checkEvent('check-{{$i}}','img-{{$i}}','choosed-{{$i}}');">
              <img id="img-{{$i}}"  class="img-thumbnail" style="background-color:white;" src="{{asset('images/frame').'/'.$file->horizontal}}" data-horizontal="{{asset('images/frame').'/'.$file->horizontal}}" data-vertical="{{asset('images/frame').'/'.$file->vertical}}" />
              <img id="choosed-{{$i}}" class="choosed" src="{{ asset('assets/choose_icon.png')}}" />
            </a>
          </div>
        </div>
        <?php
      }
      $i++;
    }
    ?>
  </div>
</div>
@endsection
