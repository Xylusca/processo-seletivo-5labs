<div class="d-flex justify-content-end flex-column flex-md-row mb-3">
    <div class="mb-2 mb-md-0 d-flex">
        <span class="me-1 fw-bold">Categoria por</span>
        <div class="dropdown">
            <span class="dropdown-toggle dropdown-toggle-split" id="categoryDropdown" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                @if ($selectedCategory)
                    {{ $selectedCategory }}
                @else
                    Todos
                @endif
            </span>
            <div class="dropdown-menu" aria-labelledby="categoryDropdown">
                <a class="dropdown-item{{ empty($selectedCategory) ? ' active' : '' }}"
                    href="{{ request()->fullUrlWithQuery(['category' => '']) }}">Todos</a>
                @foreach ($categories as $category)
                    <a class="dropdown-item{{ $category === $selectedCategory ? ' active' : '' }}"
                        href="{{ request()->fullUrlWithQuery(['category' => $category]) }}">{{ $category }}</a>
                @endforeach
            </div>
        </div>
    </div>
    <div class="mb-2 mb-md-0 d-flex">
        <span class="me-1 fw-bold">Ordenar por</span>
        <div class="dropdown">
            <span class="dropdown-toggle dropdown-toggle-split" id="orderDropdown" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                @if ($order === 'rating')
                    Mais relevante
                @elseif ($order === 'price_asc')
                    Menor preço
                @elseif ($order === 'price_desc')
                    Maior preço
                @endif
            </span>
            <div class="dropdown-menu" aria-labelledby="orderDropdown">
                <a class="dropdown-item{{ $order === 'rating' ? ' active' : '' }}"
                    href="{{ request()->fullUrlWithQuery(['order' => 'rating']) }}">Mais relevante</a>
                <a class="dropdown-item{{ $order === 'price_asc' ? ' active' : '' }}"
                    href="{{ request()->fullUrlWithQuery(['order' => 'price_asc']) }}">Menor preço</a>
                <a class="dropdown-item{{ $order === 'price_desc' ? ' active' : '' }}"
                    href="{{ request()->fullUrlWithQuery(['order' => 'price_desc']) }}">Maior preço</a>
            </div>
        </div>
    </div>
</div>
