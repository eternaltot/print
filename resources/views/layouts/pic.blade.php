<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Picture</title>

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/slick.css') }}" rel="stylesheet">
    <link href="{{ asset('css/slick-theme.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <style type="text/css">
        .fixedbutton {
            position: absolute;
            top: 30px;
            right: 30px;
        }
        .slick-prev:before {
          color: white;
        }
        .slick-next:before {
          color: white;
        }
        .form-check{
          position: relative;
        }
        .choosed{
          width: 40px;
          height: 40px;
          float: left;
          position: absolute;
          right: 10px;
          top: 10px;
          z-index: 1000;
          /* transform: translateY(-50%); */
          transform: translateX(-50%);
          opacity: 0;
        }
        .choosed-active{
          opacity: 1;
        }
    </style>
</head>
<body>
    <div id="app">
        <header>
            <div class="container">
                <div class="col-md-12" style="text-align: center;padding: 20px;">
                <?php
                  // $tags = App\Tag::orderBy('id','DESC')->first();
                  // if(!isset($tags)){
                  //   $tags = new App\Tag;
                  //   $tags->tag = 'กะทิชาวเกาะ';
                  // }
                  // $tag = $tags->tag;
                ?>
                <?php
                    // if(Session::has('tag'))
                    //     $tag = Session::get('tag');
                    // Session::flash('tag', $tags->tag);
                ?>
                    <button type="button" onclick="location.href='{{url('picture/all/')}}'" class="btn btn-primary btn-circle btn-lg"><i class="fas fa-3x fa-th"></i></button>
                    <button type="button" onclick="location.href='{{url('picture/ig/')}}'" class="btn btn-primary btn-circle btn-lg"><i class="fab fa-3x fa-instagram"></i></button>
                    <button type="button" onclick="location.href='{{url('picture/folder')}}'" class="btn btn-primary btn-circle btn-lg"><i class="fas fa-3x fa-laptop"></i></button>
                </div>
            </div>
        </header>
        <div class="logo">
          <!-- <a><img class="fixlogo" src=""/></a> -->
        </div>
        {{ Form::open(array('url' => 'print')) }}

        @yield('content')
        <div class="bottom-fix">
            <button type="submit" id="btnsubmit" class="fixedbutton btn btn-lg btn-primary">ยืนยัน</button>
        </div>
        {{ Form::close() }}
        <button type="button" id="btnAlert" style="display:none;" class="btn btn-primary" data-toggle="modal" data-target="#modalAlert">
          Launch demo modal
        </button>
        <div id="modalAlert" class="modal" role="dialog" tabindex="-1">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <h1>กรุณาเลือกรูปภาพ</h1>
            </div>
          </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-lazyload/8.6.0/lazyload.min.js"></script>
    <script src="{{ asset('js/slick.min.js') }}"></script>
    <script type="text/javascript">
        function checkEvent(checkbox,img,choosed){
            var chk = document.getElementById(checkbox);
            if(chk.checked == false){
                chk.checked = true;
                $("#"+img).css({"border":"4px solid #1DD070"});

                $("#"+choosed).addClass("choosed-active");
            }else{
                if(chk.checked == true){
                    chk.checked = false;
                    $("#"+img).css({"border" : "none"});
                    $("#"+choosed).removeClass("choosed-active");
                }
            }
        }
        function isCheck(checkbox,img){
            var chk = document.getElementById(checkbox);
            if(chk.checked == false){
                $("#"+img).css({"border" : "none"});
            }else{
                if(chk.checked == true){
                    $("#"+img).css({"border":"4px solid #1DD070"});
                }
            }
        }
        $(document).on('click', 'form button[type=submit]', function(e) {
              var length = $('.checkbox:checkbox:checked').length;
              if(length == 0){
                // alert("กรุณาเลือกรูปภาพ");
                $("#btnAlert").click();
                e.preventDefault();
              }
          });
        $(document).ready(function(){
          $('.multiple-items-ig').slick({
            infinite: false,
            slidesToShow: 4,
            slidesToScroll: 4,
            lazyLoad: 'ondemand',
            arrows:true,
            dots:true,
            centerPadding:"10px",
          });
          $('.multiple-items-folder').slick({
            infinite: false,
            slidesToShow: 4,
            slidesToScroll: 4,
            lazyLoad: 'ondemand',
            arrows:true,
            dots:true,
            centerPadding:"10px",
          });
          $('.multiple-items-ig-page').slick({
            infinite: false,
            rows:2,
            slidesToShow: 4,
            slidesToScroll: 4,
            lazyLoad: 'ondemand',
            arrows:true,
            dots:true,
            centerPadding:"10px",
          });
          $('.multiple-items-folder-page').slick({
            infinite: false,
            rows:2,
            slidesToShow: 4,
            slidesToScroll: 4,
            lazyLoad: 'ondemand',
            arrows:true,
            centerPadding:"10px",
          });
        });
    </script>
</body>
</html>
