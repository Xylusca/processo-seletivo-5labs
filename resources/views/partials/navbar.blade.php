<div class="shadow">
    <header class="d-flex flex-wrap align-items-center justify-content-center py-3 mb-4">
        <a href="{{ route('home') }}"
            class="d-flex fs-2 fw-bold align-items-center col-md-3 mb-2 mb-md-0 text-primary text-decoration-none">
            <i class="fas fa-store"></i> <label class="ms-3">STORE</label>
        </a>

        <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
            <li><a href="{{ route('home') }}" class="nav-link px-2 link-secondary">Home</a></li>
            <li class="dropdown">
                <a href="#" class="nav-link px-2 link-dark dropdown-toggle" id="dropdownCategory"
                    data-bs-toggle="dropdown" aria-expanded="false">Category</a>
                <ul class="dropdown-menu" aria-labelledby="dropdownCategory">
                    @foreach ($categories as $category)
                        <li><a href=""
                                class="dropdown-item">{{ $category }}</a></li>
                    @endforeach
                </ul>
            </li>
            <li><a href="#" class="nav-link px-2 link-dark">Pricing</a></li>
            <li><a href="#" class="nav-link px-2 link-dark">FAQs</a></li>
            <li><a href="#" class="nav-link px-2 link-dark">About</a></li>
        </ul>

        <div class="col-md-3 d-flex justify-content-end">
            @if (Auth::check())
                <div class="me-4 fw-bold p-2 border border rounded-pill "> <label
                        for="Creditos">Créd</label> {{number_format(Auth::user()->credits, 2, ',', '')   }}</div>
                <div class="flex-shrink-0 dropdown">
                    <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser2"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user fs-3 mt-2"></i>
                    </a>
                    <ul class="dropdown-menu text-small shadow dropdown-menu-end" aria-labelledby="dropdownUser2">
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Meu Perfil</a></li>
                        <li><a class="dropdown-item" href="">Minhas Compras</a></li>

                        @if (Auth::user()->nivel_id >= 2)
                            <li><a class="dropdown-item" href="#">Cadastro de Produtos</a></li>
                            <li><a class="dropdown-item" href="#">Produtos Cadastrados</a></li>
                            <li><a class="dropdown-item" href="#">Minhas Vendas</a></li>
                        @endif

                        @if (Auth::user()->nivel_id == 3)
                            <li><a class="dropdown-item" href="#">Usuários</a></li>
                        @endif

                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="{{ route('logout') }}">Sair</a></li>
                    </ul>
                </div>
            @else
                <div class="text-end">
                    <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">Entrar</a>
                    <a href="{{ route('loginForm') }}" class="btn btn-primary">Cadastrar</a>
                </div>
            @endif
        </div>
    </header>
</div>

<script>
    $(document).ready(function() {
        $('.dropdown-toggle').on('click', function(e) {
            e.preventDefault();
            $(this).siblings('.dropdown-menu').toggle();
        });
    });
</script>
