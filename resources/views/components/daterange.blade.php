<div class="form-group">
    {{ Form::label($name,$title) }}
    {{ Form::text($name, date('d/m/Y H:i', $value?strtotime($value):time()),array_merge(['class' => 'form-control daterange', 'id'=>$name, 'placeholder'=>'...'],$attributes)) }}
</div>