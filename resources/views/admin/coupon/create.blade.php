@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <h1>Coupon Add</h1>
    </section>

    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Coupon Add</h3>
                        <a href="{{ route('coupon.index') }}" style="float: right;" class="btn btn-primary">Coupon List</a>
                    </div>
                    <div class="box-body">
                        <form role="form" action="{{ route('coupon.store') }}" method="POST">
                            @csrf
                            <div class="box-body">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" name="title" class="form-control" name="title" placeholder="Enter title">
                                    @error('title')
                                    <span class="error">{{$message}}</span> 
                                 @enderror

                                </div>

                                <div class="form-group">
                                    <label>Coupon Code</label>
                                    <input type="text" class="form-control" name="coupon_code" placeholder="Enter coupon code">
                                    @error('coupon_code')
                                    <span class="error">{{$message}}</span> 
                                 @enderror
                                </div>

                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class="form-control">
                                        <option value="">Select status</option>
                                        <option value="1">Active</option>
                                        <option value="2">Inactive</option>
                                    </select>
                                    @error('status')
                                    <span class="error">{{$message}}</span> 
                                 @enderror
                                </div>

                                <div class="form-group">
                                    <label>Valid From</label>
                                    <input type="datetime-local" class="form-control" name="valid_from">
                                    @error('valid_from')
                                    <span class="error">{{$message}}</span> 
                                 @enderror
                                </div>

                                <div class="form-group">
                                    <label>Valid To</label>
                                    <input type="datetime-local" class="form-control" name="valid_to">
                                    @error('valid_to')
                                       <span class="error">{{$message}}</span> 
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Discount Amount</label>
                                    <input type="number" class="form-control" name="discount_amount" step="0.01" placeholder="Enter discount amount">
                                    @error('discount_amount')
                                    <span class="error">{{$message}}</span> 
                                 @enderror
                                </div>

                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <button type="reset" class="btn btn-default">Reset</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
