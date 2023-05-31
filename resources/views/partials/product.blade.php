<div class="col border-5" id="receita-view">
    <div class="card h-100 shadow">
        <a href="{% url 'recipes:recipe' recipe.id %}">
            <div class="ratio ratio-16x9">
                <img src="{{ $product->thumbnail }}" class="card-img-top" alt="Temporário" />
            </div>
        </a>
        <div class="card-body">
            <h5 class="card-title">
                <a href="" class="text-decoration-none text-reset">
                    {{ $product->title }}
                </a>
            </h5>

            <h6 class="card-subtitle mb-2 text-muted">
                <i class="fas fa-user"></i>
                {{ $product->user->name }}
                <a href="" class="text-primary link-underline text-decoration-none">
                    <i class="fas fa-filter"></i>
                    {{ $product->category }}
                </a>

            </h6>

            <p class="card-text">{{ $product->description }}</p>
        </div>
        <div class="card-footer border-0 bg-white">
            <div class="buy d-flex justify-content-between align-items-center">
                <div class="price text-success">
                    <h5 class="mt-4">R$ {{ $product->price }}</h5>
                </div>
                <a href="#" class="btn btn-primary mt-3"><i class="fas fa-shopping-cart"></i> Comprar</a>
            </div>
        </div>
    </div>
</div>
