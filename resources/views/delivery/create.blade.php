@extends('layouts.app')
@section('content')
    <form action="{{URL::to('deliveries')}}" method="POST">
        @csrf
        <section class="h-100 h-custom" style="background-color:darkblue;">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12">
                        <div class="card card-registration card-registration-2" style="border-radius: 15px;">
                            <div class="card-body p-0">
                                <div class="row g-0">
                                    <div class="col-lg-8">
                                        <div class="p-5">
                                            <div class="d-flex justify-content-between align-items-center mb-5">
                                                <h1 class="fw-bold mb-0 text-black">Finish delivery order</h1>
                                                <h6 class="mb-0 text-muted">{{count($items)}} Types of product</h6>
                                            </div>
                                            <hr class="my-4">
                                            @foreach($items as $key=>$value)
                                                <div class="row mb-4 d-flex justify-content-between align-items-center">
                                                    @if($value>1)
                                                        <div class="col-md-3 col-lg-3 col-xl-3">
                                                            <h6 class="text-black mb-0">{{$key}}</h6>
                                                            @for($i=0;$i<$value;$i++)
                                                                <ul>
                                                                    <li><input type="text" name="{{$key}}[]"
                                                                               class="custom-input"
                                                                               placeholder="Type IMEI"></li>
                                                                </ul>
                                                            @endfor
                                                        </div>
                                                    @else
                                                        <div class="col-md-3 col-lg-3 col-xl-3">
                                                            <h6 class="text-black mb-0">{{$key}}</h6>
                                                            <input type="text" name="{{$key}}[]" class="custom-input"
                                                                   placeholder="Type IMEI">
                                                        </div>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                        <button type="submit" class="btn btn-primary custom-button">Finish</button>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="p-5 custom-div-button-order" style="background-color: lightgray;" >
                                            <!-- Your div content here -->
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </section>
    </form>
@endsection
