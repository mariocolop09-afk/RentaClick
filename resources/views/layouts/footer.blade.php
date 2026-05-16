<footer class="bg-dark text-white mt-5 pt-4 pb-3">
    <div class="container">

        <div class="row">

            <div class="col-md-4 mb-3">
                <h5 class="fw-bold">RentaClick</h5>
                <p class="text-white-50">
                    Plataforma de alquiler de productos: vehículos, herramientas, hogar y más.
                </p>
            </div>

            <div class="col-md-4 mb-3">
                <h6 class="fw-bold">Enlaces</h6>
                <ul class="list-unstyled">
                    <li><a href="{{ route('home') }}" class="text-white-50 text-decoration-none">Inicio</a></li>
                    <li><a href="{{ route('products.index') }}" class="text-white-50 text-decoration-none">Productos</a></li>
                    @auth
                        <li><a href="{{ route('dashboard') }}" class="text-white-50 text-decoration-none">Dashboard</a></li>
                    @endauth
                </ul>
            </div>

            <div class="col-md-4 mb-3">
                <h6 class="fw-bold">Contacto</h6>
                <p class="text-white-50 mb-1">📍 Guatemala</p>
                <p class="text-white-50 mb-1">📧 contacto@rentaclick.com</p>
                <p class="text-white-50 mb-0">📞 +502 0000-0000</p>
            </div>

        </div>

        <hr class="border-secondary">

        <div class="text-center text-white-50">
            © {{ date('Y') }} RentaClick - Todos los derechos reservados.
        </div>

    </div>
</footer>
