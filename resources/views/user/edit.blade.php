@extends('shoe.edit')

@section('title', 'Editar Tênis')

@section('content')
<div class="container">
    <h1>Editar Tênis</h1>

    <form action="{{ route('shoes.update', $shoe->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="model">Modelo:</label>
            <input type="text" id="model" name="model" class="form-control" value="{{ old('model', $shoe->model) }}" required>
        </div>
        <div class="form-group">
                 <label for="brand_id">Marca:</label>
                    <select id="brand_id" name="brand_id" class="form-control" required>
                          @foreach($brands as $brand)
                               <option value="{{ $brand->id }}" {{ $brand->id == $shoe->brand_id ? 'selected' : '' }}>
                                     {{ $brand->name }}
                             </option>
                         @endforeach
                     </select>
        </div>

        <div class="form-group">
            <label for="size">Tamanho:</label>
            <input type="text" id="size" name="size" class="form-control" value="{{ old('size', $shoe->size) }}" required>
        </div>

        <div class="form-group">
            <label for="color">Cor:</label>
            <input type="text" id="color" name="color" class="form-control" value="{{ old('color', $shoe->color) }}" required>
        </div>

        <div class="form-group">
            <label for="description">Descrição:</label>
            <textarea id="description" name="description" class="form-control" required>{{ old('description', $shoe->description) }}</textarea>
        </div>

        <div class="form-group">
            <label for="image">Imagem:</label>
            <input type="file" id="image" name="image" class="form-control">
            @if ($shoe->image)
                <p>Imagem atual:</p>
                <img src="{{ asset('storage/' . $shoe->image) }}" alt="Imagem atual" width="100">
            @endif
        </div>

        <div class="form-group">
            <label for="price">Preço:</label>
            <input type="number" id="price" name="price" class="form-control" value="{{ old('price', $shoe->price) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
</div>
@endsection
