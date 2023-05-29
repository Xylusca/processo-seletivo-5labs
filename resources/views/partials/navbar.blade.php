<div class="shadow">
    <div class="container">
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4">
            <a href="{{ route('home') }}"
                class="d-flex fs-2 fw-bold align-items-center col-md-3 mb-2 mb-md-0 text-primary text-decoration-none">
                <i class="fas fa-store"></i> <label class="ms-3">STORE</label>
            </a>

            <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                <li><a href="{{ route('home') }}" class="nav-link px-2 link-secondary">Home</a></li>
                <li><a href="#" class="nav-link px-2 link-dark">Category</a></li>
                <li><a href="#" class="nav-link px-2 link-dark">Pricing</a></li>
                <li><a href="#" class="nav-link px-2 link-dark">FAQs</a></li>
                <li><a href="#" class="nav-link px-2 link-dark">About</a></li>
            </ul>

            @if (Auth::check())
                <div class="col-md-3 text-end">
                    <div class="flex-shrink-0 dropdown">
                        <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle"
                            id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user fs-5"></i>
                        </a>
                        <ul class="dropdown-menu text-small shadow dropdown-menu-end" aria-labelledby="dropdownUser2">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Meu Perfil</a></li>

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
                </div>
            @else
                <div class="col-md-3 text-end">
                    <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">Entrar</a>
                    <a href="{{ route('loginForm') }}" class="btn btn-primary">Cadastrar</a>
                </div>
            @endif
        </header>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.dropdown-toggle').on('click', function(e) {
            e.preventDefault();
            $(this).siblings('.dropdown-menu').toggle();
        });
    });
</script>
