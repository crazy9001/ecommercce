<div class="box box-primary">
    <div class="box-header with-border">
        <i class="fa fa-podcast" aria-hidden="true"></i>

        <h3 class="box-title">Thông tin SEO</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="form-group">
            <h3 class="title" style="color:#1a0dab;font-size: 18px;font-family: arial,sans-serif;padding:0;margin: 0;">Tiêu đề seo website không vượt quá 70 kí tự (tốt nhất từ 60-70 kí tự)</h3>
            <div>
                <div style="color:#006621;font-size: 14px;font-family: arial,sans-serif;">{{url('/')}}/<span class="slug"></span>
                </div>
                <div class="seo_description" style="color: #545454;font-size: small;font-family: arial,sans-serif;">Miêu tả seo website không vượt quá 155 kí tự (tốt nhất từ 100-155 kí tự). Là những đoạn mô tả ngắn gọn về website, bài viết...</div>
            </div>
        </div>
        <hr>
        {{Form::cText('Tiêu đề SEO', 'seo_title', old('seo_title')?old('seo_title'):@$seo['seo_title'], ['placeholder'=>'Tiêu đề ...', 'id'=>'seo_title'])}}
        {{Form::cText('Từ khóa', 'seo_keywords', old('seo_keywords')?old('seo_keywords'):@$seo['seo_keywords'], ['placeholder'=>'Từ khóa ...', 'data-role'=>'tagsinput'])}}
        {{Form::cTextArea('Mô tả SEO', 'seo_description', old('seo_description')?old('seo_description'):@$seo['seo_description'])}}
        {{Form::cSwitch('Index,Follow', 'robots', 1, old('robots')?old('robots'):@$seo['robots'], ['data-on-color'=>"success", 'data-off-color'=>"danger", 'data-on-text'=>"On", 'data-off-text'=>"Off"])}}
    </div>
</div>