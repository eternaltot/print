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
        .fixbuttonleft{
            position: fixed;
            bottom: 30px;
            left: 30px;
        }
    </style>
</head>
<body>
    <div id="app">

        @yield('content')

        <div class="bottom-fix">
        <div class="fixbuttonleft">
        <div class="row">
            <div class="col-md-6">
                <a href="{{ url('choose/') }}">
                    <button class="btn btn-lg btn-primary">EDIT</button>
                </a>
            </div>
        </div>
        </div>
        <div class="fixedbutton">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="num">จำนวน</label>
                        <select name="num" id="num">
                           <option value="1" selected>1</option>
                           @for( $i = 2;$i<=20;$i++)
                           <option value="{{$i}}">{{$i}}</option>
                           @endfor
                        </select>
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
            href = href+"&num="+$('select[name=num]').val();
			$("#link").attr("href",href);
        }
		$(function(){
            changeLink();
            $("#num").on('change',function(){
              changeLink();
            });
        });

    </script>
</body>
</html>
