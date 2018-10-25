<ol class="dd-list">
    @foreach($menu_child as $menu)
        <li class="dd-item" data-id="{{$menu->id}}">
            {{Form::cMenuItem($menu)}}
            @php($menu_child = $menus->where('parent_id', $menu->id))
            @if(count($menu_child))
                @include('backend.menu.child')
            @endif
        </li>
    @endforeach
</ol>
