@extends('layouts.app')

@section('content')
    <form action="{{ URL::to('deliveries') }}" method="POST">
        @csrf
        <section class="h-100" style="background-color: darkblue; height: 100%">
            <div class="container-fluid h-100">
                <div class="row h-100 justify-content-center align-items-center">
                    <div class="col-lg-8">
                        <div class="card card-registration card-registration-2" style="border-radius: 15px;">
                            <div class="card-body p-0">
                                <div class="row g-0">
                                    <div class="col-lg-12">
                                        <div class="p-5">
                                            <div class="d-flex justify-content-between align-items-center mb-5">
                                                <h1 class="fw-bold mb-0 text-black">Finish delivery order <br>IMEI
                                                    pattern: AA-BBB4BB-CCC7CC-D<br></h1>
                                                <h6 class="mb-0 text-muted">{{ count($items) }} Types of product</h6>
                                                <fieldset>
                                                    <legend>Select status</legend>

                                                    <div>
                                                        <input type="radio" id="active" name="status" value="pending"
                                                               checked>
                                                        <label for="huey">Pending</label>
                                                    </div>

                                                    <div>
                                                        <input type="radio" id="dewey" name="status" value="finished">
                                                        <label for="dewey">Finished</label>
                                                    </div>

                                                </fieldset>
                                                <input type="hidden" name='delivery_id' value="{{$delivery->id}}">
                                            </div>
                                            <hr class="my-4">
                                            @foreach($items as $key => $value)
                                                <div class="row mb-4 d-flex justify-content-between align-items-center">
                                                    @for($i = 0; $i < $value; $i++)
                                                        <div class="col-md-6 col-lg-6 col-xl-6">
                                                            <h6 class="text-black mb-0">{{ $key }}</h6>
                                                            <ul>
                                                                <li><input type="text" name="{{ $key }}[]"
                                                                           class="custom-input" placeholder="Type IMEI"
                                                                           pattern="^[A-Z0-9]{2}-[a-zA-Z0-9]{6}-[A-Z0-9]{6}-[A-Z0-9]$"
                                                                           required>
                                                                    @if($errors->has('imei'))
                                                                        <span
                                                                            class="text-danger">{{ $errors->first('imei') }}</span>
                                                                    @endif
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        @if(count($items) > 1 && $i < $value - 1)
                                                            <div class="col-md-6 col-lg-6 col-xl-6">
                                                                <h6 class="text-black mb-0">{{ $key }}</h6>
                                                                <ul>
                                                                    <li><input type="text" name="{{ $key }}[]"
                                                                               class="custom-input"
                                                                               placeholder="Type IMEI"
                                                                               pattern="^[A-Z0-9]{2}-[a-zA-Z0-9]{6}-[A-Z0-9]{6}-[A-Z0-9]$"
                                                                               required>
                                                                        @if($errors->has('imei'))
                                                                            <span
                                                                                class="text-danger">{{ $errors->first('imei') }}</span>
                                                                        @endif

                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        @endif
                                                            <?php $i++; ?>
                                                    @endfor
                                                </div>
                                            @endforeach

                                            <div>
                                                <button type="submit" class="btn btn-primary custom-button">Finish
                                                </button>
                                            </div>
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
