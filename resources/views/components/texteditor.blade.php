<div class="form-group">
    {{ Form::label($name,$title) }}
    {{ Form::textarea($name, $value, array_merge(['class' => 'form-control', 'id'=>$name, 'placeholder'=>'...', 'rows'=>'auto', 'cols'=>'auto'], (array) $attributes)) }}
</div>
<script>
    $(document).ready(function () {
        CKEDITOR.replace('{{$name}}', {
            height: '{{$height}}'
        });
    });
</script>
