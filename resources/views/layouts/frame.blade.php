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
        .container{
          width: 960px;
          padding-top: 10%;
        }
        .fixedbutton {
            position: absolute;
            bottom: 20px;
            right: 20px;
        }
        .button-back{
          position: absolute;
          bottom: 20px;
          left: 20px;
        }
        .frame_show{
        }
        .image1{
          position: relative;
        }
        .frame{
          float: left;
          position: absolute;
          left: 0px;
          bottom: 0px;
          z-index: 1000;
        }
        .choose_frame{
          position: fixed;
          bottom: 20px;
          margin-left: 5%;
          margin-right: 10%;
        }
        .form-check{
          position: relative;
        }
        .choosed{
          width: 50px;
          height: 50px;
          float: left;
          position: absolute;
          left: 50%;
          top: 40%;
          z-index: 1000;
          transform: translateY(-50%);
          transform: translateX(-50%);
          opacity: 0;
        }
        .choosed-active{
          opacity: 1;
        }
    </style>
</head>
<body>
  <div class="logo">
    <a href="{{url('picture/all/')}}" target="_self">
      <img src="{{ asset('assets/logo_tcc_1.png')}}" width="70"/>
    </a>
  </div>
    <div id="app">
        {{ Form::open(array('url' => 'print')) }}
        @yield('content')
        <div class="bottom-fix">
            <button type="submit" class="fixedbutton btn btn-lg btn-primary">ยืนยัน</button>
        </div>
        {{ Form::close() }}
        <div class="bottom-fix">
            <button type="button" class="button-back btn btn-lg btn-primary">กลับ</button>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-lazyload/8.6.0/lazyload.min.js"></script>
    <script src="{{ asset('js/slick.min.js') }}"></script>
    <script type="text/javascript">
        function checkEvent(checkbox,img,choosed){

            // $(".img-thumbnail").css({"border" : "1px solid #ddd"});
            var chk = document.getElementById(checkbox);
            $('input[type=checkbox]').not(chk).prop('checked', false);
            if(chk.checked == false){
              chk.checked =true;
              $('input[type=checkbox]').not(chk).each(function(i,obj){
                var img = $(this).data("img");
                var choose_id = $(this).data("choosed");
                $("#"+img).css({"border":"1px solid #ddd"});
                $("#"+choose_id).removeClass("choosed-active");
              });
              $("#"+img).css({"border":"4px solid #1DD070"});
              $("#"+choosed).addClass("choosed-active");
            }
            var horizontal = $("#"+img).data("horizontal");
            var vertical = $("#"+img).data("vertical");
            $('.frame').each(function(i, obj) {
                var align = $(this).data('align');
                if(align == "horizontal")
                  $(this).attr("src",horizontal);
                else
                  $(this).attr("src",vertical);
            });
        }
        $(function(){
          $('.gallery').slick({
            infinite: false,
            rows:1,
            slidesPerRow: <?php echo $count_choose >= 4 ? "4":$count_choose; ?>,
            arrows:true,
            dots:true,
            centerPadding:"15px",
            adaptiveHeight: true
          });
          $("#img-<?php echo $check; ?>").trigger('click');
          $(".button-back").on('click',function(){
            window.history.back();
          });
        });
    </script>
</body>
</html>
