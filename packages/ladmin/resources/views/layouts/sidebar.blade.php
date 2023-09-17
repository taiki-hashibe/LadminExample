<nav class="col-md-2 d-none d-md-block bg-light border-end sidebar" style="min-height: 100vh">
    <div class="sidebar-sticky pt-3">
        <ul class="nav flex-column">
            @foreach (Ladmin::getNavigation('navigation') as $item)
                <li class="nav-item">
                    <a class="nav-link text-dark @if ($item->isActive()) fw-bold @endif"
                        href="{{ $item->getRoute() }}">
                        {{ $item->getLabel() }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</nav>
