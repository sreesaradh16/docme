@extends("layouts.admin.list")

@section("heading")
<h1>Manage Order</h1>
@endsection

@section("breadcrumb")
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
    <li class="breadcrumb-item active">Manage Orders</li>
</ol>
@endsection

@section('content')
<div class="card">
    <div class="card-header border-0">
        <a class="btn btn-info" href="{{ route('orders.create') }}">Add Order</a>
    </div>
    <div class="card-body">
        <table  id="example2" class="table data-table table-bordered table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Vendor</th>
                    <th>Order Number</th>
                    <th>Purchase Date</th>
                    <th>Inventory Location</th>
                    <th width="280px">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $key=>$order)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $order->vendor }}</td>
                    <td>{{ $order->order_number }}</td>
                    <td>{{ $order->purchase_date }}</td>
                    <td>{{ $order->inventory_location }}</td>
                    <td class="actions">
                        <a class="view" href="{{route('orders.show',[$order->id])}}"><iconify-icon icon="carbon:content-view"></iconify-icon></a>
                        <a href="{{ route('orders.edit', [$order->id]) }}" class="edit"><iconify-icon icon="material-symbols:edit-outline"></iconify-icon></a>
                        <button class="delete" data-bs-toggle="modal" data-bs-target="#exampleModal" data-role-id="{{$order->id}}" data-route="{{route('orders.destroy',[$order->id])}}"><iconify-icon icon="fluent:delete-32-regular"></iconify-icon></button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection