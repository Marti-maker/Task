@extends('layouts.app')
@section('content')
    @if(isset($type) && $type == 'update')
        <form action="{{ route('deliveries.update', ['delivery' => $delivery->id])}}" method="POST" class="custom-form">
            @method('PUT')
            @else
                <form action="{{route('deliveries.middle_create_save')}}" method="POST" class="custom-form">
                    @endif
                    @csrf
                    <table class="table table-bordered" id="dynamicAddRemove" style="width: 700px;margin-top: 20px">
                        <tr>
                            <th>Expected date</th>
                            <th>Warehouse</th>
                        </tr>
                        <tr>
                            <td>
                                @if(isset($delivery))
                                    <input type="date" name="expected_date" class="form-control"
                                           value="{{ $delivery->expected_date }}"/>

                                @else
                                    <input type="date" name="expected_date" class="form-control"/>
                                @endif
                                @if($errors->has('expected_date'))
                                    <span class="text-danger">{{ $errors->first('expected_date') }}</span>
                                @endif
                            </td>
                            <td>
                                @if(isset($delivery))
                                    <input type="text" name="warehouse" placeholder="Place warehouse name"
                                           class="form-control" value="{{$delivery->warehouse}}"/>
                                @else
                                    <input type="text" name="warehouse" placeholder="Place warehouse name"
                                           class="form-control"/>
                                @endif
                                @if($errors->has('warehouse'))
                                    <span class="text-danger">{{ $errors->first('warehouse') }}</span>
                                @endif
                            </td>
                            @if(isset($delivery))
                                <fieldset style="margin-right:20px ">
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

                                    @if($errors->has('imei'))
                                        <span class="text-danger">{{ $errors->first('imei') }}</span>
                                    @endif
                                </fieldset>
                            @endif
                        </tr>
                    </table>
                    <div style="margin-top: 20px;margin-left: 20px">
                        <button type="submit" class="btn btn-outline-success btn-block">Save</button>
                    </div>
                </form>
        @endsection
