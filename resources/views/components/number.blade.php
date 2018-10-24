<div class="form-group">
    {{ Form::label($name,$title) }}
    {{ Form::number($name, $value,array_merge(['class' => 'form-control', 'id'=>$name, 'placeholder'=>'...'],$attributes)) }}
</div>