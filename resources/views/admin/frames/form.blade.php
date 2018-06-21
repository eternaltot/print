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
<div class="form-group{{ $errors->has('use') ? ' has-error' : ''}}">
    {!! Form::label('use', 'Use: ', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
      @if(isset($frame))
        {!! Form::checkbox('use',1,$frame->use,['class' => 'form-control']) !!}
        {!! $errors->first('use', '<p class="help-block">:message</p>') !!}
      @else
        {!! Form::checkbox('use',1,false,['class' => 'form-control']) !!}
        {!! $errors->first('use', '<p class="help-block">:message</p>') !!}
      @endif
    </div>
</div>
<div class="form-group{{ $errors->has('default') ? ' has-error' : ''}}">
    {!! Form::label('default', 'Default: ', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
      @if(isset($frame))
        {!! Form::checkbox('default',1,$frame->default,['class' => 'form-control']) !!}
        {!! $errors->first('default', '<p class="help-block">:message</p>') !!}
      @else
        {!! Form::checkbox('default',1,false,['class' => 'form-control']) !!}
        {!! $errors->first('default', '<p class="help-block">:message</p>') !!}
      @endif
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
