@extends("layouts.admin.app")

@section("heading")
<h1>Order Details</h1>
@endsection

@section("breadcrumb")
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('orders.index')}}">Manage Order</a></li>
    <li class="breadcrumb-item active">Order Details</li>
</ol>
@endsection

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="bg-strip">
                            <h5 class="positionText">Order Info</h5>
                        </div>
                        <div class="taskWrap">
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Vendor</label> <B> :</B>
                                        <span class="resultWrap">{{$order->vendor}}
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Order Number</label> <B> :</B>
                                        <span class="resultWrap">{{$order->order_number}}
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Purchase Date</label> <B> :</B>
                                        <span class="resultWrap">{{$order->purchase_date}}
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Inventory Location</label> <B> :</B>
                                        <span class="resultWrap">{{$order->inventory_location}}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <table id="example2" class="table data-table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Product</th>
                                            <th>Quanitity</th>
                                            <th>Amount</th>
                                            <th>Discount</th>
                                            <th>Tax</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order->order_items as $key=>$order_item)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $order_item->product_name }}</td>
                                            <td>{{ $order_item->quantity }}</td>
                                            <td>{{ $order_item->amount }}</td>
                                            <td>{{ $order_item->discount }}%</td>
                                            <td>{{ $order_item->tax }}</td>
                                            <td>{{ $order_item->total }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection