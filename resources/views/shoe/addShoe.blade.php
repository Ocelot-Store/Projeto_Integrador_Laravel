@extends('shoe.layout')
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
        <form action="{{route('addShoe.post')}}" method="POST"  class="ms-auto me-auto mt-3" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="model" class="form-label">Model</label>
                <input type="text" class="form-control" name="model" >
            </div>

            <div>
                <label for="price">Price:</label>
                <input type="number" class="form-control" name="price" required step="0.01"><br>
            </div>

            <div class="mb-3">
                <label for="size" class="form-label">Size</label>
                <input type="text" class="form-control" name="size" >
            </div>

            <div class="mb-3">
                <label for="color" class="form-label">Color</label>
                <input type="text" class="form-control" name="color" >
            </div>

            <label for="brand">Brand:</label>

            <div class="mb-3">
                <select name="brand_id" required>
                    <option value="">Select a brand</option>
                    @foreach($brands as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                    @endforeach
                </select><br>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" name="description" rows="3" required></textarea>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Image:</label>
                <input class="form-control" type="file" name="image" accept=".jpg,.jpeg,.png" required>
            </div>
                        
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection