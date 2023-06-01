<div class="row mb-3">
    <div class="col-md-12">
        <div class="row border rounded shadow">
            <div class="col-md-6">
                <div class="images p-3">
                    <div class="text-center pt-4">
                        <img id="main-image" src="{{ $product->image1 }}" width="340" height="400" />
                    </div>
                    <div class="thumbnail text-center">
                        <img onclick="change_image(this)" src="{{ $product->image1 }}" width="70">
                        <img onclick="change_image(this)" src="{{ $product->image2 }}" width="70">
                        <img onclick="change_image(this)" src="{{ $product->image3 }}" width="70">
                    </div>
                </div>
            </div>
            <div class="col-md-6 card-product rounded-end">
                <div class="p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-long-arrow-alt-left"></i>
                            <a href="{{ route('home') }}" class="ms-1 text-decoration-none text-dark fw-bold">Back</a>
                        </div>
                        <i class="fa fa-shopping-cart text-muted"></i>
                    </div>
                    <div class="mt-4 mb-3"> <span class="text-uppercase text-muted">{{ $product->brand }}</span>
                        <h5 class="text-uppercase">{{ $product->title }}</h5>
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
                        <div class="flex-row align-items-center">
                            <p class="fw-bold text-danger text-decoration-line-through m-0">R$
                                {{ number_format($product->price, 2, ',', '') }}</p>
                            <span class="fw-bold fs-3 text-success">R$ {{ $total }}</span>

                        </div>
                    </div>
                    <p class="about">{{ $product->description }}</p>
                    <div class="sizes mt-5">
                        <h6 class="text-uppercase fw-bold">Características principais</h6>
                        <div>
                            <p class="my-0 ms-3"><strong>Vendedor:</strong> {{ $product->user->name }}</p>
                            <p class="my-0 mx-3"><strong>Categoria:</strong> {{ $product->category }}</p>
                            <p class="my-0 mx-3"><strong>Estoque:</strong> {{ $product->stock }}</p>
                        </div>
                    </div>
                    <form action="{{ route('product.purchase') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <div class="cart mt-4 align-items-center">
                            <button class="btn btn-primary text-uppercase mr-2 px-4">Comprar</button>
                            <i class="fa fa-heart text-muted mx-2"></i><i class="fa fa-share-alt text-muted"></i>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    function change_image(image) {
        var container = document.getElementById("main-image");
        container.src = image.src;
    }

    document.addEventListener("DOMContentLoaded", function(event) {});
</script>
