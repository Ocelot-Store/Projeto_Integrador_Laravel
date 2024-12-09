@extends('shoe.layout')

@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/shoe/ordered.css') }}">


@endsection

@section('content')
    <div class="container">
        <h3>Agradecemos pelo seu pedido!</h3>
        <i class="fa-regular fa-face-grin-wink"></i>
        <h4>Retornaremos sobre o pagamento do seu pedido.</h4>
        <a href="{{ route('home') }}" class="btn-back">Voltar</a>
    </div>
@endsection