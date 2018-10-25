<div class="dd-handle">{{@$menu['title']}}</div>
<div style="position: absolute; top:8px;right: 10px;">
    <span style="padding: 0px 10px 0px 10px;">{{trans('main.menu.'.@$menu['type'])}}</span>
    <a data-toggle="collapse"
       data-target="#{{@$menu['id']}}">
        <i class="fa fa-chevron-down" aria-hidden="true"></i>
    </a>
</div>
<div id="{{@$menu['id']}}" class="collapse" style="border: 1px solid rgba(0,0,0,.15); padding: 20px">
    <form class="ajax_submit" action="{{route('menu.update', @$menu['id'])}}" method="POST">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <div class="form-group">
            <label for="name">Tiêu đề</label>
            <input type="text" class="form-control" placeholder="Tên Menu" value="{{@$menu['title']}}"
                   name="title">
        </div>

        @if(@$menu['type'] == 'link')
            <div class="form-group">
                <label>Liên kết</label>
                <input type="text" class="form-control" placeholder="Đường dẫn" value="{{@$menu['link']}}">
            </div>
        @elseif(@$menu['type'] == 'post')
            <div class="form-group">
                @php($post = \App\Models\PostCategory::find(@$menu['type_id']))
                <label>Danh mục</label>
                <input type="text" class="form-control" disabled value="{{@$post['title']??'Danh mục bị xóa'}}">
                <a href="{{route('post.category.edit', @$menu['type_id'])}}"><i class="fa fa-pencil"
                                                                                aria-hidden="true"></i> Sửa danh mục</a>
                -
                <a href="{{route('post.index', ['cat_id'=>@$menu['type_id']])}}"><i class="fa fa-table"
                                                                                    aria-hidden="true"></i> Danh sách
                    bài viết</a>
            </div>
        @elseif(@$menu['type'] == 'product')
            <div class="form-group">
                @php($product = \App\Models\ProductCategory::find(@$menu['type_id']))
                <label>Danh mục</label>
                <input type="text" class="form-control" disabled value="{{@$product['title']??'Danh mục bị xóa'}}">
                <a href="{{route('product.category.edit', @$menu['type_id'])}}"><i class="fa fa-pencil"
                                                                                   aria-hidden="true"></i> Sửa danh mục</a>
                -
                <a href="{{route('product.index', ['cat_id'=>@$menu['type_id']])}}"><i class="fa fa-table"
                                                                                       aria-hidden="true"></i> Danh sách
                    bài viết</a>
            </div>
        @elseif(@$menu['type'] == 'page')
            <div class="form-group">
                @php($page = \App\Models\Page::find(@$menu['type_id']))
                <label>Trang</label>
                <input type="text" class="form-control" disabled value="{{@$page['title']??'Trang bị xóa'}}">
                <a href="{{route('page.edit', @$menu['type_id'])}}"><i class="fa fa-pencil" aria-hidden="true"></i> Sửa
                    Nội dung</a>
            </div>
        @endif
        <div class="form-group">
            <input hidden name="new_tab" value="0">
            <input type="checkbox" name="new_tab" value="1" c-type="icheck"
                   class="new_tab" <?= @$menu['new_tab'] ? 'checked' : '' ?> ><i class="indigo"></i> Mở tab mới
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success">Cập nhật</button>
            <button type="button" class="btn btn-danger remove_menu_item"
                    action="{{route('menu.destroy',@$menu['id'])}}">Xóa
            </button>
        </div>
    </form>
</div>