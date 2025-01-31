@extends('layouts.app')

@section('title', 'Details Perfume')

@section('content')
    <div class="container py-2">
        <h1 class="text-center py-2">{{ $perfume->name }}</h1>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-4">
                    <img src="{{ asset('storage/' . $perfume->image) }}" alt="{{ $perfume->name }}" class="img-fluid rounded"
                        style="height: 700px; weight: auto;">
                </div>
            </div>

            <div class="col-md-6">
                <!-- Dati del profumo -->
                <p><strong>Brand:</strong> {{ $perfume->brand }}</p>
                <p><strong>Category:</strong> {{ $perfume->category }}</p>
                <p><strong>Subcategory:</strong> {{ $perfume->subcategory }}</p>

                <p><strong>Description:</strong> {{ $perfume->description }}</p>

                <p><strong>Notes:</strong>
                    @foreach ($perfume->notes as $note)
                        {{ $note }}@if (!$loop->last)
                            ,
                        @endif
                    @endforeach
                </p>

                <p><strong>Price:</strong> {{ number_format($perfume->price, 2) }}€</p>
                <p><strong>Size:</strong> {{ $perfume->size }}</p>

                <p><strong>Ingredients:</strong>
                    @foreach ($perfume->ingredients as $ingredient)
                        {{ $ingredient }}@if (!$loop->last)
                            ,
                        @endif
                    @endforeach
                </p>

                <p><strong>Gender:</strong> {{ $perfume->gender }}</p>
                <p><strong>Limited Edition:</strong> {{ $perfume->limited_edition ? 'Yes' : 'No' }}</p>
                <p><strong>Vegan:</strong> {{ $perfume->vegan ? 'Yes' : 'No' }}</p>
                <p><strong>Natural:</strong> {{ $perfume->natural ? 'Yes' : 'No' }}</p>

                <p><strong>Visibility:</strong>
                    @if ($perfume->is_visible)
                        Visible
                    @else
                        Not Visible
                    @endif
                </p>

                <p><strong>Quantity:</strong> {{ $perfume->quantity }}</p>

                <p><strong>Created at:</strong> {{ $perfume->created_at->format('d-m-Y H:i') }}</p>
                <p><strong>Updated at:</strong> {{ $perfume->updated_at->format('d-m-Y H:i') }}</p>
            </div>
        </div>
        <div class="text-center pt-2">
            <a href="{{ route('perfumes.edit', $perfume->slug) }}" class="btn btn-warning mx-2">Edit</a>
            <a href="{{ route('perfumes.index') }}" class="btn btn-secondary mx-2">Back to List</a>
        </div>
    </div>
@endsection
