@extends('layout')
@section('title', 'Add a Shoe')
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
        <form action="{{route('addShoe.post')}}" method="POST"  class="ms-auto me-auto mt-3">
            @csrf
            <div class="mb-3">
                <label for="exampleInputModel1" class="form-label">Shoe Model</label>
                <input type="text" class="form-control" name="model" >
            </div>

            <div class="mb-3">
                <label for="exampleInputSize1" class="form-label">Size</label>
                <input type="text" class="form-control" name="size" >
            </div>

            <div class="mb-3">
                <label for="exampleInputColor1" class="form-label">Color</label>
                <input type="text" class="form-control" name="color" >
            </div>
            
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection