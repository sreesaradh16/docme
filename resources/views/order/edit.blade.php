@extends("layouts.admin.app")

@section("heading")
<h1>Edit Order</h1>
@endsection

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('orders.index')}}">Manage Orders</a>
    </li>
    <li class="breadcrumb-item active">Edit Order</li>
</ol>
@endsection

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    {{ html()->form('PUT')->route('orders.update',[$order->id])->attributes(['autocomplete'=>'off'])->open() }}
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="contact_input1 form-group">
                                    <label>Vendor</label>
                                    <select class="form-select" name="vendor" id="vendor" required>
                                        <option value="" disabled selected>Select Vendor</option>
                                        <option value="vendor 1" {{ $order->vendor == 'vendor 1' ? 'selected' : ''}}>vendor 1</option>
                                        <option value="vendor 2" {{ $order->vendor == 'vendor 2' ? 'selected' : ''}}>vendor 2</option>
                                        <option value="vendor 3" {{ $order->vendor == 'vendor 3' ? 'selected' : ''}}>vendor 3</option>
                                        <option value="vendor 4" {{ $order->vendor == 'vendor 4' ? 'selected' : ''}}>vendor 4</option>
                                        <option value="vendor 5" {{ $order->vendor == 'vendor 5' ? 'selected' : ''}}>vendor 5</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="name">Order Number *</label>
                                    <input type="text" name="order_number" id="order_number" value="{{ $order->order_number }}" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="name">Order Date *</label>
                                    <input type="date" name="purchase_date" id="purchase_date" value="{{ $order->purchase_date }}" class="form-control" placeholder="Order Date" required>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="name">Inventory Location</label>
                                    <input type="text" name="inventory_location" id="inventory_location" value="{{ $order->inventory_location }}" class="form-control" placeholder="Invertory Location" required>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h5>Item Details</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Quanitity</th>
                                                <th>Amount</th>
                                                <th>Discount[%]</th>
                                                <th>Tax[5%]</th>
                                                <th>Total</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($order->order_items as $order_item)
                                            <tr>
                                                <td><input type="text" class="form-control" id="product_{{$order_item->id}}" name="product[]" value="{{ $order_item->product_name }}" placeholder="Product" required /></td>
                                                <td><input type="number" class="form-control quantity" id="quantity_{{$order_item->id}}" name="quantity[]" value="{{ $order_item->quantity }}" placeholder="Quantity" required /></td>
                                                <td><input type="number" class="form-control amount" id="amount_{{$order_item->id}}" name="amount[]" value="{{ $order_item->amount }}" placeholder="Amount" required /></td>
                                                <td><input type="number" class="form-control discount" id="discount_{{$order_item->id}}" name="discount[]" value="{{ $order_item->discount }}" placeholder="Discount" required /></td>
                                                <td><input type="number" class="form-control tax" id="tax_{{$order_item->id}}" name="tax[]" value="{{ $order_item->tax }}" placeholder="Tax" required readonly/></td>
                                                <td><input type="number" class="form-control total" id="total_{{$order_item->id}}" name="total[]" value="{{ $order_item->total }}" placeholder="Total" required readonly/></td>
                                                <td>
                                                    <button type="button" id="remove" class="btn btn-danger">Remove</button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <button type="button" id="add" class="btn btn-primary">Add</button>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                    {{ html()->form()->close() }}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push("scripts")
<script>
    $(document).ready(function() {
        var count = 1;
        $('#add').click(function() {
            count++;
            var val = count;
            var row = '<tr>' +
                '<td><input type="text" class="form-control" id="product_' + count + '"  name="product[]" placeholder="Product" required/></td>' +
                '<td><input type="number" class="form-control quantity" id="quantity' + count + '" data-config-id="' + count + '"  name="quantity[]" placeholder="Quantity" required/></td>' +
                '<td><input type="number" class="form-control amount" id="amount' + count + '" data-config-id="' + count + '"  name="amount[]" placeholder="Amount" required/></td>' +
                '<td><input type="number" class="form-control discount" id="discount' + count + '" data-config-id="' + count + '"   name="discount[]" placeholder="Discount" required/></td>' +
                '<td><input type="number" class="form-control tax" id="tax' + count + '" name="tax[]" placeholder="Tax" required readonly/></td>' +
                '<td><input type="number" class="form-control total" id="total' + count + '" name="total[]" placeholder="Total" required readonly/></td>' +
                '<td> <button type="button" id="remove" class="btn btn-danger">Remove</button>  </td>' +
                '</tr>';
            $('.table').append(row);
        });

        $(document).on('click', '#remove', function() {
            $(this).closest('tr').remove();
        });



        $('.table').on('change', '.quantity, .amount, .discount', function() {
            var row = $(this).closest('tr');
            var quantity = parseFloat(row.find('.quantity').val()) || 0;
            var amount = parseFloat(row.find('.amount').val()) || 0;
            var discount = parseFloat(row.find('.discount').val()) || 0;
            var tax = (amount * 0.05) * quantity / discount;
            var total = ((amount - (amount * (discount / 100))) * quantity) + tax;
            row.find('.tax').val(tax.toFixed(2));
            row.find('.total').val(total.toFixed(2));
        });
    });
</script>
@endpush