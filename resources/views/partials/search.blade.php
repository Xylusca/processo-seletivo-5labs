<div class="container my-5">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <form action="{{ route('home') }}" method="GET">
                <div class="input-group shadow border rounded">
                    <input type="search" class="form-control search-input border-0 py-2" name="q"
                        placeholder="Pesquisar" value="{{ isset($searchQuery) ? $searchQuery : '' }}">
                    <button type="submit" class="input-group-text border-0 bg-primary"><i
                            class="fas fa-search text-white"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>
