<aside class="widget widget_latestposts blog_categories">
    <div class="blog_category title">
        <h3 class="widget-title">Categories</h3>
    </div>
    <div class="blog_contents">
        @foreach ($category_lists as $category)
            <div class="each_category_box">
            <h5><a title="{{$category->name}}" href="{{url('blog?filter_by_category='.$category->id)}}"><b>{{$category->name}} ({{$category->count_posts??0}})</b></a></h5>
            </div>    
        @endforeach
        
    </div>

</aside>