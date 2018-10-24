@php($error = $errors->has($name) ? 'has-error' : '')
<div class="form-group">
    {{ Form::label($name,$title) }}
    {{ Form::password($name, array_merge(['class' => "form-control $error", 'placeholder'=>'...'],$attributes)) }}
</div>