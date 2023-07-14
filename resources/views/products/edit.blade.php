@extends('layouts.app')
@section('content')
    <form class="custom-form" method="POST"  action="{{ route('products.update', ['product' => $product->id])}}">
        @method('PUT')
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <div class="form-group">
            <label for="product_name">Product name</label>
            <input type="text" class="form-control" name="product_name" placeholder="Enter product name" value="{{$product->name}}">
            @if($errors->has('product_name'))
                <span class="text-danger">{{ $errors->first('product_name') }}</span>
            @endif
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input class="form-control" name="price" type="number" min="0.00" max="10000.00" step="0.01" value="{{$product->price}}"/>
            @if($errors->has('price'))
                <span class="text-danger">{{ $errors->first('price') }}</span>
            @endif
        </div>
        <div class="custom-div-form-create">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
@endsection
