<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    @if($item)
                        @foreach($item as $link=>$title)
                            @if($link!=='active')
                            <li class="breadcrumb-item"><a href="{{url($link)}}">{{$title}}</a></li>
                            @else
                                <li class="breadcrumb-item active">{{$title}}</li>
                            @endif
                        @endforeach
                    @endif
                </ol>
            </div>
            <h4 class="page-title">{{$pTitle}}</h4>
        </div>
    </div>
</div>