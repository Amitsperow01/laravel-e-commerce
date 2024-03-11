@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <h1>Product Add</h1>
    </section>

    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Product Add</h3>
                        <a href="{{ route('product.index') }}" style="float: right;" class="btn btn-primary">Product List</a>
                    </div>
                    <div class="box-body">
                        <form role="form" action="{{ route('product.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="box-body">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Product name</label>
                                            <input type="text" class="form-control" name="name"
                                                placeholder="Enter product name">
                                        </div>

                                        <div class="form-group">
                                            <label>Select status</label>
                                            <select name="status" class="form-control">
                                                <option value="">Select status</option>
                                                <option value="1">Enable</option>
                                                <option value="2">Disable</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Is featured</label>
                                            <select name="is_featured" class="form-control">
                                                <option value="">Select featured</option>
                                                <option value="1">Yes</option>
                                                <option value="2">No</option>
                                            </select>
                                        </div>


                                        <div class="form-group">
                                            <label>Stock Keeping Unit(sku)</label>
                                            <input type="text" class="form-control" name="sku" step="any"
                                                placeholder="Product sku">
                                        </div>

                                        <div class="form-group">
                                            <label>Quantity (qty)</label>
                                            <input type="number" class="form-control" step="any" name="qty"
                                                placeholder="Product qty">
                                        </div>

                                        <div class="form-group">
                                            <label>Stock status</label>
                                            <select name="stock_status" class="form-control">
                                                <option value="">Stock Status</option>
                                                <option value="1">In Stock</option>
                                                <option value="2">Out of Stock</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Weight</label>
                                            <input type="number" class="form-control" step="any" name="weight"
                                                placeholder="Product weight">
                                        </div>

                                        <div class="form-group">
                                            <label>Price</label>
                                            <input type="number" class="form-control" step="any" name="price"
                                                placeholder="Product price">
                                        </div>

                                        <div class="form-group">
                                            <label>Special price</label>
                                            <input type="number" class="form-control" step="any" name="special_price"
                                                placeholder="Product special price">
                                        </div>

                                        <div class="form-group">
                                            <label>URL Key</label>
                                            <input type="text" name="url_key" class="form-control"
                                                placeholder="Product url key">
                                        </div>
                                        <div class="form-group">
                                            <label>Special price from</label>
                                            <input type="datetime-local" class="form-control" name="special_price_from">
                                        </div>

                                        <div class="form-group">
                                            <label>Special price to</label>
                                            <input type="datetime-local" class="form-control" name="special_price_to">
                                        </div>
                                        <div class="form-group">
                                            <label>Short description</label>
                                            <textarea name="short_description" class="form-control" cols="10" rows="2"></textarea>
                                        </div>

                                    </div> <!-- col-md-6 end -->

                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea name="description" id="editor" class="form-control" cols="10" rows="4"></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label>Related Product</label>
                                            <select name="related_product[]" class="form-control"
                                                placeholder="Related product" multiple>
                                                @foreach ($products as $Product)
                                                    <option value="{{ $Product->id }}">{{ $Product->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Meta tag</label>
                                            <input type="text" name="meta_tag" class="form-control"
                                                placeholder="Product meta tag">
                                        </div>

                                        <div class="form-group">
                                            <label>Meta title</label>
                                            <input type="text" name="meta_title" class="form-control"
                                                placeholder="Product meta title">
                                        </div>

                                        <div class="form-group">
                                            <label>Meta description</label>
                                            <textarea name="meta_description" class="form-control" cols="30" rows="2"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputFile">Image Upload</label>
                                            <input type="file" id="exampleInputFile" name="banner_image[]" multiple>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputFile">Thumbnail Image </label>
                                            <input type="file" id="exampleInputFile" name="thumbnail_image">
                                        </div>
                                        <div class="form-group">
                                            <label for="categories">Category:</label>
                                            <select class="form-control" name="categories[]" multiple>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">
                                                        {{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div style="float:left;width:100%;margin-bottom:15px;">
                                            @foreach (getAttributes() as $attribute)
                                                <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                                                    <input type="hidden" name="attribute[]"
                                                        value="{{ $attribute->id }}">
                                                    <label> <span style="color:red;">*</span>{{ $attribute->name }}</label>
                                                    <select
                                                        class="form-control form-control-user @error('value') is-invalid @enderror"
                                                        name="value[{{ $attribute->id }}][]" multiple>
                                                        @foreach ($attribute->attributeValues as $_attValue)
                                                            <option value="{{ $_attValue->id }}">{{ $_attValue->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('value')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="box-footer">
                                            <button type="submit" name="save" value="save"
                                                class="btn btn-primary">Save</button>
                                            <button type="submit" name="save" value="save_new"
                                                class="btn btn-primary">Save & New</button>
                                        </div>
                                    </div>
                                </div> <!-- row end -->
                            </div><!-- /.box-body -->
                        </form>
                    </div><!-- /.box -->
                </div>
            </div>
        </div>
        <script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js"></script>
        <script>
            ClassicEditor
                .create(document.querySelector('#editor'), {
                    ckfinder: {
                        uploadUrl: '{{ route('ckeditor.upload') . '?_token=' . csrf_token() }}',
                    }
                })
                .catch(error => {

                });
        </script>
    </section>
@endsection
