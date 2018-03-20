@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit Frame</div>
                    <div class="panel-body">
                        <a href="{{ url('/admin/frames') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::model($frame, [
                            'method' => 'PATCH',
                            'url' => ['/admin/frames', $frame->id],
                            'class' => 'form-horizontal'
                        ]) !!}

                        @include ('admin.frames.form', ['submitButtonText' => 'Update'])

                        {!! Form::close() !!}
                        <a href="{{ url('/admin/frames/backup/'.$frame->id) }}" title="Backup"><button class="btn btn-info"><i class="fa fa-arrow-up" aria-hidden="true"></i> Backup</button></a>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection