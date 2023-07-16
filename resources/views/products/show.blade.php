@extends('layouts.app')
@section('content')
    <section style="background-color: #eee;">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-4">
                    <div class="card text-black">
                        <i class="fab fa-apple fa-lg pt-3 pb-1 px-3"></i>
                        <img src="https://static.thenounproject.com/png/1678723-200.png" width="400" height="300"
                             alt="supposed to be item"/>
                        <div class="card-body">
                            <div class="text-center">
                                <p class="text-muted mb-4">Product name: <strong>{{$product->name}}</strong></p>
                            </div>
                            <div>
                                <h4 style="text-align: center">Supplies :</h4>
                                @foreach($supplies as $supply)
                                    <div>
                                        <span style="text-align: center; display: block;"><strong>IMEI: </strong>{{$supply->IMEI}}
                                            <a href="{{route('delete.item',['id'=>$supply->id])}}"><i
                                                    class="bi bi-trash"></i></a></span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    {{$supplies->links()}}
                </div>
            </div>
        </div>
    </section>
@endsection
