<aside class="widget widget_latestposts">
    <h3 class="widget-title">Popular Posts</h3>
    @foreach ($PopularPosts as $post)
        <div class="latest-content">
            @php
            if ($post->image!='' || $post->image!=null) {
                $img = file_get_contents(public_path('uploads/blog/thumbnail/thumb-'.$post->image)); 
                $data = 'data:image/jpeg;base64,'.base64_encode($img); 
            }
            
        @endphp
        <a href="{{ URL::to('blog/post/'.$post->slug) }}" title="Recent Posts"><i><img src="{{ isset($post) && $post->image !='' ?  $data : ''}}" class="wp-post-image" alt="{{$post->title}}" /></i></a>
        {{-- <a href="#" title="Recent Posts"><i><img src="/assets/images/popular-1.png" class="wp-post-image" alt="{{$post->title}}" /></i></a> --}}
            <h5><a title="{{$post->title}}" href="#"><b>{{$post->title}}</b></a></h5>
        <span><a href="#">{{ date('M d, Y', strtotime($post->created_at)) }}</a></span>
        </div>
    @endforeach
   
</aside>