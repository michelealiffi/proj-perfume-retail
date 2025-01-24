@extends('layouts.admin')

@section('content')
    <h1>{{ $perfume->name }}</h1>
    <p><strong>Brand:</strong> {{ $perfume->brand }}</p>
    <p><strong>Price:</strong> ${{ $perfume->price }}</p>
    <p><strong>Category:</strong> {{ $perfume->category }}</p>
    <p><strong>Description:</strong> {{ $perfume->description }}</p>
    <a href="{{ route('admin.perfumes.edit', $perfume->id) }}" class="btn btn-warning">Edit</a>
    <a href="{{ route('admin.perfumes.index') }}" class="btn btn-secondary">Back to List</a>
@endsection
