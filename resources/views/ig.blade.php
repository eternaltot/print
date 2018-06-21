@extends('layouts.pic')

@section('content')
<div class="container">
    <!-- <div class="row"> -->
        <!-- <div class="col-md-12"> -->
            <!-- <div class="row"> -->
                <!-- <div class="col-md-12"> -->
                <!-- <div class="row"> -->
                <div class="multiple-items-ig-page">
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
                            $base_url = 'https://www.instagram.com/explore/tags/'.urlencode($tag).'/?__a=1';
                            $url = $base_url;
                            $i = 1;
                            try{
                              while(1) {
                                  $json = json_decode(file_get_contents($url,true));
                                  foreach ($json->graphql->hashtag->edge_hashtag_to_media->edges as $value) {
                                  // foreach ($all_img as $value) {
                                    # code...
                        ?>

                        <!-- <div class="col-md-4" style="margin-bottom:10px; "> -->
                            <div class="form-check">
                                <input id="check-{{$i}}" class="checkbox" onchange="isCheck('check-{{$i}}','img-{{$i}}');" type="checkbox" name="choose[]" value="{{$value->node->display_url}}" class="form-check-input">
                                <a href="javascript:checkEvent('check-{{$i}}','img-{{$i}}','choosed-{{$i}}');">
                                <img id="img-{{$i}}" class="img-thumbnail" width="250" src="{{$value->node->display_url}}" />
                                <img id="choosed-{{$i}}" class="choosed" src="{{ asset('assets/choose_icon.png')}}" />
                                </a>
                            </div>

                                <?php
                                  $i++;
                                }
                                if(!$json->graphql->hashtag->edge_hashtag_to_media->page_info->has_next_page) break;
                                $url = $base_url.'&max_id='.$json->graphql->hashtag->edge_hashtag_to_media->page_info->end_cursor;
                                // $i;

                            }
                          }catch(Exception $e){

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
