<div class="form-group">
    {{ Form::label($name,$title) }}
    {{ Form::email($name, $value,array_merge(['class' => 'form-control', 'id'=>$name, 'placeholder'=>'...'], (array) $attributes)) }}
</div>