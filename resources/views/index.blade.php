@extends('layouts.app')

@section('title', 'Perfume Shop')

@section('content')
    <h1 class="my-8 text-center display-4">Perfume Shop</h1>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
        @foreach ($perfumes as $perfume)
            <div class="col">
                <div class="m-2 card h-100">
                    <img src="{{ Storage::url('' . $perfume->image) }}" class="card-img-top" alt="{{ $perfume->name }}"
                        style="object-fit: cover; height: 450px;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $perfume->name }}</h5>
                        <p class="card-text text-muted">{{ $perfume->brand }}</p>
                        <p class="card-text h5 text-primary">{{ $perfume->price }}€</p>
                        <div class="d-flex justify-content-between align-items-center">
                            @if ($perfume->is_visible)
                                <span class="badge bg-success">Available</span>
                            @else
                                <span class="badge bg-danger">Out of Stock</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
