<div class="form-group">
    {{ Form::label($name,$title) }}
    <div id="{{$name}}_editor" style="min-height: 400px;"></div>
    {{ Form::textarea($name, $value, (array) $attributes) }}
</div>
<script>
    $(document).ready(function () {
        var {{$name}} = $('textarea[name="{{$name}}"]').hide();
        var {{$name}}_editor = ace.edit("{{$name}}_editor");
        {{$name}}_editor.setTheme("ace/theme/monokai");
        {{$name}}_editor.getSession().setMode("ace/mode/{{$lang}}");
        {{$name}}_editor.setShowPrintMargin(false);
        {{$name}}_editor.getSession().setValue({{$name}}.val());
        {{$name}}_editor.getSession().on("change", function () {
            {{$name}}.val({{$name}}_editor.getSession().getValue());
        });
    });
</script>
