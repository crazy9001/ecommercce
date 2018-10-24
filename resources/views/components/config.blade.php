@if($config['type'] == 'text')
    {{ Form::cText($config['label'], $name, $value) }}
@elseif($config['type'] == 'number')
    {{ Form::cNumber($config['label'], $name, $value) }}
@elseif($config['type'] == 'link')
    {{ Form::cText($config['label'], $name, $value) }}
    {{ Form::cText('Đường dẫn', $name, $value) }}
@elseif($config['type'] == 'textarea')
    {{ Form::cTextArea($config['label'], $name, $value) }}
@elseif($config['type'] == 'editor')
    {{ Form::cTextEditor($config['label'], $name, $value) }}
@elseif($config['type'] == 'image')
    {{ Form::cFileSelect($config['label'] ." (" . $config['width'] . 'x'. $config['height'] . ")", $name, $value, '100%', '180px') }}
@endif
