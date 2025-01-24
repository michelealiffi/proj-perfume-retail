@extends('layouts.app')

@section('content')
    <h1>Welcome to Our Perfume Shop</h1>

    <div class="row">
        @foreach ($perfumes as $perfume)
            <div class="col-md-4">
                <div class="card">
                    <img src="{{ Storage::url('public/images/' . $perfume->image) }}" class="card-img-top"
                        alt="{{ $perfume->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $perfume->name }}</h5>
                        <p class="card-text">{{ $perfume->brand }}</p>
                        <p class="card-text">${{ $perfume->price }}</p>
                        <a href="{{ route('home') }}" class="btn btn-primary">See Details</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
