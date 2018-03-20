@extends('layouts.backend')

@section('content')
<div class="container">
    <div class="row">
        @include('admin.sidebar')
        @guest
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    Your application's dashboard.
                </div>
            </div>
        </div>
        @endguest
        @auth
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    Admin dashboard.
                </div>
            </div>
        </div>
        @endauth
    </div>
</div>
@endsection
