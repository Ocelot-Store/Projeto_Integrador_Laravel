@extends('user.layout')

@section('title', 'Editar Tênis')
<link rel="stylesheet" href="{{ asset('css/shoe/editShoe.css') }}">
@section('content')


<div class="form-edit">
    <form action="{{ route('shoe.update', $shoe->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!-- This adds the PUT method -->
    
        <!-- Exibição de mensagens de erro gerais -->
        @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif
    
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
       <h1> Editar tenis </h1>
        <!-- Campo Modelo -->
        <label for="model">Modelo:</label>
        <input type="text" name="model" value="{{ old('model', $shoe->model) }}" required>
        @error('model')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    
        <!-- Campo Marca -->
        <label for="brand_id">Marca:</label>
        <select name="brand_id" required>
            @foreach($brands as $brand)
            <option value="{{ $brand->id }}" {{ $shoe->brand_id == $brand->id ? 'selected' : '' }}>
                {{ $brand->name }}
            </option>
            @endforeach
        </select>
        @error('brand_id')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    
        <!-- Campo Preço -->
        <label for="price">Preço:</label>
        <input type="number" name="price" value="{{ old('price', $shoe->price) }}" required>
        @error('price')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    
        <!-- Campo Tamanho -->
        <label for="size">Tamanho:</label>
        <input type="text" name="size" value="{{ old('size', $shoe->size) }}" required>
        @error('size')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    
        <!-- Campo Cor -->
        <label for="color">Cor:</label>
        <input type="text" name="color" value="{{ old('color', $shoe->color) }}" required>
        @error('color')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    
        <!-- Campo Descrição -->
        <label for="description">Descrição:</label>
        <textarea name="description" required>{{ old('description', $shoe->description) }}</textarea>
        @error('description')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    
        <!-- Campo Imagem -->
    
    
        <!-- Exibir imagem atual, se houver -->
        @if($shoe->image)
        <div>
            <p><strong>Imagem Atual</strong></p>
            <label for="image">Imagem</label>
        <input type="file" name="image">
        @error('image')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
            <img src="{{ asset('storage/' . $shoe->image) }}" alt="Imagem do Tênis" style="max-width: 200px;">
        </div>
        @endif
    
    
        <div class="btn-salvar">
            <button type="submit">SALVAR ALTERAÇÕES</button>
        </div>
    </form>
</div>

@endsection


