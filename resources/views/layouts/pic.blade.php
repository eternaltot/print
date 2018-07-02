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
  .btn-inactive{
    background-color: black;
  }
  .bottom-align{
    bottom: 0;
  }
  .loader {
    border: 16px solid #f3f3f3;
    border-radius: 50%;
    border-top: 16px solid #3498db;
    width: 240px;
    height: 240px;
    -webkit-animation: spin 2s linear infinite; /* Safari */
    animation: spin 2s linear infinite;
    margin-left: auto;
    margin-right: auto;
  }

  /* Safari */
  @-webkit-keyframes spin {
    0% { -webkit-transform: rotate(0deg); }
    100% { -webkit-transform: rotate(360deg); }
  }

  @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
  }
  .multiple-items-ig{
    margin-top: 60px;
  }
  </style>
</head>
<body>
  <div id="app">
    <header>
      <div class="logo">
        <a href="{{url('picture/all/')}}" target="_self">
          <img src="{{ asset('assets/logo_tcc_1.png')}}" width="70"/>
        </a>
      </div>
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
          <button type="button" onclick="location.href='{{url('picture/all/')}}'" class="btn btn-primary btn-circle btn-lg <?php echo Request::path() == 'picture/all' || Request::path() == "/" ? "" : "btn-inactive"; ?>" ><i class="fas fa-3x fa-th"></i></button>
          <button type="button" onclick="location.href='{{url('picture/ig/')}}'" class="btn btn-primary btn-circle btn-lg <?php echo Request::path() == 'picture/ig' ? "" : "btn-inactive"; ?>" style="margin-left:60px;"><i class="fab fa-3x fa-instagram"></i></button>
          <button type="button" onclick="location.href='{{url('picture/folder')}}'" class="btn btn-primary btn-circle btn-lg <?php echo Request::path() == 'picture/folder' ? "" : "btn-inactive"; ?>" style="margin-left:60px;"><i class="fas fa-3x fa-laptop"></i></button>
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
    <button type="button" id="btnloading" style="display:none;" class="btn btn-primary" data-toggle="modal" data-target="#modalLoading">
      Launch demo modal
    </button>
    <div id="modalLoading" class="modal" role="dialog" tabindex="-1">
      <div class="modal-dialog" role="document">
        <div class="modal-content"  style="text-align:center;">
          <div>
            <h3 style="color:white;">กรุณารอสักครู่</h3>
          </div>
          <div class="loader">
          </div>
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
      slidesPerRow: 4,
      // slidesToScroll: 4,
      lazyLoad: 'ondemand',
      arrows:true,
      dots:true,
      centerPadding:"10px",
      adaptiveHeight: true,
    });
    $('.multiple-items-folder').slick({
      infinite: false,
      slidesPerRow: 4,
      // slidesToScroll: 4,
      lazyLoad: 'ondemand',
      arrows:true,
      dots:true,
      centerPadding:"10px",
      adaptiveHeight: true,
    });
    $('.multiple-items-ig-page').slick({
      infinite: false,
      rows:2,
      slidesPerRow: 4,
      // slidesToScroll: 4,
      lazyLoad: 'ondemand',
      arrows:true,
      dots:true,
      centerPadding:"10px",
    });
    $('.multiple-items-folder-page').slick({
      infinite: false,
      rows:2,
      slidesPerRow: 4,
      // slidesToScroll: 4,
      lazyLoad: 'ondemand',
      arrows:true,
      dots:true,
      centerPadding:"10px",
    });
    $(".btn-circle").click(function(){
      $('#btnloading').click();
    });
    $(".logo").click(function(){
      $('#btnloading').click();
    });
    ig_bullet();
    folder_bullet();
    ig_page_bullet();
    folder_page_bullet();
  });
  function ig_bullet(){
    var count_bullet = $(".multiple-items-ig .slick-dots>li").length;

    var n = 32;
    var btnID;
    var pos = 1;

    $('p#igTxt').text(pos+" / "+count_bullet);
    for(var i=count_bullet;i>=n;i--){
      $("li#slick-slide-control0"+i).hide();
    }

    $('.multiple-items-ig .slick-arrow').click(function(){
      btnID = $(this).parent().find('li.slick-active > button').get(0).id;
      var is_change = false;
      if(count_bullet > n){
        var j = count_bullet / n+1;
        for(var k = 1;k<=j;k++){
          if(btnID == "slick-slide-control0"+(k*n)){
            for(var i=0;i<(k*n);i++){
              $("#slick-slide-control0"+i).hide();
            }
            for(var i=(k*n);i<(k+1)*n;i++){
              $("#slick-slide-control0"+i).show();
            }
          }else if(btnID == "slick-slide-control0"+((k*n)-1)){
            for(var i=0;i<((k-1)*n);i++){
              $("#slick-slide-control0"+i).hide();
            }
            for(var i=((k-1)*n);i<(k)*n;i++){
              $("#slick-slide-control0"+i).show();
            }
            for(var i=k*n;i<(k+1)*n;i++){
              $("#slick-slide-control0"+i).hide();
            }
          }
        }
      }
      pos = parseInt(btnID.substring(20))+1;
      $('p#igTxt').text(pos+" / "+count_bullet);

    });

    $('.multiple-items-ig ul.slick-dots li').click(function() {
      btnID = $(this).parent().find('li.slick-active > button').get(0).id;
      pos = parseInt(btnID.substring(20))+1;
      $('p#igTxt').text(pos+" / "+count_bullet);
    });
  }
  function folder_bullet(){
    var count_bullet = $(".multiple-items-folder .slick-dots>li").length;

    var n = 32;
    var btnID;
    var pos = 1;

    $('p#folderTxt').text(pos+" / "+count_bullet);
    for(var i=count_bullet;i>=n;i--){
      $("li#slick-slide-control1"+i).hide();
    }

    $('.multiple-items-folder .slick-arrow').click(function(){
      btnID = $(this).parent().find('li.slick-active > button').get(0).id;
      var is_change = false;
      if(count_bullet > n){
        var j = count_bullet / n+1;
        for(var k = 1;k<=j;k++){
          if(btnID == "slick-slide-control1"+(k*n)){
            for(var i=0;i<(k*n);i++){
              $("#slick-slide-control1"+i).hide();
            }
            for(var i=(k*n);i<(k+1)*n;i++){
              $("#slick-slide-control1"+i).show();
            }
          }else if(btnID == "slick-slide-control1"+((k*n)-1)){
            for(var i=0;i<((k-1)*n);i++){
              $("#slick-slide-control1"+i).hide();
            }
            for(var i=((k-1)*n);i<(k)*n;i++){
              $("#slick-slide-control1"+i).show();
            }
            for(var i=k*n;i<(k+1)*n;i++){
              $("#slick-slide-control1"+i).hide();
            }
          }
        }
      }
      pos = parseInt(btnID.substring(20))+1;
      $('p#folderTxt').text(pos+" / "+count_bullet);

    });

    $('.multiple-items-folder ul.slick-dots li').click(function() {
      btnID = $(this).parent().find('li.slick-active > button').get(0).id;
      pos = parseInt(btnID.substring(20))+1;
      $('p#folderTxt').text(pos+" / "+count_bullet);
    });
  }

  function folder_page_bullet(){
    var count_bullet = $(".multiple-items-folder-page .slick-dots>li").length;
    var i;
    var n = 32;
    var btnID;
    var pos = 1;

    $('p#folderTxt').text(pos+" / "+count_bullet);
    for(i=count_bullet;i>=n;i--){
      $("li#slick-slide-control0"+i).hide();
    }

    $('.multiple-items-folder-page .slick-arrow').click(function(){
      btnID = $(this).parent().find('li.slick-active > button').get(0).id;
      var is_change = false;
      if(count_bullet > n){
        var j = count_bullet / n+1;
        for(var k = 1;k<=j;k++){
          if(btnID == "slick-slide-control0"+(k*n)){
            for(var i=0;i<(k*n);i++){
              $("#slick-slide-control0"+i).hide();
            }
            for(var i=(k*n);i<(k+1)*n;i++){
              $("#slick-slide-control0"+i).show();
            }
          }else if(btnID == "slick-slide-control0"+((k*n)-1)){
            for(var i=0;i<((k-1)*n);i++){
              $("#slick-slide-control0"+i).hide();
            }
            for(var i=((k-1)*n);i<(k)*n;i++){
              $("#slick-slide-control0"+i).show();
            }
            for(var i=k*n;i<(k+1)*n;i++){
              $("#slick-slide-control0"+i).hide();
            }
          }
        }
      }
      pos = parseInt(btnID.substring(20))+1;
      $('p#folderTxt').text(pos+" / "+count_bullet);

    });

    $('.multiple-items-folder-page ul.slick-dots li').click(function() {
      btnID = $(this).parent().find('li.slick-active > button').get(0).id;
      pos = parseInt(btnID.substring(20))+1;
      $('p#folderTxt').text(pos+" / "+count_bullet);
    });
  }
  function ig_page_bullet(){
    var count_bullet = $(".multiple-items-ig-page .slick-dots>li").length;
    var i;
    var n = 32;
    var btnID;
    var pos = 1;

    $('p#igTxt').text(pos+" / "+count_bullet);
    for(i=count_bullet;i>=n;i--){
      $("li#slick-slide-control0"+i).hide();
    }

    $('.multiple-items-ig-page .slick-arrow').click(function(){
      btnID = $(this).parent().find('li.slick-active > button').get(0).id;
      var is_change = false;
      if(count_bullet > n){
        var j = count_bullet / n+1;
        for(var k = 1;k<=j;k++){
          if(btnID == "slick-slide-control0"+(k*n)){
            for(var i=0;i<(k*n);i++){
              $("#slick-slide-control0"+i).hide();
            }
            for(var i=(k*n);i<(k+1)*n;i++){
              $("#slick-slide-control0"+i).show();
            }
          }else if(btnID == "slick-slide-control0"+((k*n)-1)){
            for(var i=0;i<((k-1)*n);i++){
              $("#slick-slide-control0"+i).hide();
            }
            for(var i=((k-1)*n);i<(k)*n;i++){
              $("#slick-slide-control0"+i).show();
            }
            for(var i=k*n;i<(k+1)*n;i++){
              $("#slick-slide-control0"+i).hide();
            }
          }
        }
      }
      pos = parseInt(btnID.substring(20))+1;
      $('p#igTxt').text(pos+" / "+count_bullet);

    });

    $('.multiple-items-ig-page ul.slick-dots li').click(function() {
      btnID = $(this).parent().find('li.slick-active > button').get(0).id;
      pos = parseInt(btnID.substring(20))+1;
      $('p#igTxt').text(pos+" / "+count_bullet);
    });
  }
  </script>
</body>
</html>
