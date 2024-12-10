@extends('authentication.layout')
@section('title', 'Login')
@section('content')
<div class="overlay"></div>
<a href="{{route('index')}}"><img class="homeImg" src="../assets/Home.png" alt=""></a>
<div class="main">
    <div class="window">
        <div class="containerh1">
            <img src="../assets/BlackLogo.png" alt="">
            <h1>OCELOT</h1>
        </div>
        <h2>ALWAYS FORWARD</h2>
        <div class="">
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
        <div class="form-container">
            <form action="{{route('login.post')}}" method="POST" class="ms-auto me-auto mt-3">
                @csrf
                <div class="input-box">
                    <img src="../assets/Email.png" alt="">
                    <input type="email" class="form-control" name="email" placeholder="Email">
                </div>
                <div class="input-box">
                    <img src="../assets/Password.png" alt="">
                    <input type="password" class="form-control" name="password" placeholder="Senha">
                </div>
                <div class="divsubmit">
                    <input type="submit" value="Login">
                </div>
            </form>
        </div>
    </div>
</div>
</div>
@endsection