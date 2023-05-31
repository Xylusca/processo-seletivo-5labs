<div class="pagination justify-content-center mt-3">
    <ul class="pagination">
        <!-- Link para a primeira página -->
        @if ($products->currentPage() != 1)
            <li class="page-item">
                <a class="page-link" href="{{ $products->url(1) }}" aria-label="Primeira Página">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
        @endif

        <!-- Links das páginas visíveis -->
        @for ($i = max(1, $products->currentPage() - 2); $i <= min($products->lastPage(), $products->currentPage() + 2); $i++)
            <li class="page-item {{ $i == $products->currentPage() ? 'active' : '' }}">
                <a class="page-link" href="{{ $products->url($i) }}">{{ $i }}</a>
            </li>
        @endfor

        <!-- Link para a última página -->
        @if ($products->currentPage() != $products->lastPage())
            <li class="page-item">
                <a class="page-link" href="{{ $products->url($products->lastPage()) }}" aria-label="Última Página">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        @endif
    </ul>
</div>
