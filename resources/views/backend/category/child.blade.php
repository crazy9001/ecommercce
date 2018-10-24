<ol class="dd-list">
    @foreach($category_child as $child)
        <li class="dd-item" data-id="{{$child->id}}">
            <div class="dd-handle">{{$child->title}}</div>
            <div style="position: absolute; top:7px;right: 10px;">
                <a class="btn btn-info btn-xs"
                   href="{{route("$type.index")}}?cat_id={{$child->id}}"><i
                            class="fa fa-database" aria-hidden="true"></i></a>
                <a class="btn btn-default btn-xs"
                   href="{{route("$type.category.edit",$child->id)}}"><i
                            class="fa fa-pencil-square-o"
                            aria-hidden="true"></i></a>
                <a class="btn btn-danger btn-xs delete_element"
                   action="{{route("$type.category.destroy",$child->id)}}"><i
                            class="fa fa-fw fa-trash"></i></a>
            </div>
            @php($category_child = $categories->where('parent_id', $child->id))
            @if($category_child->count())
                @include('backend.category.child')
            @endif
        </li>
    @endforeach
</ol>