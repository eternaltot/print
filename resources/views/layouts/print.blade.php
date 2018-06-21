<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Print</title>

  <!-- Styles -->
  <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/slick.css') }}" rel="stylesheet">
  <link href="{{ asset('css/slick-theme.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
  <link href="{{ asset('css/main.css') }}" rel="stylesheet">
  <style type="text/css">

  .button-right{
    margin-top: 10px;
    float: right;
    margin-right: 20px;
  }
  .button-left{
    position: absolute;
    left:20px;
    bottom: 10px;
  }
  .button-edit{
    position: absolute;
    left:42%;
    bottom: 10px;
  }
  .container{
    width: 960px;
    padding-top: 10px;
  }
  .slick-next{
    right: -10px;
  }
  .slick-prev{
    left: -80px;
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
  .modal-content{
    top:100px;
  }
  </style>
</head>
<body>
  <div id="app" style="overflow-x:hidden;">
    <header>
      <div class="button-right">
        <div class="row">
          <div class="col" style="">
            <div class="form-group">
              <label for="num">จำนวน</label>
              <select name="num" id="num" style="height:40px;width:60px;">
                <option value="1" selected>1</option>
                @for( $i = 2;$i<=20;$i++)
                <option value="{{$i}}">{{$i}}</option>
                @endfor
              </select>
              <a id="link" data-href="{{ route('printimage', ['images'=>$array_img]) }}">
                <button class="btn btn-lg btn-primary"><i class="fas fa-2x fa-print"></i></button>
              </a>
            </div>
          </div>
        </div>
      </div>
    </header>
    @yield('content')
    <div class="button-left">
      <div class="row">
        <div class="col-md-6">
          <a href="{{ url('picture/all') }}">
            <button class="btn btn-lg btn-primary">กลับ</button>
          </a>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="button-edit">
        <a href="{{ url('choose/') }}">
          <button class="btn btn-lg btn-primary"><img width="40" src="{{ asset('assets/frame_icon.png')}}" /></button>
        </a>
      </div>
    </div>
    <button type="button" id="btnloading" style="display:none;" class="btn btn-primary" data-toggle="modal" data-target="#modalLoading">
      Launch demo modal
    </button>
    <div id="modalLoading" class="modal" role="dialog" tabindex="-1">
      <div class="modal-dialog" role="document">
        <div class="modal-content"  style="text-align:center;">
          <div>
            <h3 style="color:white;">กำลัง print รูป</h3>
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

  function changeLink(){
    var href = $("#link").attr("data-href");
    href = href+"&num="+$('select[name=num]').val();
    $("#link").attr("href",href);

  }
  $(function(){
    changeLink();
    $("#num").on('change',function(){
      changeLink();
    });
    $('.gallery').slick({
      infinite: false,
      rows:2,
      slidesPerRow: <?php echo $count_choose >= 4 ? "4":$count_choose; ?>,
      arrows:true,
      dots:true,
      centerPadding:"15px",
      adaptiveHeight: true
    });

    $("#link").click(function(){
      $('#btnloading').click();
    });
  });


  </script>
</body>
</html>
