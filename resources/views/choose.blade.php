@extends('layouts.frame')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <?php
                        if(Session::has('choose')){
                          $choose = Session::get('choose');
                          Session::flash('choose',$choose);
                          ?>
                        <?php
                        }
                        set_time_limit(600);
                        $i = 1;
                        $directory = public_path("images/frame/");
                        $files = File::files($directory);
                        foreach ($files as $file) {
                            $file_info = new \SplFileInfo($file);
                              $img = Image::make(public_path('images/frame/' . $file_info->getFilename()));
                              if($img->getWidth() > $img->getHeight()){
                            ?>
                            <div class="col-md-4" style="margin-bottom:10px; ">
                                <div class="form-check">
                                      <input id="check-{{$i}}" onchange="isCheck('check-{{$i}}','img-{{$i}}');" type="checkbox" name="frame" value="{{$file_info->getFilename()}}" class="form-check-input">
                                      <a href="javascript:checkEvent('check-{{$i}}','img-{{$i}}');">
                                      <img id="img-{{$i}}" class="img-thumbnail" src="{{asset('images/frame').'/'.$file_info->getFilename()}}" />
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
          </div>
      </div>
  </div>
</div>
@endsection
