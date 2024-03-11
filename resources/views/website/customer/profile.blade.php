@extends('layouts.web')

@section('content')
    @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible success-messeage" role="alert">
            <button type="button" class="close" data-dismiss="alert">
                <i class="fa fa-times"></i>
            </button>
            <strong>Success !</strong> {{ session('success') }}
        </div>
    @endif
    @if (Session::has('error'))
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert">
                <i class="fa fa-times"></i>
            </button>
            <strong>Error !</strong> {{ session('error') }}
        </div>
    @endif
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mb-5 mt-5">
                <!-- My Account Page Start -->
                <div class="myaccount-page-wrapper">
                    <!-- My Account Tab Menu Start -->
                    <div class="row">
                        @php
                            $user_id = Auth::user()->id ?? null;
                        @endphp
                        <div class="col-lg-3 col-md-4">
                            <div class="myaccount-tab-menu  nav" role="tablist">
                                <img src="{{ asset('images/images.png') }}" width="100px" style="margin-left: 77px;">
                                <a href="#account-info" data-toggle="tab" class="side-menu"><i class="fa fa-user"></i>
                                    Profile Details</a>
                                <a href="#wishlist" class="side-menu" data-toggle="tab"><i
                                        class="fa-sharp fa-solid fa-heart"></i>
                                    Wishlist</a>
                                <a href="#orders" data-toggle="tab" class="side-menu active"><i
                                        class="fa fa-cart-arrow-down"></i> Orders</a>
                                <a href="#payment-method" class="side-menu" data-toggle="tab"><i
                                        class="fa fa-credit-card"></i> Payment
                                    Method</a>
                                <a href="#address-edit" class="side-menu" data-toggle="tab" class=""><i
                                        class="fa fa-map-marker"></i> address</a>
                                <a href="{{ route('customer.logout') }}"
                                    onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"><i
                                        class="fa fa-sign-out"></i> Logout</a>
                                <form id="logout-form" action="{{ route('customer.logout') }}" method="POST">
                                    @csrf
                                </form>
                            </div>
                        </div>
                        <!-- My Account Tab Menu End -->

                        <!-- My Account Tab Content Start -->
                        <div class="col-lg-9 col-md-8" style="border: 1px solid gray;">
                            <div class="tab-content p-3" id="myaccountContent">
                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade" id="wishlist" role="tabpanel">
                                <div class="myaccount-content">
                                    <h3>Wishlist</h3>
                                    <div class="myaccount-table table-responsive text-center">
                                        <table class="table table-bordered">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Image</th>
                                                    <th>Product Name</th>
                                                    <th>Price</th>
                                                    <th>Date</th>
                                                    <th>Add Item</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($wishlists ?? [] as $wishlist)
                                                <tr>
                                                    <td><a href="{{ route('product.data',$wishlist->product->url_key ) }}"><img src="{{ productImage($wishlist->product->id) }}" width="50px" alt="" srcset=""></a></td>
                                                    <td>{{ $wishlist->product->name }}</td>
                                                    @if (isset($wishlist->product->special_price) && date('Y-m-d') >= $wishlist->product->special_price_from && date('Y-m-d') <= $wishlist->product->special_price_to)
                                                        <td>₹{{ number_format($wishlist->product->special_price,2) }}</td>
                                                        @else
                                                        <td>₹{{ number_format($wishlist->product->price,2) }}</td>
                                                        @endif
                                                        <td>{{$wishlist->created_at->format('d/m/Y')}}</td>
                                                        <td class="add-pr">
                                                            <a class="btn hvr-hover" href="{{ route('product.data',$wishlist->product->url_key ) }}">Add to Cart</a>
                                                        </td>
                                                        <td><a href="{{ route('wishlist.destory',$wishlist->product->id) }}" style="color: #fff" class="btn hvr-hover">Delete</a></td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                                <!-- Single Tab Content End -->
                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade active show" id="orders" role="tabpanel">
                                    <div class="myaccount-content">
                                        <h3>Orders</h3>
                                        <div class="myaccount-table table-responsive text-center">
                                            <table class="table table-bordered">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th>Order Id</th>
                                                        <th>Name</th>
                                                        <th>Shipping Charge</th>
                                                        <th>Total</th>
                                                        <th>Date</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    {{-- {{$orders}} --}}
                                                    @foreach ($orders ?? [] as $order)
                                                        <tr>
                                                            <td>{{ $order->order_increment_id }}</td>
                                                            <td>{{ $order->name }}</td>
                                                            <td>₹{{ number_format($order->shipping_cost, 2) ?? 0 }}</td>
                                                            <td>₹ {{ number_format($order->total, 2) }}</td>
                                                            <td>{{ $order->created_at->format('d/m/Y') }}</td>
                                                            <td>
                                                                <div class="myaccount-tab-menu  nav" role="tablist">
                                                                    <a href="#order_view" data-toggle="tab"
                                                                        order-id="{{ $order->id }}"
                                                                        class="check-btn btn btn-success order_view">View</a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- Single Tab Content End -->
                                <div class="tab-pane fade" id="order_view" role="tabpanel">

                                </div>
                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade" id="payment-method" role="tabpanel">
                                    <div class="myaccount-content">
                                        <h3>Payment Method</h3>
                                        @foreach ($orders ?? [] as $order)
                                            <h5>Orde ID {{ $order->order_increment_id }}</h5>
                                            <p class="saved-message"><i class="fa fa-credit-card"></i>&nbsp;
                                                &nbsp;{{ $order->payment_method }}<br /></p>
                                        @endforeach
                                    </div>
                                </div>
                                <!-- Single Tab Content End -->
                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade" id="address-edit" role="tabpanel">
                                    <div class="myaccount-content new-address">
                                        <div class="d-flex justify-content-end">
                                            <button class="btn btn-primary create-address">New Address</button>
                                        </div>
                                        <h3>Shipping Address</h3>
                                        @foreach ($orderAddress ?? [] as $orderadd)
                                            <address>
                                                <p><strong>{{ $orderadd->name }}</strong></p>
                                                <p>{{ $orderadd->address }}<br>
                                                    {{ $orderadd->country }}, {{ $orderadd->state }},
                                                    {{ $orderadd->city }}</p>
                                                <p>Mobile: {{ $orderadd->phone }}</p>
                                            </address>
                                            @php
                                                $name = explode(' ', $orderadd->name);
                                            @endphp
                                            <a href="#" data-toggle="tab" class="billing-edit"
                                                style="color: rgb(19, 72, 245)"><i class="fa fa-edit"></i> Edit Address</a>
                                            <div class="myaccount-content billing-address-edit" style="display: none">
                                                <h3>Edit Shipping Address</h3>
                                                <form class="needs-validation" id="shipping_validation"
                                                    action="{{ route('customer.updateAddress') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="addressId" value="{{ $orderadd->id }}">
                                                    <input type="hidden" name="user_id" value="{{ $orderadd->user_id }}">
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <span style="color:red;">*</span>Name</label>
                                                            <input type="text" class="form-control" name="name"
                                                                placeholder="Name"
                                                                value="{{ old('name', $name[0] ?? '') }}">
                                                            @error('name')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <span style="color:red;">*</span>Phone</label>
                                                        <input type="nubmer" class="form-control" name="phone"
                                                            placeholder="Phone"
                                                            value="{{ old('phone', $orderadd->phone) }}">
                                                        @error('phone')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <span style="color:red;">*</span>Address</label>
                                                        <textarea name="address" class="form-control">{{ old('address', $orderadd->address) }}</textarea>
                                                        @error('address')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-5 mb-3">
                                                            <span style="color:red;">*</span>Country*</label>
                                                            <select class="wide w-100" name="country">
                                                                <option value="india"
                                                                    {{ old('country', $orderadd->country) == 'india' ? 'selected' : '' }}>
                                                                    India</option>
                                                                <option value="japan"
                                                                    {{ old('country', $orderadd->country) == 'japan' ? 'selected' : '' }}>
                                                                    Japan</option>
                                                                <option value="nepal"
                                                                    {{ old('country', $orderadd->country) == 'nepal' ? 'selected' : '' }}>
                                                                    Nepal</option>
                                                            </select>
                                                            @error('country')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-4 mb-3">
                                                            <span style="color:red;">*</span>State </label>
                                                            <select class="wide w-100" name="state">
                                                                <option value="haryana"
                                                                    {{ old('state', $orderadd->state) == 'haryana' ? 'selected' : '' }}>
                                                                    Haryana</option>
                                                                <option value="punjab"
                                                                    {{ old('state', $orderadd->state) == 'punjab' ? 'selected' : '' }}>
                                                                    Punjab</option>
                                                                <option value="rajasthan"
                                                                    {{ old('state', $orderadd->state) == 'rajasthan' ? 'selected' : '' }}>
                                                                    Rajasthan</option>
                                                                <option value="assam"
                                                                    {{ old('state', $orderadd->state) == 'assam' ? 'selected' : '' }}>
                                                                    Assam</option>
                                                            </select>
                                                            @error('state')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-4 mb-8">
                                                            <span style="color:red;">*</span>City </label>
                                                            <input type="text" class="form-control" name="city"
                                                                placeholder="City"
                                                                value="{{ old('city', $orderadd->city) }}">
                                                            @error('city')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-3 mb-3">
                                                            <span style="color:red;">*</span>PIN</label>
                                                            <input type="nubmer" class="form-control" name="pincode"
                                                                placeholder="PIN"
                                                                value="{{ old('pincode', $orderadd->pincode) }}">
                                                            @error('pincode')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <button type="submit"
                                                        class="check-btn btn btn-success">Update</button>
                                                    <button class="btn btn-secondary cancel-btn">Cancel</button>
                                                </form>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <!-- Single Tab Content End -->
                                <div class="myaccount-content billing-address-create" style="display: none">
                                    <h3>Create Shipping Address</h3>
                                    <form class="needs-validation" id="billing-address-create"
                                        action="{{ route('customer.updateAddress') }}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <span style="color:red;">*</span>Name</label>
                                                <input type="text" class="form-control" name="name"
                                                    placeholder="Name" value="{{ old('name') }}">
                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <span style="color:red;">*</span>Phone</label>
                                            <input type="nubmer" class="form-control" name="phone"
                                                placeholder="Phone" value="{{ old('phone') }}">
                                            @error('phone')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <span style="color:red;">*</span>Address</label>
                                            <textarea name="address" class="form-control">{{ old('address') }}</textarea>
                                            @error('address')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="row">
                                            <div class="col-md-5 mb-3">
                                                <span style="color:red;">*</span>Country*</label>
                                                <select class="wide w-100" name="country">
                                                    <option value="india" {{ old('country') }}>India</option>
                                                    <option value="japan" {{ old('country') }}>Japan</option>
                                                    <option value="nepal" {{ old('country') }}>Nepal</option>
                                                </select>
                                                @error('country')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <span style="color:red;">*</span>State </label>
                                                <select class="wide w-100" name="state">
                                                    <option value="haryana" {{ old('state') }}>Haryana</option>
                                                    <option value="punjab" {{ old('state') }}>Punjab</option>
                                                    <option value="rajasthan" {{ old('state') }}>Rajasthan</option>
                                                    <option value="assam" {{ old('state') }}>Assam</option>
                                                </select>
                                                @error('state')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-4 mb-8">
                                                <span style="color:red;">*</span>City </label>
                                                <input type="text" class="form-control" name="city"
                                                    placeholder="City" value="{{ old('city') }}">
                                                @error('city')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <span style="color:red;">*</span>PIN</label>
                                                <input type="nubmer" class="form-control" name="pincode"
                                                    placeholder="PIN" value="{{ old('pincode') }}">
                                                @error('pincode')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <button type="submit" class="check-btn btn btn-success">Submit</button>
                                        <button class="btn btn-secondary create-address-close">Cancel</button>
                                    </form>
                                </div>
                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade" id="account-info" role="tabpanel">
                                    <div class="myaccount-content">
                                        <h3>Account Details</h3>
                                        <div class="account-details-form">
                                            @php
                                                $name = explode(' ', Auth::user()->name);
                                            @endphp
                                            <form action="{{ route('customer.update') }}" method="POST" id="validate">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="single-input-item">
                                                            <label for="first-name" class="required">Name</label>
                                                            <input type="text" class="form-control" name="fname"
                                                                value="{{ old('name', $name[0]) }}"
                                                                placeholder="First Name">
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="single-input-item">
                                                    <label for="email" class="required">Email Addres</label>
                                                    <input type="email" class="form-control" name="email"
                                                        value="{{ old('email', Auth::user()->email) }}" readonly>
                                                </div>
                                                <hr />
                                                <fieldset>
                                                    <legend>Password change</legend>
                                                    <div class="single-input-item">
                                                        <label for="current-pwd" class="required">Current Password</label>
                                                        <input type="password" class="form-control" name="current_pwd"
                                                            value="{{ old('current_pwd') }}"
                                                            placeholder="Current Password">
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="single-input-item">
                                                                <label for="new-pwd" class="required">New
                                                                    Password</label>
                                                                <input type="password" class="form-control"
                                                                    id="new_pwd" name="new_pwd"
                                                                    value="{{ old('new_pwd') }}"
                                                                    placeholder="New Password">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="single-input-item">
                                                                <label for="confirm-pwd" class="required">Confirm
                                                                    Password</label>
                                                                <input type="password" class="form-control"
                                                                    name="confirm_pwd" value="{{ old('confirm_pwd') }}"
                                                                    placeholder="Confirm Password">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                                <div class="single-input-item mt-2">
                                                    <button type="submit" class="check-btn btn btn-success">Save
                                                        Changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div> <!-- Single Tab Content End -->
                            </div>
                        </div> <!-- My Account Tab Content End -->
                    </div>
                </div> <!-- My Account Page End -->
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $("#validate").validate({
                rules: {
                    current_pwd: 'required',
                    new_pwd: 'required',
                    name: 'required',
                    confirm_pwd: {
                        required: true,
                        equalTo: "#new_pwd",
                    },
                },
                messages: {
                    current_pwd: 'Current Password is required',
                    new_pwd: 'New Password is required',
                    name: 'First Name is required',
                    confirm_pwd: {
                        required: 'Confirm Password is required',
                        equalTo: 'Password not matching',
                    }
                },
            });
            $("#shipping_validation").validate({
                rules: {
                    name: 'required',
                    phone: 'required',
                    address: 'required',
                    country: 'required',
                    state: 'required',
                    city: 'required',
                    pincode: 'required'

                        ,
                },
                messages: {
                    name: 'First Name is required',
                    phone: 'phone is required',
                    address: 'address is required',
                    country: 'country is required',
                    state: 'state is required',
                    city: 'city is required',
                    pincode: 'pincode is required'

                },
            });
            $("#billing-address-create").validate({
                rules: {
                    name: 'required',
                    phone: 'required',
                    address: 'required',
                    country: 'required',
                    state: 'required',
                    city: 'required',
                    pincode: 'required'

                        ,
                },
                messages: {
                    name: 'First Name is required',
                    phone: 'phone is required',
                    address: 'address is required',
                    country: 'country is required',
                    state: 'state is required',
                    city: 'city is required',
                    pincode: 'pincode is required'

                },
            });
        });
        $('.billing-edit').click(function(e) {
            e.preventDefault();
            var element = $(this);
            $(element).next('.billing-address-edit').toggle();
        });
        $('.cancel-btn').click(function(e) {
            e.preventDefault();
            $('.billing-address-edit').hide();
        });
        $('.create-address').click(function(e) {
            e.preventDefault();
            $('#address-edit').hide();
            $('.billing-address-create').show();
        });
        $('.create-address-close').click(function(e) {
            e.preventDefault();
            $('.billing-address-create').hide();
            $('#address-edit').show();
        });
       
    </script>
@endsection
