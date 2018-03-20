@extends('layouts.pic')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <?php
                        set_time_limit(600);
                        $i = 1;
                        $directory = public_path("images/");
                        $files = File::files($directory);
                        foreach ($files as $file) {
                            $file_info = new \SplFileInfo($file);
                            // if($file_info->getSize()>1000000){
                            //   Image::make(public_path('images/' . $file_info->getFilename()))->widen(1920)->save(public_path('images/' . $file_info->getFilename()),75);
                            // }
                            ?>
                            <div class="col-md-4" style="margin-bottom:10px; ">
                                <div class="form-check">
                                      <input id="check-{{$i}}" class="checkbox" onchange="isCheck('check-{{$i}}','img-{{$i}}');" type="checkbox" name="choose[]" value="{{$file_info->getFilename()}}" class="form-check-input">
                                      <a href="javascript:checkEvent('check-{{$i}}','img-{{$i}}');">
                                      <img id="img-{{$i}}" class="img-thumbnail" src="{{asset('images').'/'.$file_info->getFilename()}}" />
                                      </a>
                                </div>
                          </div>
                          <?php
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
