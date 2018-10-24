<h1>{!! @$title !!} <small>{!! @$sub_title !!}</small></h1>

<ol class="breadcrumb">

    @foreach($breadcrumbs as $breadcrumb)

        <li {{$loop->last?'class="active"':''}}><a href="{{@$breadcrumb['url']?$breadcrumb['url']:'#'}}">{!! @$breadcrumb['icon'] !!} {{$breadcrumb['label']}}</a></li>

    @endforeach

</ol>