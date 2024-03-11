@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <h1>Edit Coupon</h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Edit Coupon</h3>
                        <a href="{{ route('coupon.index') }}" style="float: right;" class="btn btn-primary">Back to List</a>
                    </div>
                    <div class="box-body">
                        <form role="form" action="{{ route('coupon.update', $coupon->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="box-body">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" class="form-control" name="title" value="{{ $coupon->title }}" placeholder="Enter title">
                                </div>

                                <div class="form-group">
                                    <label>Coupon Code</label>
                                    <input type="text" class="form-control" name="coupon_code" value="{{ $coupon->coupon_code }}" placeholder="Enter coupon code">
                                </div>

                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class="form-control">
                                        <option value="1" {{ $coupon->status == '1' ? 'selected' : '' }}>Active</option>
                                        <option value="2" {{ $coupon->status == '2' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Valid From</label>
                                    <input type="datetime-local" class="form-control" name="valid_from" value="{{ $coupon->valid_from }}">
                                </div>

                                <div class="form-group">
                                    <label>Valid To</label>
                                    <input type="datetime-local" class="form-control" name="valid_to" value="{{ $coupon->valid_to }}">
									@error('valid_to')
                                       <span class="error">{{$message}}</span> 
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Discount Amount</label>
                                    <input type="number" class="form-control" name="discount_amount" value="{{ $coupon->discount_amount }}" step="0.01" placeholder="Enter discount amount">
                                </div>

                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <a href="{{ route('coupon.index') }}" class="btn btn-default">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
