<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container">

        <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="{{ route('home') }}">
            <img src="{{ asset('images/logo.png') }}" alt="RentaClick Logo" width="40" height="40" class="rounded-circle">
            <span>RentaClick</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('products.index') }}">Productos</a>
                </li>

                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('products.my') }}">Mis Productos</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('rentals.my') }}">Mis Alquileres</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('rentals.received') }}">Alquileres Recibidos</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('chat.index') }}">Chat</a>
                    </li>

                    @php
                        $unread = \App\Models\Notification::where('user_id', auth()->id())
                            ->where('is_read', false)
                            ->count();
                    @endphp

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('notifications.index') }}">
                            Notificaciones
                            @if($unread > 0)
                                <span class="badge bg-danger">{{ $unread }}</span>
                            @endif
                        </a>
                    </li>

                    @if(auth()->user()->is_admin)
                        <li class="nav-item">
                            <a class="nav-link text-warning fw-bold" href="{{ route('admin.dashboard') }}">Admin</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-danger fw-bold" href="{{ route('admin.reports') }}">Reportes</a>
                        </li>
                    @endif
                @endauth
            </ul>

            <ul class="navbar-nav">

                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Registro</a>
                    </li>
                @endguest

                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            {{ auth()->user()->name }}
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Perfil</a></li>
                            <li><a class="dropdown-item" href="{{ route('payments.my') }}">Mis Pagos</a></li>
                            <li><a class="dropdown-item" href="{{ route('payments.earnings') }}">Mis Ingresos</a></li>
                            <li><a class="dropdown-item" href="{{ route('favorites.index') }}">Mis Favoritos</a></li>

                            <li><hr class="dropdown-divider"></li>

                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item text-danger">Cerrar sesión</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endauth

            </ul>

        </div>
    </div>
</nav>
