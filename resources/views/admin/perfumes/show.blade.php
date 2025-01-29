@extends('layouts.app')

@section('title', 'Details Perfume')

@section('content')
    <h1>{{ $perfume->name }}</h1>
    <p><strong>Brand:</strong> {{ $perfume->brand }}</p>
    <p><strong>Price:</strong> ${{ $perfume->price }}</p>
    <p><strong>Category:</strong> {{ $perfume->category }}</p>
    <p><strong>Description:</strong> {{ $perfume->description }}</p>
    <a href="{{ route('perfumes.edit', $perfume->slug) }}" class="btn btn-warning">Edit</a>
    <a href="{{ route('perfumes.index') }}" class="btn btn-secondary">Back to List</a>
@endsection
