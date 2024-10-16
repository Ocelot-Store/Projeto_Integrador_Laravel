@extends('layout')
@section('title', "Home page")
@section('content')

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tênis Disponíveis</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Inclua seu CSS aqui -->
</head>
<body>
    <div class="container mt-4">
        <h1>Tênis Disponíveis</h1>

        @if ($shoes->isEmpty())
            <p>Nenhum tênis disponível.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Modelo</th>
                        <th>Marca</th>
                        <th>Tamanho</th>
                        <th>Cor</th>
                        <th>Preço</th>
                        <th>Descrição</th>
                        <th>Imagem</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($shoes as $shoe)
                        <tr>
                            <td>{{ $shoe->model }}</td>
                            <td>{{ $shoe->brand->name }}</td>
                            <td>{{ $shoe->size }}</td>
                            <td>{{ $shoe->color }}</td>
                            <td>R$ {{ number_format($shoe->price, 2, ',', '.') }}</td>
                            <td>{{ $shoe->description }}</td>
                            <td>
                                <img src="{{ asset('storage/' . $shoe->image) }}" alt="{{ $shoe->model }}" style="width: 100px;">
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</body>
</html>

@endsection
