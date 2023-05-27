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

            <div class="col-md-3 text-end">
                <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">Login</a>
                <a href="{{ route('loginForm') }}" class="btn btn-primary">Sign-up</a>
            </div>
        </header>
    </div>
</div>
