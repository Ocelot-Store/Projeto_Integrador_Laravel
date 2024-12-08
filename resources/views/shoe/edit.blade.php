@extends('user.layout')

@section('title', 'Editar Tênis')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/shoe/edit.css') }}">
@endsection

@section('content')
<div class="container mt-5">
    <h1>Editar Tênis</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('shoe.update', $shoe->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="model" class="form-label">Modelo:</label>
                <input type="text" name="model" id="model" class="form-control" value="{{ old('model', $shoe->model) }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="brand_id" class="form-label">Marca:</label>
                <select name="brand_id" id="brand_id" class="form-control" required>
                    <option value="" disabled {{ old('brand_id', $shoe->brand_id) == '' ? 'selected' : '' }}>Selecione uma marca</option>
                    <option value="1" {{ old('brand_id', $shoe->brand_id) == 1 ? 'selected' : '' }}>Nike</option>
                    <option value="2" {{ old('brand_id', $shoe->brand_id) == 2 ? 'selected' : '' }}>Adidas</option>
                    <option value="3" {{ old('brand_id', $shoe->brand_id) == 3 ? 'selected' : '' }}>Puma</option>
                    <option value="4" {{ old('brand_id', $shoe->brand_id) == 4 ? 'selected' : '' }}>Mizuno</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="size" class="form-label">Tamanho:</label>
                <input type="text" name="size" id="size" class="form-control" value="{{ old('size', $shoe->size) }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="color" class="form-label">Cor:</label>
                <input type="text" name="color" id="color" class="form-control" value="{{ old('color', $shoe->color) }}" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="usage" class="form-label">Indicado para:</label>
                <input type="text" name="usage" id="usage" class="form-control" value="{{ old('usage', $shoe->usage) }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="material" class="form-label">Material:</label>
                <input type="text" name="material" id="material" class="form-control" value="{{ old('material', $shoe->material) }}" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="category" class="form-label">Categoria:</label>
                <input type="text" name="category" id="category" class="form-control" value="{{ old('category', $shoe->category) }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="weight" class="form-label">Peso do Produto (g):</label>
                <input type="number" name="weight" id="weight" class="form-control" value="{{ old('weight', $shoe->weight) }}" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="technology" class="form-label">Tecnologia:</label>
                <input type="text" name="technology" id="technology" class="form-control" value="{{ old('technology', $shoe->technology) }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="warranty" class="form-label">Garantia do Fabricante:</label>
                <input type="number" name="warranty" id="warranty" class="form-control" value="{{ old('warranty', $shoe->warranty) }}" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descrição:</label>
            <textarea name="description" id="description" class="form-control" rows="4" required>{{ old('description', $shoe->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Preço:</label>
            <input type="text" name="price" id="price" class="form-control" value="{{ old('price', $shoe->price) }}" required>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Imagem:</label>
            <input type="file" name="image" id="image" class="form-control">
            @if ($shoe->image)
                <img src="{{ asset('storage/' . $shoe->image) }}" class="mt-2 img-thumbnail" width="150">
            @endif
        </div>

        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary">Salvar alterações</button>
            <a href="{{ route('viewShoes') }}" class="btn btn-secondary">Descartar Alterações</a>
        </div>
    </form>
</div>


<div vw class="enabled">
    <div vw-access-button class="active"></div>
    <div vw-plugin-wrapper>
        <div class="vw-plugin-top-wrapper"></div>
    </div>
</div>

<script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
<script>
    new window.VLibras.Widget('https://vlibras.gov.br/app');
</script>

@endsection
