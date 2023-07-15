@extends('layouts.app')
@section('content')
    <div class="container py-5">
        <div class="btn-group" role="group" aria-label="Basic example">
            <a style="margin-right: 10px" href="{{URL::to('products/create')}}">
                <button type="button" class="btn btn-secondary">Create</button>
            </a>
            @if($products->count()>0)
                <a href="{{route('export.pdf')}}" style="margin-left: 10px"><button  class="btn btn-secondary">PDF</button></a>
                <a href="{{route('export.excel')}}" style="margin-left: 10px"><button  class="btn btn-secondary">Excel</button></a>
            @endif
        </div>
        <div class="row text-center text-white mb-5">
            <div class="col-lg-7 mx-auto">
                <h1 class="display-4">Product List</h1>
            </div>
        </div>
        @if($products->count()>0)
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <ul class="list-group shadow">
                        @foreach($products as $product)
                            <li class="list-group-item">
                                <div class="media align-items-lg-center flex-column flex-lg-row p-3">
                                    <div class="media-body order-2 order-lg-1">
                                        <h5 class="mt-0 font-weight-bold mb-2">Product name:
                                            <strong>{{$product->name}}</strong></h5>
                                        <h5 class="mt-0 font-weight-bold mb-2">In stock {{$product->supplies->count()}}
                                        <div class="d-flex align-items-center justify-content-between mt-1">
                                            <h6 class="font-weight-bold my-2">Price: {{$product->price}} $</h6>
                                            <ul class="list-inline small">
                                                <a href="{{route('products.show',['product'=>$product->id])}}">
                                                    <button type="button" class="btn btn-secondary">Info</button>
                                                </a>
                                                <a href="{{ URL::to('products/' . $product->id.'/edit')}}">
                                                    <button type="button" class="btn btn-secondary">Edit</button>
                                                </a>
                                                <form style="margin-top: 10px"
                                                      action="{{route('products.destroy',$product->id)}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-secondary">Delete</button>
                                                </form>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                        @else
                            <li class="list-group-item">
                                <div class="media align-items-lg-center flex-column flex-lg-row p-3">
                                    <div class="media-body order-2 order-lg-1">
                                        <h5 class="mt-0 font-weight-bold mb-2">No products to show at this moment</h5>
                                    </div>
                                </div>
                            </li>
                    @endif
                </div>
            </div>
            {{$products->links()}}
@endsection
