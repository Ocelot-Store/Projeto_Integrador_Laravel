@extends('shoe.layout')
@section('title', 'Adicionar calçado')

@section('style')
<link rel="stylesheet" href="{{ asset('css/shoe/addShoe.css') }}">
<!-- Esse arquivo acima ainda não foi criado -->
@endsection

@section('content')
<div class="container">
    <div class="mt-5">
        @if($errors->any())
        <div class="col-12">
            @foreach($errors->all() as $error)
            <div class="alert alert-danger">{{$error}}</div>
            @endforeach
        </div>
        @endif

        @if(session()->has('error'))
        <div class="alert alert-danger">{{session('error')}}</div>
        @endif

        @if(session()->has('success'))
        <div class="alert alert-success">{{session('success')}}</div>
        @endif
    </div>
    <form action="{{route('addShoe.post')}}" method="POST" class="ms-auto me-auto mt-3" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="model" class="form-label">Modelo</label>
            <input type="text" class="form-control" name="model" required>
        </div>

        <div>
            <label for="price">Preço</label>
            <input type="number" class="form-control" name="price" required step="0.01"><br>
        </div>

        <div class="mb-3">
            <label for="sizes" class="form-label">Tamanhos e Quantidades</label>
            <div id="sizes-container">
                <div class="size-group d-flex mb-2">
                    <input type="number" class="form-control me-2" name="sizes[0][size]" placeholder="Tamanho" required>
                    <input type="number" class="form-control" name="sizes[0][quantity]" placeholder="Quantidade" required>
                    <button type="button" class="btn ms-2 remove-size-btn" style="border: 1px solid grey;" onclick="removeSize(this)">-</button>
                </div>
            </div>
            <button type="button" class="btn btn-secondary mt-2 adicionar-tamanho" onclick="addSize()">Adicionar Tamanho</button>
        </div>

        <div class="mb-3">
            <label for="color" class="form-label">Cor</label>
            <input type="text" class="form-control" name="color" required>
        </div>



        <label for="brand">Marca</label>
        <div class="mb-3">
            <select name="brand_id" required>
                <option value="">Selecionar uma marca</option>
                @foreach($brands as $brand)
                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                @endforeach
            </select><br>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descrição</label>
            <textarea class="form-control" name="description" rows="3" required></textarea>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Imagem</label>
            <input class="form-control" type="file" name="image" accept=".jpg,.jpeg,.png" required>
        </div>

        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
</div>

<script>
    let sizeIndex = 1;

    function addSize() {
        const container = document.getElementById('sizes-container');
        const sizeGroup = document.createElement('div');
        sizeGroup.className = 'size-group d-flex mb-2';

        sizeGroup.innerHTML = `
        <input type="number" class="form-control me-2" name="sizes[${sizeIndex}][size]" placeholder="Tamanho" required>
        <input type="number" class="form-control" name="sizes[${sizeIndex}][quantity]" placeholder="Quantidade" required>
        <button type="button" class="btn ms-2 remove-size-btn" style="border: 1px solid grey;" onclick="removeSize(this)">-</button>
    `;

        container.appendChild(sizeGroup);
        sizeIndex++;
    }

    function removeSize(button) {
        const sizeGroup = button.closest('.size-group');
        sizeGroup.remove();
    }
</script>
@endsection