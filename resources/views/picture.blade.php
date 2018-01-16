@extends('layouts.pic')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        @if($tag)
                        <?php
                            $base_url = 'https://www.instagram.com/explore/tags/'.urlencode($tag).'/?__a=1';
                            $url = $base_url;
                            $i = 1;
                            while(1) {
                                $json = json_decode(file_get_contents($url,true));
                                foreach ($json->graphql->hashtag->edge_hashtag_to_media->edges as $value) {
                        ?>
                        <div class="col-md-6" style="margin-bottom:10px; ">
                            <div class="form-check">
                                <input id="check-{{$i}}" onchange="isCheck('check-{{$i}}','img-{{$i}}');" type="checkbox" name="choose[]" value="{{$value->node->display_url}}"  class="form-check-input">
                                <a href="javascript:checkEvent('check-{{$i}}','img-{{$i}}');">
                                <img id="img-{{$i}}" class="img-thumbnail" src="{{$value->node->display_url}}" />
                                </a>
                            </div>
                        </div>
                                <?php
                                $i++;
                                }
                                if(!$json->graphql->hashtag->edge_hashtag_to_media->page_info->has_next_page) break;
                                $url = $base_url.'&max_id='.$json->graphql->hashtag->edge_hashtag_to_media->page_info->end_cursor;
                            }
                        ?>
                        @endif
                    </div>
                </div>
            
                <div class="col-md-6">
                    <div class="row">
                        <?php
                        $directory = public_path("images/");
                        $files = File::files($directory);
                        foreach ($files as $file) {
                            $file_info = new \SplFileInfo($file);
                            ?>
                            <div class="col-md-6" style="margin-bottom:10px; ">
                                <div class="form-check">
                                      <input id="check-{{$i}}" type="checkbox" onchange="isCheck('check-{{$i}}','img-{{$i}}');"  name="choose[]" value="{{$file_info->getFilename()}}" class="form-check-input">
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
