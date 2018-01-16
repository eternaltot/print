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
        <header>
            <div class="container">
                <div class="col-md-12" style="text-align: center;padding: 20px;">
                    <button type="button" onclick="location.href='{{url('picture/all/').'/'.$tag}}'" class="btn btn-primary btn-lg">All</button>
                    <button type="button" onclick="location.href='{{url('picture/ig/').'/'.$tag}}'" class="btn btn-primary btn-lg">Instagram</button>
                    <button type="button" onclick="location.href='{{url('picture/folder')}}'" class="btn btn-primary btn-lg">Computer</button>
                </div>
            </div>
        </header>
        {{ Form::open(array('url' => 'print')) }}
        @yield('content')
        <div class="bottom-fix">
            <button type="submit" class="fixedbutton btn btn-lg btn-primary">NEXT</button>
        </div>
        {{ Form::close() }}
        
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-lazyload/8.6.0/lazyload.min.js"></script>
    <script type="text/javascript">
        function checkEvent(checkbox,img){
            var chk = document.getElementById(checkbox);
            if(chk.checked == false){
                chk.checked = true;
                $("#"+img).css({"border":"4px solid #ff4141"});
            }else{
                if(chk.checked == true){
                    chk.checked = false;
                    $("#"+img).css({"border" : "1px solid #ddd"});
                }
            }
        }
        function isCheck(checkbox,img){
            var chk = document.getElementById(checkbox);
            if(chk.checked == false){
                $("#"+img).css({"border" : "1px solid #ddd"});
            }else{
                if(chk.checked == true){
                    $("#"+img).css({"border":"4px solid #ff4141"});
                }
            }
        }
    </script>
</body>
</html>
