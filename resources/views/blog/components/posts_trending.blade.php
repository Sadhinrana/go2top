<!-- Section Header -->
<aside class="widget widget_latestposts">
    <h3 class="widget-title">TRENDING</h3>
</div><!-- Section Header /- -->
<div class="trending-carousel">
    @foreach ($trendingPosts as $post)
        <div class="type-post">
            <div class="entry-cover"><a href="{{ URL::to('blog/post/'.$post->slug) }}"><img src="{{$post->image}}" alt="{{$post->title}}" /></a></div>
            <div class="entry-content">
                <div class="entry-header">
                    <span><a href="#" title="INSTAGRAM">{{$post->category->name}}</a></span>
                    <h3 class="entry-title"><a href="#"><b>{{$post->title}}</b></a></h3>
                </div>
            </div>
        </div>
    @endforeach
    
</div>