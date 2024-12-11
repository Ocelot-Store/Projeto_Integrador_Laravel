@extends('shoe.layout')
@section('title', 'Adicionar calçado')

@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/shoe/addShoe.css') }}">
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
            <input type="text" class="form-control" name="model" value="{{ old('model') }}" required>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Preço</label>
            <input type="number" class="form-control" name="price" value="{{ old('price') }}" required step="0.01">
        </div>

        <div class="mb-3">
            <label for="sizes" class="form-label">Tamanhos e Quantidades</label>
            <div id="sizes-container">
                @if(old('sizes'))
                    @foreach(old('sizes') as $index => $size)
                        <div class="size-group d-flex mb-2">
                            <input type="number" class="form-control me-2" name="sizes[{{ $index }}][size]" value="{{ $size['size'] }}" placeholder="Tamanho" required>
                            <input type="number" class="form-control" name="sizes[{{ $index }}][quantity]" value="{{ $size['quantity'] }}" placeholder="Quantidade" required>
                            <button type="button" class="remove-size-btn">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                    @endforeach
                @else
                    <div class="size-group d-flex mb-2">
                        <input type="number" class="form-control me-2" name="sizes[0][size]" placeholder="Tamanho" required>
                        <input type="number" class="form-control" name="sizes[0][quantity]" placeholder="Quantidade" required>
                        <button type="button" class="remove-size-btn">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>
                @endif
            </div>
            <button type="button" class="btn-add-size" onclick="addSize()">Adicionar Tamanho</button>
        </div>

        <div class="mb-3">
            <label for="color" class="form-label">Cor</label>
            <input type="text" class="form-control" name="color" value="{{ old('color') }}" required>
        </div>

        <div class="mb-3">
            <label for="brand" class="form-label">Marca</label>
            <select name="brand_id" class="form-control" required>
                <option value="">Selecionar uma marca</option>
                @foreach($brands as $brand)
                    <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                        {{ $brand->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mt-4">
            <button type="button" class="btn-secondary" data-bs-toggle="collapse" data-bs-target="#infoAdicionais" aria-expanded="false" aria-controls="infoAdicionais">
                Informações Adicionais
            </button>
            <div class="collapse" id="infoAdicionais">
                <div class="mb-3 mt-2">
                    <label for="additional_info" class="form-label">Escolha uma opção:</label>
                    <select name="additional_info" class="form-control" id="additional_info">
                        <option value="">Selecione</option>
                        <option value="opcao1" {{ old('additional_info') == 'opcao1' ? 'selected' : '' }}>Indicado Para</option>
                        <option value="opcao2" {{ old('additional_info') == 'opcao2' ? 'selected' : '' }}>Material</option>
                        <option value="opcao3" {{ old('additional_info') == 'opcao3' ? 'selected' : '' }}>Categoria</option>
                        <option value="opcao4" {{ old('additional_info') == 'opcao4' ? 'selected' : '' }}>Tecnologia</option>
                        <option value="opcao5" {{ old('additional_info') == 'opcao5' ? 'selected' : '' }}>Garantia do fabricante</option>
                        <option value="outros" {{ old('additional_info') == 'outros' ? 'selected' : '' }}>Outros</option>
                    </select>

                </div>

                <div class="mb-3" id="other_info_div" style="display: none;">
                    <label for="other_info" class="form-label-especify">Especifique:</label>
                    <textarea class="form-control" name="other_info" id="other_info" rows="1">{{ old('other_info') }}</textarea>

                </div>

                <div class="mb-3">
                    <label for="additional_info_text" class="form-label">Escreva as informações adicionais:</label>
                    <textarea class="form-control" name="additional_info_text" id="additional_info_text" rows="2">{{ old('additional_info_text') }}</textarea>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descrição</label>
            <textarea class="form-control" name="description" rows="4" required>{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Imagem</label>
            <input class="form-control" type="file" name="image" accept=".jpg,.jpeg,.png" required>
        </div>

        <button type="submit" class="btn-submit">Enviar</button>
    </form>
</div>

<script>
    let sizeIndex = {{ count(old('sizes', [])) }}; // Define o índice com base no número de campos antigos

    function addSize() {
        const container = document.getElementById('sizes-container');
        const sizeGroup = document.createElement('div');
        sizeGroup.className = 'size-group d-flex mb-2';

        sizeGroup.innerHTML = `
            <input type="number" class="form-control me-2" name="sizes[${sizeIndex}][size]" placeholder="Tamanho" required>
            <input type="number" class="form-control" name="sizes[${sizeIndex}][quantity]" placeholder="Quantidade" required>
            <button type="button" class="remove-size-btn">
                <i class="fa-solid fa-trash"></i>
            </button>
        `;

        container.appendChild(sizeGroup);
        sizeIndex++; // Incrementa o índice para os próximos campos

        // Adicionando o evento de remoção para o novo botão
        const removeButton = sizeGroup.querySelector('.remove-size-btn');
        removeButton.onclick = function() {
            removeSize(removeButton);
        };
    }

    function removeSize(button) {
        const sizeGroup = button.closest('.size-group');
        sizeGroup.remove();
    }

    //Seleção de informações adicionais --Outros
    document.addEventListener('DOMContentLoaded', function () {
        const select = document.getElementById('additional_info');
        const otherInfoDiv = document.getElementById('other_info_div');
        const otherInfo = document.getElementById('other_info');

        function toggleOtherField() {
            if (select.value === 'outros') {
                otherInfoDiv.style.display = 'block'; 
                otherInfo.required = true; 
            } else {
                otherInfoDiv.style.display = 'none'; 
                otherInfo.required = false; 
            }
        }
        
        toggleOtherField();

        select.addEventListener('change', toggleOtherField);
    });
</script>
@endsection