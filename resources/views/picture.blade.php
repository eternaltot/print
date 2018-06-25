@extends('layouts.pic')

@section('content')

<div class="container">
    <!-- <div class="row"> -->
        <!-- <div class="col-md-12"> -->
            <!-- <div class="row"> -->
                        <?php
                          $all_img = array();
                          $i = 1;
                          $tags = App\Tag::orderBy('id','DESC')->first();
                          if(!isset($tags)){
                            $tags = new App\Tag;
                            $tags->tag = 'กะทิชาวเกาะ';
                          }
                          $tag = $tags->tag;
                          // $url = "https://queryfeed.net/instagram?q=%23".urlencode($tag);
                          // $feed_to_array = file_get_contents($url);
                          // $array_feed = array();
                          // // print_r($feed_to_array);
                          // $needle = "<enclosure url=\"http://scontent-frx5-1.cdninstagram.com";
                          // $lastPos = 0;
                          // $positions = array();
                          //
                          // while (($lastPos = strpos($feed_to_array, $needle, $lastPos))!== false) {
                          //     $positions[] = $lastPos;
                          //     $lastPos = $lastPos + strlen($needle);
                          // }
                          //
                          // $needle2 = "\" type=\"image/jpeg\" length=\"0\"/>";
                          // $lastPos2 = 0;
                          // $positions_end = array();
                          //
                          // while (($lastPos2 = strpos($feed_to_array, $needle2, $lastPos2))!== false) {
                          //     $positions_end[] = $lastPos2;
                          //     $lastPos2 = $lastPos2 + strlen($needle2);
                          // }
                          //
                          // for ($i=0; $i < count($positions); $i++) {
                          //   # code...
                          //   $lenght = $positions_end[$i]-$positions[$i];
                          //   // print_r($positions[$i]." : ".$positions_end[$i]." lenght: ".$lenght."<br/>");
                          //   $str = "http://scontent-frx5-1.cdninstagram.com".substr($feed_to_array,$positions[$i]+strlen($needle),$lenght-strlen($needle));
                          //   // $str = str_replace("s150x150","p640x640",$str);
                          //   array_push($array_feed,$str);
                          // }
                          // print_r($array_feed);
                          // $all_img = $array_feed;
                        ?>
                        <div class="multiple-items-ig">
                        <?php
                            $all_img = array();
                            $base_url = 'https://www.instagram.com/explore/tags/'.urlencode($tag).'/?__a=1';
                            $url = $base_url;
                            $count = 1;
                            try{
                            while($count > 0) {
                                $json = json_decode(file_get_contents($url,true));
                                foreach ($json->graphql->hashtag->edge_hashtag_to_media->edges as $value) {
                        ?>

                        <!-- <div class="col-md-3" style="margin-bottom:10px; "> -->
                                <div class="form-check">
                                      <input id="check-{{$i}}" type="checkbox" data-choosed="choosed-{{$i}}" data-img="img-{{$i}}" class="checkbox" onchange="isCheck('check-{{$i}}','img-{{$i}}');"  name="choose[]" value="{{$value->node->display_url}}" class="form-check-input">
                                      <a href="javascript:checkEvent('check-{{$i}}','img-{{$i}}','choosed-{{$i}}');">
                                      <img id="img-{{$i}}" class="img-thumbnail bottom-align" width="250" src="{{$value->node->display_url}}" />
                                      <img id="choosed-{{$i}}" class="choosed" src="{{ asset('assets/choose_icon.png')}}" />
                                      </a>

                                </div>
                          <!-- </div> -->

                                <?php
                                  $i++;

                                    // array_push($all_img,$value->node->display_url);
                                }
                                if(!$json->graphql->hashtag->edge_hashtag_to_media->page_info->has_next_page) break;
                                $url = $base_url.'&max_id='.$json->graphql->hashtag->edge_hashtag_to_media->page_info->end_cursor;

                            }
                          }catch(Exception $e){

                          }
                        ?>
                      </div>
                        <div class="multiple-items-folder" style="padding-top:20px;">
                        <?php
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
                        $directory = public_path("images/");
                        $files = getPhotos($directory);
                        foreach ($files as $file) {
                            $file_info = new \SplFileInfo($file);
                            if($file_info->getExtension() <> 'db'){
                              // array_push($all_img,asset('images')."/".$file_info->getFilename());
                              $value = asset('images')."/".$file_info->getFilename();
                            ?>
                            <!-- <div class="col-md-3" style="margin-bottom:10px; "> -->
                                    <div class="form-check">
                                          <input id="check-{{$i}}" type="checkbox" class="checkbox" onchange="isCheck('check-{{$i}}','img-{{$i}}');"  name="choose[]" value="{{$value}}" class="form-check-input">
                                          <a href="javascript:checkEvent('check-{{$i}}','img-{{$i}}','choosed-{{$i}}');">
                                          <img id="img-{{$i}}" class="img-thumbnail" width="250" src="{{$value}}" />
                                          <img id="choosed-{{$i}}" class="choosed" src="{{ asset('assets/choose_icon.png')}}" />
                                          </a>
                                    </div>
                              <!-- </div> -->
                          <?php
                            $i++;
                          }
                        }
                        // shuffle($all_img);
                        // foreach ($all_img as $value) {
                        ?>
                      </div>
                        <!-- <div class="col-md-3" style="margin-bottom:10px; ">
                                <div class="form-check">
                                      <input id="check-{{--$i--}}" type="checkbox" class="checkbox" onchange="isCheck('check-{{--$i--}}','img-{{--$i--}}');"  name="choose[]" value="{{--$value--}}" class="form-check-input">
                                      <a href="javascript:checkEvent('check-{{--$i--}}','img-{{--$i--}}');">
                                      <img id="img-{{--$i--}}" class="img-thumbnail" src="{{--$value--}}" />
                                      </a>
                                </div>
                          </div> -->
                        <?php

                        // }
                      ?>
            <!-- </div> -->
        <!-- </div> -->
    <!-- </div> -->
</div>
@endsection
