<div class="shadow">
    <header class="d-flex flex-wrap align-items-center justify-content-evenly spac py-3 mb-4">
        <a href="{{ route('home') }}"
            class="d-flex fs-2 fw-bold align-items-center col-md-3 mb-2 mb-md-0 text-primary text-decoration-none">
            <i class="fas fa-store"></i> <label class="ms-3">STORE</label>
        </a>

        <div class="col-md-3 d-flex justify-content-end">
            @if (Auth::check())
                <div class="me-4 fw-bold p-2 border border rounded-pill "> <label for="Creditos">Créd</label>
                    {{ number_format(Auth::user()->credits, 2, ',', '') }}</div>
                <div class="flex-shrink-0 dropdown">
                    <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser2"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user fs-3 mt-2"></i>
                    </a>
                    <ul class="dropdown-menu text-small shadow dropdown-menu-end" aria-labelledby="dropdownUser2">
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Meu Perfil</a></li>
                        <li><a class="dropdown-item" href="{{ route('purchases') }}">Minhas Compras</a></li>

                        @if (Auth::user()->nivel_id >= 2)
                            @if (Auth::user()->status === 'pendente')
                                <li><span class="dropdown-item disabled">Cadastro de Produto</span></li>
                                <li><span class="dropdown-item disabled">Meus Produtos</span></li>
                                <li><span class="dropdown-item disabled">Minhas Vendas</span></li>
                            @else
                                <li><a class="dropdown-item" href="{{ route('product.form') }}">Cadastro de Produto</a>
                                </li>
                                <li><a class="dropdown-item" href="{{ route('myProduct') }}">Meus Produtos</a></li>
                                <li><a class="dropdown-item" href="{{ route('sales') }}">Minhas Vendas</a></li>
                            @endif
                        @endif


                        @if (Auth::user()->nivel_id == 3)
                            <li><a class="dropdown-item" href="{{ route('usuarios') }}">Usuários</a></li>
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
