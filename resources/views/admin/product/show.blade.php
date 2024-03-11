@extends('layouts.admin')

@section('content')
    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Product Details</h3>
                        <a href="{{ route('product.index') }}" class="btn btn-primary" style="float: right;">List Product</a>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Product Name:</label>
                                    <p>{{ $product->name }}</p>
                                </div>

                                <div class="form-group">
                                    <label for="status">Status:</label>
                                    <p>{{ $product->status }}</p>
                                </div>

                                <div class="form-group">
                                    <label for="is_featured">Featured:</label>
                                    <p>{{ $product->is_featured ? 'Yes' : 'No' }}</p>
                                </div>

                                <div class="form-group">
                                    <label for="sku">SKU:</label>
                                    <p>{{ $product->sku }}</p>
                                </div>

                                <div class="form-group">
                                    <label for="qty">Quantity:</label>
                                    <p>{{ $product->qty }}</p>
                                </div>

                                <div class="form-group">
                                    <label for="stock_status">Stock Status:</label>
                                    <p>{{ $product->stock_status }}</p>
                                </div>

                                <div class="form-group">
                                    <label for="weight">Weight:</label>
                                    <p>{{ $product->weight }}</p>
                                </div>

                                <div class="form-group">
                                    <label for="price">Price:</label>
                                    <p>{{ $product->price }}</p>
                                </div>

                                <div class="form-group">
                                    <label for="special_price">Special Price:</label>
                                    <p>{{ $product->special_price }}</p>
                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="special_price_from">Special Price From:</label>
                                    <p>{{ $product->special_price_from }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="special_price_to">Special Price To:</label>
                                    <p>{{ $product->special_price_to }}</p>
                                </div>

                                <div class="form-group">
                                    <label for="short_description">Short Description:</label>
                                    <p>{{ $product->short_description }}</p>
                                </div>

                                <div class="form-group">
                                    <label for="description">Description:</label>
                                    <p>{{ $product->description }}</p>
                                </div>

                                <div class="form-group">
                                    <label for="related_product">Related Product:</label>
                                    <p>{{ $product->related_product }}</p>
                                </div>

                                <div class="form-group">
                                    <label for="url_key">URL Key:</label>
                                    <p>{{ $product->url_key }}</p>
                                </div>

                                <div class="form-group">
                                    <label for="meta_tag">Meta Tag:</label>
                                    <p>{{ $product->meta_tag }}</p>
                                </div>

                                <div class="form-group">
                                    <label for="meta_title">Meta Title:</label>
                                    <p>{{ $product->meta_title }}</p>
                                </div>

                                <div class="form-group">
                                    <label for="meta_description">Meta Description:</label>
                                    <p>{{ $product->meta_description }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
