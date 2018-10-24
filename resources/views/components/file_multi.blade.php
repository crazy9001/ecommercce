@php($id = strtr($name,["[" => "_","]" => "_"]))
<div class="form-group">
    <label class="control-label">{{$title}}</label>
    <input class="hide" name="{{$name}}" id="{{$id}}" type="text" value="{{$value}}">
    @php($preview = $value?explode(',', $value):[])
    <div class="control-label text-center">
        <div class="row preview_gallery" id="preview_{{$id}}">
            @foreach($preview as $image)
                <div class="thumb_item">
                    <a class="close" data-input="{{$id}}" data-value="{{$image}}">×</a>
                    <img class="img-fix" src="{{$image}}">
                </div>
            @endforeach
        </div>
        <button type="button" class="btn btn-primary btn-block filemanager_multi" data-input="{{$id}}" data-preview="preview_{{$id}}">Chọn hình</button>
    </div>
</div>
