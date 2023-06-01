@php
    $product = $purchase->product;
@endphp
<div class="container mb-4">
    <div class="d-flex justify-content-center row">
        <div class="col-md-12">
            <div class="row p-2 bg-white border rounded">
                <div class="col-md-3 mt-1">
                    <img class="img-fluid img-responsive rounded product-image" src="{{ $product->image1 }}" alt="{{ $product->title }}">
                </div>
                <div class="col-md-6 mt-1">
                    <h5>{{ $product->title }}</h5>
                    <div class="mt-1 mb-1 spec-1">
                        <span>{{ $product->description }}.</span>
                        <span>Vendido por <strong>{{$product->user->name}}</strong></span>
                        <span class="text-primary">Unidades: {{ $purchase->quantity }}</span>
                    </div>
                </div>
                <div class="align-items-center align-content-center col-md-3 border-left mt-1">
                    <div class=" flex-row align-items-center">
                        <h6 class="m-0 text-secondary">{{ $purchase->created_at->format('F d Y') }}</h6>
                        <h4 class="strike-text">R$ {{ number_format($purchase->total_price, 2, ',', '') }}</h4>
                    </div>
                    <h6 class="text-success">Free shipping</h6>
                    <div class="d-flex flex-column mt-4">
                        <a href="{{ route('product.show', ['id' => $product->id]) }}" class="btn btn-primary btn-sm" type="button">Detalhes</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
