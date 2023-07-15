@extends('layouts.app')
@section('content')
    <section class="h-100 h-custom" style="background-color: #eee;">
        <div class="container py-5 h-100">
            <div class="btn-group" role="group" aria-label="Basic example">
                <form method="GET" action="{{route('deliveries.middle_create')}}">
                    <button type="submit" class="btn btn-secondary">Create delivery</button>

                </form>
            </div>
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-8 col-xl-6">
                    <div class="card border-top border-bottom border-3" style="border-color: #f37a27 !important;">
                        <div class="card-body p-5">

                            @if($deliveries->count()>0)
                                @foreach($deliveries as $delivery)
                                    <div class="row">
                                        <div class="col-md-8 col-lg-9">
                                            <p class="mb-0">{{$delivery->expected_date}}</p>
                                        </div>
                                        <div class="col-md-4 col-lg-3">
                                            <p class="mb-0">{{$delivery->warehouse}}</p>
                                        </div>
                                        <div class="col-md-4 col-lg-3">
                                            <p class="mb-0"><strong>{{$delivery->status}}</strong></p>
                                            <a href="{{URL::to('deliveries/'.$delivery->id.'/edit')}}"><i
                                                    class="bi bi-pen i-custom"></i></a>
                                            @if($delivery->status!='finished')
                                            <a href="{{route('deliveries.finish.order',['id'=>$delivery->id])}}"><i
                                                    class="bi bi-arrow-up-square i-custom"></i></a>
                                            @endif
                                            <form style="margin-top: 10px"
                                                  action="{{route('deliveries.destroy',['delivery'=>$delivery->id])}}"
                                                  method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-secondary">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                    <hr>
                                @endforeach
                            @endif


                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{$deliveries->links()}}
    </section>
@endsection
