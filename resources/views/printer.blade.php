@extends('layouts.print')

@section('content')
<div class="container" style="margin-top: 20px;">
  <div class="row">
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-12">
          <div class="row">
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
                // Image::make(public_path('images/' . $filename))->fit(300, 300)->save(public_path('images/crop/' . $filename));
                $img = Image::make(public_path('images/ig/' . $filename));
                if(isset($frame)){
                  $frame_name_array = explode('-',$frame);
                  $frame_name = $frame_name_array[0];
                }else{
                  $frame_name = "frame";
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
                <div class="col-md-4" style="margin-bottom:10px; ">
                  <!-- <img class="img-thumbnail" src="{{ asset('images').'/print/'.$filename }}" /> -->
                  <img class="img-thumbnail" src="{{ asset('images').'/print/'.$filename }}" />
                </div>
                <?php
              }else{
                // Image::make(public_path('images/' . $choose_img))->widen(1920, function ($constraint) {
                //   $constraint->upsize();
                // })->save(public_path('images/' . $choose_img));
                $path = $choose_img;
                $filename = basename($path);
                $img = Image::make(public_path('images/' . $filename));
                // $img = Image::make($choose_img);
                if(isset($frame)){
                  $frame_name_array = explode('-',$frame);
                  $frame_name = $frame_name_array[0];
                }else{
                  $frame_name = "frame";
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
                <div class="col-md-4" style="margin-bottom:10px; ">
                  <img class="img-thumbnail" src="{{asset('images').'/print/'.$filename}}" />
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
@endsection
