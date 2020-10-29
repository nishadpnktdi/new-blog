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
            {{dd($posts)}}
                <a class="btn btn-primary float-right" href="#">Older Posts &rarr;</a>
            </div>
        </div>
    </div>
</div>
@endsection
