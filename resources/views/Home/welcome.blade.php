@extends('layouts.app')
@section('content')
    <div class="container-fluid px-0 mb-2">
        <div id="header-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="fullscreen-image" src="http://127.0.0.1:8000/images/warehouse.jpg" alt="My Image"
                         style="height: 620px;width: 2000px">
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row justify-content-start">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
