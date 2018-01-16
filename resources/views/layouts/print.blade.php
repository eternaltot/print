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
    <style type="text/css">
        .fixedbutton {
            position: fixed;
            bottom: 30px;
            right: 30px;
        }
    </style>
</head>
<body>
    <div id="app">

        @yield('content')

        <div class="bottom-fix">
        <div class="fixedbutton">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="num">จำนวน</label>
                        <input id="num" name="num" onclick="changeLink()" type="number" class="form-control" value="1"></input>
                    </div>
                </div>
                <div class="col-md-6">
                    <a id="link" data-href="{{ route('printimage', ['images'=>$array_img]) }}">
                        <button class="btn btn-lg btn-primary">PRINT</button>
                    </a>
                </div>
            </div>
        </div>
        
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-lazyload/8.6.0/lazyload.min.js"></script>
    <script type="text/javascript">
        
        function changeLink(){
            var href = $("#link").attr("data-href");
            href = href+"&num="+$("#num").val();
			$("#link").attr("href",href);
        }
		$(function(){
            changeLink();
        });
        
    </script>
</body>
</html>
