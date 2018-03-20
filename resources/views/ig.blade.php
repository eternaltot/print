@extends('layouts.pic')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                    @if($tag)
                        <?php
                            $i=1;
                            $base_url = 'https://www.instagram.com/explore/tags/'.urlencode($tag).'/?__a=1';
                            $url = $base_url;
                            // $i = 1;
                            while(1) {
                                $json = json_decode(file_get_contents($url,true));
                                foreach ($json->graphql->hashtag->edge_hashtag_to_media->edges as $value) {
                        ?>
                        <div class="col-md-4" style="margin-bottom:10px; ">
                            <div class="form-check">
                                <input id="check-{{$i}}" class="checkbox" onchange="isCheck('check-{{$i}}','img-{{$i}}');" type="checkbox" name="choose[]" value="{{$value->node->display_url}}" class="form-check-input">
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
                                // $i--;

                            }
                        ?>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
