@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <h1>Coupon List</h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Coupon List</h3>
                        <a href="{{ route('coupon.create') }}" class="btn btn-primary" style="float: right;">Add Coupon</a>
                        @if (session()->has('success'))
                            <div class="callout callout-success" style="float:left;width:100%;margin-top:5px;">
                                {{ session()->get('success') }}</div>
                        @endif
                    </div>
                    <div class="box-body">
                        <table id="myTable" class="table table-bordered display">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Coupon Code</th>
                                    <th>Status</th>
                                    <th>Valid From</th>
                                    <th>Valid To</th>
                                    <th>Discount Amount</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($coupons as $coupon)
                                <tr>
                                    <td>{{ $coupon->title }}</td>
                                    <td>{{ $coupon->coupon_code }}</td>
                                    <td>{{ $coupon->status }}</td>
                                    <td>{{ $coupon->valid_from }}</td>
                                    <td>{{ $coupon->valid_to }}</td>
                                    <td>{{ $coupon->discount_amount }}</td>
                                    <td>
                                        <a href="{{ route('coupon.edit', $coupon->id) }}"
                                            class="btn btn-primary btn-sm">Edit</a>
                                        <form action="{{ route('coupon.destroy', $coupon->id) }}" method="POST"
                                            style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure you want to delete this coupon?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                $('#myTable').DataTable();
            });
        </script>
    </section>
@endsection
