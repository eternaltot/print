<div class="form-group{{ $errors->has('tag') ? ' has-error' : ''}}">
    {!! Form::label('tag', 'Name: ', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('tag', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('tag', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
