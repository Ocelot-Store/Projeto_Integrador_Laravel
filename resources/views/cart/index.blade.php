@extends('shoe.layout')
@section('title', 'Cart')

@section('style')

@endsection

@section('content')
<div class="container mt-4">
    <h1>Meu Carrinho</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($cartItems->isEmpty())
        <p>Seu carrinho está vazio.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    <th>Preço Unitário</th>
                    <th>Subtotal</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cartItems as $item)
                    <tr>
                        <td>{{ $item->shoe->model }}</td>
                        <td>
                            <form action="{{ route('cart.update', $item->id) }}" method="POST">
                                @csrf
                                <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="form-control" style="width: 60px;">
                                <button type="submit" class="btn btn-primary btn-sm mt-1">Atualizar</button>
                            </form>
                        </td>
                        <td>R$ {{ number_format($item->shoe->price, 2, ',', '.') }}</td>
                        <td>R$ {{ number_format($item->shoe->price * $item->quantity, 2, ',', '.') }}</td>
                        <td>
                            <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Remover</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
