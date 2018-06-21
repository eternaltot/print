@extends('layouts.pic')

@section('content')
<div class="container">
    <!-- <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="row"> -->
                    <div class="multiple-items-folder-page">
                        <?php
                        set_time_limit(600);
                        $i = 1;
                        $directory = public_path("images/");
                        function getPhotos($dir)
                        {
                            return $files = collect(File::Files($dir))
                                ->filter(function ($file) {
                                    $file = new \SplFileInfo($file);
                                    return in_array($file->getExtension(), ['png', 'gif', 'jpg','JPG','JPEG','jpeg','PNG','GIF']);
                                })
                                ->sortByDesc(function ($file) {
                                  $file = new \SplFileInfo($file);
                                    return $file->getMTime();
                                })
                                ->map(function ($file) {
                                  $file = new \SplFileInfo($file);
                                    return $file->getBaseName();
                                });
                        }
                        $files = getPhotos($directory);
                        foreach ($files as $file) {
                            $file_info = new \SplFileInfo($file);
                            if($file_info->getExtension() <> 'db'){
                              // if($file_info->getSize()>1000000){
                              //   Image::make(public_path('images/' . $file_info->getFilename()))->widen(1920)->save(public_path('images/' . $file_info->getFilename()),75);
                              // }
                              ?>
                              <!-- <div class="col-md-4" style="margin-bottom:10px; "> -->
                                  <div class="form-check">
                                        <input id="check-{{$i}}" class="checkbox" onchange="isCheck('check-{{$i}}','img-{{$i}}');" type="checkbox" name="choose[]" value="{{$file_info->getFilename()}}" class="form-check-input">
                                        <a href="javascript:checkEvent('check-{{$i}}','img-{{$i}}','choosed-{{$i}}');">
                                        <img id="img-{{$i}}" class="img-thumbnail" width="250" src="{{asset('images').'/'.$file_info->getFilename()}}" />
                                        <img id="choosed-{{$i}}" class="choosed" src="{{ asset('assets/choose_icon.png')}}" />
                                        </a>
                                  </div>
                              <!-- </div> -->
                          <?php
                          $i++;
                          }
                      }
                      ?>
                    </div>
                  <!-- </div>
              </div>
          </div>
      </div>
  </div> -->
</div>
@endsection
