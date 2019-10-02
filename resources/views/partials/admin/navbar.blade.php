<nav class="sidebar-nav">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="nav-icon icon-speedometer"></i> Dashboard
            </a>
        </li>
        <li class="nav-title">Articulos</li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route("articles") }}">
            <i class="nav-icon icon-puzzle"></i> Listado</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route("category") }}">
            <i class="nav-icon icon-tag"></i> Categorias</a>
        </li>
        <li class="nav-title">Ventas</li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('sale.create')}}">
            <i class="nav-icon icon-credit-card"></i> Caja</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('sales')}}">
            <i class="nav-icon icon-basket"></i> Ventas</a>
        </li>
    </ul>
</nav>
<button class="sidebar-minimizer brand-minimizer" type="button"></button>