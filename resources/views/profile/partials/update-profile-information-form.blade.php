<section>

    <header class="mb-4">
        <h2 class="fw-bold fs-4">
            Información del Perfil
        </h2>

        <p class="text-muted">
            Actualiza la información de tu cuenta y datos personales.
        </p>
    </header>

    <form id="send-verification"
          method="post"
          action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post"
          action="{{ route('profile.update') }}"
          class="mt-4"
          enctype="multipart/form-data">

        @csrf
        @method('patch')

        {{-- Nombre --}}
        <div class="mb-3">
            <label class="form-label fw-bold">Nombre</label>

            <input type="text"
                   name="name"
                   class="form-control"
                   value="{{ old('name', $user->name) }}"
                   required>

            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        {{-- Email --}}
        <div class="mb-3">
            <label class="form-label fw-bold">Correo Electrónico</label>

            <input type="email"
                   name="email"
                   class="form-control"
                   value="{{ old('email', $user->email) }}"
                   required>

            @error('email')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())

            <div class="alert alert-warning">

                Tu correo no está verificado.

                <button form="send-verification"
                        class="btn btn-sm btn-dark ms-2">
                    Reenviar verificación
                </button>

            </div>

            @if (session('status') === 'verification-link-sent')

                <div class="alert alert-success">
                    Se envió un nuevo enlace de verificación.
                </div>

            @endif

        @endif

        <hr>

        <h5 class="fw-bold mb-3">Información Personal</h5>

        {{-- Teléfono --}}
        <div class="mb-3">
            <label class="form-label fw-bold">Teléfono</label>

            <input type="text"
                   name="phone"
                   class="form-control"
                   value="{{ old('phone', auth()->user()->phone) }}">

            @error('phone')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        {{-- Dirección --}}
        <div class="mb-3">
            <label class="form-label fw-bold">Dirección</label>

            <input type="text"
                   name="address"
                   class="form-control"
                   value="{{ old('address', auth()->user()->address) }}">

            @error('address')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        {{-- DPI --}}
        <div class="mb-3">
            <label class="form-label fw-bold">DPI / Identificación</label>

            <input type="text"
                   name="dpi"
                   class="form-control"
                   value="{{ old('dpi', auth()->user()->dpi) }}">

            @error('dpi')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <hr>

        <h5 class="fw-bold mb-3">Foto de Perfil</h5>

        @if(auth()->user()->profile_photo)

            <div class="mb-3">
                <img src="{{ asset('storage/'.auth()->user()->profile_photo) }}"
                     class="rounded-circle shadow-sm"
                     width="120"
                     height="120"
                     style="object-fit: cover;">
            </div>

        @endif

        <div class="mb-3">

            <input type="file"
                   name="profile_photo"
                   class="form-control">

            @error('profile_photo')
                <small class="text-danger">{{ $message }}</small>
            @enderror

        </div>

        <hr>

        <h5 class="fw-bold mb-3">Foto del DPI</h5>

        @if(auth()->user()->dpi_photo)

            <div class="mb-3">
                <img src="{{ asset('storage/'.auth()->user()->dpi_photo) }}"
                     class="img-fluid rounded shadow-sm"
                     style="max-width: 300px;">
            </div>

        @endif

        <div class="mb-3">

            <input type="file"
                   name="dpi_photo"
                   class="form-control">

            @error('dpi_photo')
                <small class="text-danger">{{ $message }}</small>
            @enderror

        </div>

        <hr>

        <div class="mb-4">

            <h5 class="fw-bold">Estado de Cuenta</h5>

            @if(auth()->user()->is_verified)

                <span class="badge bg-success">
                    Usuario Verificado
                </span>

            @else

                <span class="badge bg-secondary">
                    Usuario No Verificado
                </span>

            @endif

        </div>

        <button class="btn btn-dark">
            Guardar Cambios
        </button>

        @if (session('status') === 'profile-updated')

            <span class="text-success ms-3">
                Guardado correctamente.
            </span>

        @endif

    </form>

</section>