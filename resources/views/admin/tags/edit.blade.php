@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit Tag</div>
                    <div class="panel-body">
                        <a href="{{ url('/admin/tags') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::model($tag, [
                            'method' => 'PATCH',
                            'url' => ['/admin/tags', $tag->id],
                            'class' => 'form-horizontal'
                        ]) !!}

                        @include ('admin.tags.form', ['submitButtonText' => 'Update'])

                        {!! Form::close() !!}
                        <a href="{{ url('/admin/tags/backup/'.$tag->id) }}" title="Backup"><button class="btn btn-info"><i class="fa fa-arrow-up" aria-hidden="true"></i> Backup</button></a>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
