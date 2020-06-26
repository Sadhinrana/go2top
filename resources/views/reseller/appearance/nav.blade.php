<div class="col-md-2 col-md-offset-1">
    <ul class="list-group">
        <li class="list-group-item {{ Request::segment(2) == 'appearance' ? 'active' : '' }}">
            <a href="{{ route('reseller.appearance.index') }}">Pages</a>
        </li>
        <li class="list-group-item {{ Request::segment(2) == 'menu' ? 'active' : '' }}" >
            <a href="{{ route('reseller.menu.index') }}">Menu</a>
        </li>
    </ul>        
</div>
