<div class="col-md-2 col-md-offset-1">
    <ul class="list-group">
        <li class="list-group-item {{ Request::segment(2) == 'blog' ? 'active' : '' }}">
            <a href="{{ route('reseller.blog.index') }}">Blog</a>
        </li>

        <li class="list-group-item {{ Request::segment(2) == 'blog-category' ? 'active' : '' }}">
            <a href="{{ route('reseller.blog-category.index') }}">Blog Categories</a>
        </li>

        <li class="list-group-item {{ Request::segment(2) == 'blog-slider' ? 'active' : '' }}">
            <a href="{{ route('reseller.blog-slider.index') }}">Blog Slider</a>
        </li>

    </ul>        
</div>
