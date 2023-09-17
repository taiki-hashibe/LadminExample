<nav class="col-md-2 d-none d-md-block bg-light border-end sidebar" style="min-height: 100vh">
    <div class="sidebar-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link text-dark active" href="#">
                    Dashboard
                </a>
            </li>
            @foreach (Ladmin::getNavigation('navigation') as $item)
                <li class="nav-item">
                    <a class="nav-link text-dark" href="{{ $item->getRoute() }}">
                        {{ $item->getLabel() }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</nav>
