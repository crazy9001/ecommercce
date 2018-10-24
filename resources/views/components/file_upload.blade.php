@php($id = strtr($name,["[" => "_","]" => "_"]))
<div class="form-group">
    <label class="control-label">{{$title}}</label>
    <div class="fileupload fileupload-new" data-provides="fileupload">
        <input name="{{$name}}" id="{{$id}}" type="file" class="file-loading file_image_upload" value="{{$value}}">
    </div>
</div>
<script>
    $(document).ready(function() {
        $("#{{$id}}").fileinput({
            browseClass: "btn btn-primary btn-block",
            showCaption: false,
            showRemove: false,
            showUpload: false,
            initialPreview: ["{{$value}}"],
            initialPreviewAsData: true,
            initialPreviewFileType: 'image',
            previewSettings: {
                image: {width: "{{$width}}", height: "{{$height}}"}
            }
        });
    });
</script>
