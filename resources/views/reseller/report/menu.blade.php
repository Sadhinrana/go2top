<ul class="nav nav-pills bg-white rounded-pill align-items-center">
    <li class="nav-item">
        <a href="{{ route('reseller.reports.index') }}" class="nav-link rounded-pill note-link d-flex align-items-center px-2 px-md-3 mr-0 mr-md-2 {{ request()->is('reseller/reports') ? 'active' : '' }}">
            <span class="d-none d-md-block">Payments</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('reseller.reports.order') }}" class="nav-link rounded-pill note-link d-flex align-items-center px-2 px-md-3 mr-0 mr-md-2 {{ request()->is('reseller/reports/order') ? 'active' : '' }}">
            <span class="d-none d-md-block">Orders</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('reseller.reports.ticket') }}" class="nav-link rounded-pill note-link d-flex align-items-center px-2 px-md-3 mr-0 mr-md-2 {{ request()->is('reseller/reports/ticket') ? 'active' : '' }}">
            <span class="d-none d-md-block">Tickets</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('reseller.reports.profits') }}" class="nav-link rounded-pill note-link d-flex align-items-center px-2 px-md-3 mr-0 mr-md-2 {{ request()->is('reseller/reports/profits') ? 'active' : '' }}">
            <span class="d-none d-md-block">Profits</span>
        </a>
    </li>
</ul>
