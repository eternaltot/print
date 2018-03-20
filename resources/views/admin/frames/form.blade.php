<div class="form-group{{ $errors->has('name') ? ' has-error' : ''}}">
    {!! Form::label('name', 'Name: ', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group{{ $errors->has('horizontal') ? ' has-error' : ''}}">
    {!! Form::label('horizontal', 'Horizontal: ', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::file('horizontal') !!}
        {!! $errors->first('horizontal', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group{{ $errors->has('vertical') ? ' has-error' : ''}}">
    {!! Form::label('vertical', 'Vertical: ', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::file('vertical') !!}
        {!! $errors->first('vertical', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
