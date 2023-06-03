<div class="col border-5" id="receita-view">
    <div class="card h-100 shadow">
        <a href="{{ route('product.show', ['id' => $product->id]) }}">
            <div class="ratio ratio-1x1">
                <img src="{{ $product->image1 }}" class="card-img-top" alt=" {{ $product->title }}" />
            </div>
        </a>
        <div class="card-body">
            <h5 class="card-title">
                <a href="{{ route('product.show', ['id' => $product->id]) }}" class="text-decoration-none text-reset">
                    {{ $product->title }}
                </a>
            </h5>
            @php
                $roundedRating = floor($product->rating);
                $originalRating = $product->rating;
            @endphp
            @for ($i = 1; $i <= 5; $i++)
                @if ($i <= $roundedRating)
                    <i class="fas fa-star text-warning"></i>
                @elseif ($i - 0.5 <= $originalRating)
                    <i class="fas fa-star-half-alt text-warning"></i>
                @else
                    <i class="far fa-star text-warning"></i>
                @endif
            @endfor
            <h6 class="card-subtitle my-2 text-muted">
                <i class="fas fa-user"></i>
                {{ $product->user->name }}
                <a href="{{ route('home') }}/?category={{ $product->category }}"
                    class="text-primary link-underline text-decoration-none">
                    <i class="fas fa-filter"></i>
                    {{ $product->category }}
                </a>

            </h6>

            <p class="card-text">{{ $product->description }}</p>
        </div>
        <div class="card-footer border-0 bg-white">
            <div class="buy d-flex justify-content-between align-items-center mb-2">
                <div class="price text-success mt-3">
                    @if (number_format($product->price, 2, ',', '') !=
                            ($total = number_format($product->price * (1 - $product->discount_percentage / 100), 2, ',', '')))
                        <h6 class="m-0 text-danger text-decoration-line-through">R$
                            {{ number_format($product->price, 2, ',', '') }}</h6>
                    @endif
                    <h5>R$
                        {{ $total = number_format($product->price * (1 - $product->discount_percentage / 100), 2, ',', '') }}
                    </h5>
                </div>
                <a href="{{ route('product.show', ['id' => $product->id]) }}" class="btn btn-primary mt-3"><i
                        class="fas fa-shopping-cart"></i> Comprar</a>
            </div>
        </div>
    </div>
</div>
