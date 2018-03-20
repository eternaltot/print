@extends('layouts.pic')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                        <?php
                          $all_img = array();
                          $i = 1;
                          $tags = App\Tag::orderBy('id','DESC')->first();
                          if(!isset($tags)){
                            $tags = new App\Tag;
                            $tags->tag = 'กะทิชาวเกาะ';
                          }
                          $tag = $tags->tag;
                        ?>

                        <?php
                            $base_url = 'https://www.instagram.com/explore/tags/'.urlencode($tag).'/?__a=1';
                            $url = $base_url;
                            $count = 1;
                            while($count > 0) {
                                $json = json_decode(file_get_contents($url,true));
                                foreach ($json->graphql->hashtag->edge_hashtag_to_media->edges as $value) {
                        ?>
                                <?php
                                    array_push($all_img,$value->node->display_url);
                                }
                                if(!$json->graphql->hashtag->edge_hashtag_to_media->page_info->has_next_page) break;
                                $url = $base_url.'&max_id='.$json->graphql->hashtag->edge_hashtag_to_media->page_info->end_cursor;

                            }
                        ?>

                        <?php
                        $directory = public_path("images/");
                        $files = File::files($directory);
                        foreach ($files as $file) {
                            $file_info = new \SplFileInfo($file);
                            array_push($all_img,asset('images')."/".$file_info->getFilename());
                            ?>
                          <?php
                        }
                        shuffle($all_img);
                        foreach ($all_img as $value) {
                        ?>
                        <div class="col-md-3" style="margin-bottom:10px; ">
                                <div class="form-check">
                                      <input id="check-{{$i}}" type="checkbox" class="checkbox" onchange="isCheck('check-{{$i}}','img-{{$i}}');"  name="choose[]" value="{{$value}}" class="form-check-input">
                                      <a href="javascript:checkEvent('check-{{$i}}','img-{{$i}}');">
                                      <img id="img-{{$i}}" class="img-thumbnail" src="{{$value}}" />
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
@endsection
