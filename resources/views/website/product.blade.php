@extends('layouts.web')

@section('content')
    <!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Shop Detail</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Shop</a></li>
                        <li class="breadcrumb-item active">Shop Detail </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->
    {{-- {{dd($products)}} --}}
    <!-- Start Shop Detail  -->
    <div class="shop-detail-box-main">
        <div class="container">
            {{-- {{dd($image)}} --}}
            <div class="row">
                <div class="col-xl-5 col-lg-5 col-md-6">
                    <div id="carousel-example-1" class="single-product-slider carousel slide" data-ride="carousel">
                        @php
                            $i = 1;
                        @endphp
                        <div class="carousel-inner" role="listbox">
                            {{-- {{dd($products)}} --}}
                            @foreach ($products->getMedia('banner_image') as $image)
                                <div class="carousel-item {{ $i ? 'active' : '' }}"{{ $i = 0 }}>
                                    <img class="d-block w-100" src="{{ $image->getUrl() }}" style="height:500px"
                                        alt="First slide">
                                </div>
                            @endforeach
                        </div>

                        <a class="carousel-control-prev" href="#carousel-example-1" role="button" data-slide="prev">
                            <i class="fa fa-angle-left" aria-hidden="true"></i>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carousel-example-1" role="button" data-slide="next">
                            <i class="fa fa-angle-right" aria-hidden="true"></i>
                            <span class="sr-only">Next</span>
                        </a>


                        <ol class="carousel-indicators">
                            @foreach ($products->getMedia('banner_image') as $image)
                                <li data-target="#carousel-example-1" data-slide-to="0" class="active">
                                    <img class="d-block w-100 img-fluid" src="{{ $image->getUrl() }}" alt=""
                                        style="height:100px" />
                                </li>
                            @endforeach

                        </ol>
                    </div>
                </div>
                <div class="col-xl-7 col-lg-7 col-md-6">
                    <div class="single-product-details">
                        <h2>{{ $products->name }}</h2>
                        <h5> {{ getProductSpecialPrice($products->id) }} </h5>
                        {{-- @if (isset($products->special_price) && date('Y.m.d H:i:s') >= $products->special_price_from && date('Y.m.d H:i:s') <= $products->special_price_to)
                            <h5>₹{{ number_format($products->special_price, 2) }}
                                <del>₹{{ number_format($products->price, 2) }}</del>
                            </h5>
                        @else
                            <h5> ₹{{ number_format($products->price, 2) }}</h5>
                        @endif --}}
                        <p class="available-stock"><span> More than {{ $products->qty }} available / <a href="#">8\ sold </a></span>
                        <p>
                        <h4>{{ $products->short_description }}</h4>
                        <p>{!! $products->description !!} </p>
                        <form action="{{ route('cart.store', $products->id) }}" method="post">
                            <ul>
                                @csrf
                                @foreach ($attributes as $key => $attribute)
                                    <li>
                                        <div class="form-group size-st">
                                            <label
                                                class="size-label bold"><strong><b>{{ $key }}</b></strong></label>
                                            <select id="basic" name="attribute_value[{{ $key }}]"
                                                class="selectpicker show-tick form-control">
                                                @foreach ($attribute as $value)
                                                    <option value="{{ $value->name }}" >{{ $value->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </li>
                                @endforeach
                                <li>
                                    <div class="form-group quantity-box">
                                        <label class="control-label">Quantity</label>
                                        <input class="form-control" value="1" min="0" max="20"
                                            type="number" name="cart_item">
                                    </div>
                                </li>
                            </ul>

                            <div class="price-box-bar">
                                <div class="cart-and-bay-btn">
                                    <button type="submit" style="color: #ffff" class="btn hvr-hover"
                                        data-fancybox-close="">Add to cart</button>
                                </div>
                            </div>
                        </form>
                        <div class="add-to-btn">
                            <div class="add-comp">
                                <div class="cart-and-bay-btn">
                                    <form action="{{ route('wishlist.store') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{ Auth::user()->id?? '' }}">
                                        <input type="hidden" name="product_id" value="{{ $products->id }}">
                                        <button type="submit" class="btn hvr-hover" style="color: #fff" id="wishlist_btn" data-toggle="tooltip" 
                                        data-placement="right"><i class="far fa-heart"></i> Add to wishlist</button>
                                    </form>
                                </div>
                            </div>
                            <div class="share-bar">
                                <a class="btn hvr-hover" href="#"><i class="fab fa-facebook"
                                        aria-hidden="true"></i></a>
                                <a class="btn hvr-hover" href="#"><i class="fab fa-google-plus"
                                        aria-hidden="true"></i></a>
                                <a class="btn hvr-hover" href="#"><i class="fab fa-twitter"
                                        aria-hidden="true"></i></a>
                                <a class="btn hvr-hover" href="#"><i class="fab fa-pinterest-p"
                                        aria-hidden="true"></i></a>
                                <a class="btn hvr-hover" href="#"><i class="fab fa-whatsapp"
                                        aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row my-5">
                <div class="col-lg-12">
                    <div class="title-all text-center">
                        <h1>Featured Products</h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sit amet lacus enim.</p>
                    </div>
                        <div class="featured-products-box owl-carousel owl-theme">
                            @foreach (frontproduct() as $featured)
                                <div class="item">
                                    <div class="products-single fix">
                                        <div class="box-img-hover">
                                            <img src="{{ $featured->getFirstMediaUrl('thumbnail_image') }}"
                                                class="img-fluid" alt="Image" style="height:300px">
                                            <div class="mask-icon">
                                                <ul>
                                                    <li><a href="#" data-toggle="tooltip" data-placement="right"
                                                            title="View"><i class="fas fa-eye"></i></a></li>
                                                    <li><a href="#" data-toggle="tooltip" data-placement="right"
                                                            title="Compare"><i class="fas fa-sync-alt"></i></a></li>
                                                            <li><form action="{{ route('wishlist.store') }}" method="post">
                                                                @csrf
                                                                <input type="hidden" name="user_id" value="{{ Auth::user()->id?? '' }}">
                                                                <input type="hidden" name="product_id" value="{{ $featured->id }}">
                                                                <button type="submit" id="wishlist_btn" class="Add-to-wishlist" data-toggle="tooltip" data-placement="right"><i class="far fa-heart"></i></button>
                                                            </form></li>
                                                </ul>
                                                {{-- <a class="cart" href="#">Add to Cart</a> --}}
                                            </div>
                                        </div>
                                        <div class="why-text">
                                            {{-- <h4>{{ $featured->name }}</h4>
                                        <h5>{{ $featured->price }}</h5> --}}
                                        <h4>{{getProductSpecialPrice($featured->id)}}
                                           
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                </div>
            </div>

        </div>
    </div>
    <!-- End Cart -->
@endsection
