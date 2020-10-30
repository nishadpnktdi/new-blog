@extends('/blog/index')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            @foreach($posts as $post)
            <div class="post-preview">
                <a href="/post/{{$post->id}}">
                    <h2 class="post-title">
                        {{$post->title}}
                    </h2>
                    <h3 class="post-subtitle">
                    {{Str::words($post->content,20)}}
                    </h3>
                </a>
                <p class="post-meta">Posted by
                    <a href="#">{{$post->user->name}}</a>
                    on {{$post->created_at->format('M d, Y')}}</p>
            </div>
            <hr>
            @endforeach
            <!-- Pager -->
            <div class="clearfix">
                @if($posts->previousPageUrl())
                <a class="btn btn-primary float-left" href="{{$posts->previousPageUrl()}}">&larr; Newer Posts</a>
                @else
                <a class="btn btn-primary float-left disabled" href="{{$posts->previousPageUrl()}}">&larr; Newer Posts</a>
                @endif
                @if($posts->nextPageUrl())
                <a class="btn btn-primary float-right" href="{{$posts->nextPageUrl()}}">Older Posts &rarr;</a>
                @else
                <a class="btn btn-primary float-right disabled" href="{{$posts->nextPageUrl()}}">Older Posts &rarr;</a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
