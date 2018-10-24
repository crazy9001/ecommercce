<div class="form-group">
    {{ Form::label($name,$title) }}
    {{ Form::textarea($name, $value, array_merge(['class' => 'form-control', 'placeholder'=>'...', 'rows'=>'auto', 'cols'=>'auto'], (array) $attributes)) }}
</div>
