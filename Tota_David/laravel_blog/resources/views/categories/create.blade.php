@extends('layouts.app')
@section('title', 'Create category')

@section('content')
<div class="container">
    <h1>Create category</h1>
    <div class="mb-4">
        {{-- TODO: Link --}}
        <a href="#"><i class="fas fa-long-arrow-alt-left"></i> Back to the homepage</a>
    </div>

    {{-- TODO: Session flashes --}}
    @if (Session::has('category_created'))
        <div class="alert alert-success" role="alert">
            Category successfully created with name {{ Session::get('category_created')->name }}
        </div>
    @endif

    {{-- TODO: action, method --}}
    <form action="{{ route('categories.store') }}" method="POST">
        @csrf

        <div class="form-group row mb-3">
            <label for="name" class="col-sm-2 col-form-label">Name*</label>
            <div class="col-sm-10">
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <div class="form-group row mb-3">
            <label for="style" class="col-sm-2 col-form-label py-0">Style*</label>
            <div class="col-sm-10">
                @foreach (['primary', 'secondary','danger', 'warning', 'info', 'dark'] as $style)
                    <div class="form-check">
                        <input
                            class="form-check-input"
                            type="radio"
                            name="style"
                            id="{{ $style }}"
                            value="{{ $style }}"
                            {{-- TODO: checked --}}
                            {{-- {{ old('style') == $style ? 'checked' : '' }} --}}
                            @checked(old('style') == $style)
                        >
                        <label class="form-check-label" for="{{ $style }}">
                            <span class="badge bg-{{ $style }}">{{ $style }}</span>
                        </label>
                    </div>
                @endforeach
                {{-- TODO: Error handling --}}

                @error('style')
                    <p class="text-danger">
                        {{ $message }}
                    </p>
                @enderror
            </div>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Store</button>
        </div>

    </form>
</div>
@endsection
