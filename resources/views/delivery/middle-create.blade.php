@extends('layouts.app')
@section('content')
    <form action="{{route('deliveries.middle_create_save')}}" method="POST" class="custom-form">
        @csrf
        <figure style="margin-top: 10px;padding-left: 10px">
            <figcaption><strong>Products</strong></figcaption>
        <ul class="list-group" style="margin-right: 20px;margin-top: 20px">
            @if($products->count()>1)
                @foreach($products as $pro)
                   <li class="list-group-item ">{{$pro->name}}</li>
                @endforeach
        </ul>
        </figure>
        <table class="table table-bordered" id="dynamicAddRemove" style="width: 700px;margin-top: 20px">
            <tr>
                <th>Product</th>
                <th>Amount</th>
                <th>Action</th>
            </tr>
            <tr>
                <td><input type="text" name="addMoreInputFields[0][product]" placeholder="Enter product" class="form-control" />
                </td>
                <td><input type="number" name="addMoreInputFields[0][amount]" placeholder="Amount" class="form-control" min="1" max="50" />
                </td>
                <td><button type="button" name="add" id="dynamic-ar" class="btn btn-outline-primary">Add Product</button></td>
            </tr>
        </table>
        <div style="margin-top: 20px;margin-left: 20px">
        <button type="submit" class="btn btn-outline-success btn-block">Save</button>
        </div>
    </form>
    @else
        <h2>Create item before processing</h2>
    @endif
    <script type="text/javascript">
        let i = 0;
        $("#dynamic-ar").click(function () {
            ++i;
            $("#dynamicAddRemove").append('<tr><td><input type="text" name="addMoreInputFields[' + i +
                '][product]" placeholder="Enter product" class="form-control" /></td>' +'<td><input type="number" name="addMoreInputFields[' + i +
                '][amount]" placeholder="Amount" class="form-control" min="1" max="50"/></td>'+
                '<td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td></tr>'
            );
        });
        $(document).on('click', '.remove-input-field', function () {
            $(this).parents('tr').remove();
        });
    </script>
@endsection
