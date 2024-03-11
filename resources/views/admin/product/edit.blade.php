@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <h1>Product Edit</h1>
    </section>

    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Product Edit</h3>
                        <a href="{{ route('product.index') }}" style="float: right;" class="btn btn-primary">Product List</a>
                    </div>
                    <div class="box-body">
                        <form method="POST" action="{{ route('product.update', $products->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-6">
                                    <!-- First Part of Fields -->
                                    <div class="form-group">
                                        <label for="name">Name:</label>
                                        <input id="name" type="text"
                                            class="form-control @error('name') is-invalid @enderror" name="name"
                                            value="{{ old('name', $products->name) }}" required autocomplete="name"
                                            autofocus>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="status">Status:</label>
                                        <select id="status" class="form-control @error('status') is-invalid @enderror"
                                            name="status" required>
                                            <option value="active"
                                                {{ old('status', $products->status) == 'active' ? 'selected' : '' }}>Active
                                            </option>
                                            <option value="inactive"
                                                {{ old('status', $products->status) == 'inactive' ? 'selected' : '' }}>
                                                Inactive
                                            </option>
                                        </select>
                                        @error('status')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="is_featured">Featured:</label>
                                        <select id="is_featured"
                                            class="form-control @error('is_featured') is-invalid @enderror"
                                            name="is_featured" required>
                                            <option value="1"
                                                {{ old('is_featured', $products->is_featured) == '1' ? 'selected' : '' }}>Yes
                                            </option>
                                            <option value="0"
                                                {{ old('is_featured', $products->is_featured) == '0' ? 'selected' : '' }}>No
                                            </option>
                                        </select>
                                        @error('is_featured')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="sku">SKU:</label>
                                        <input id="sku" type="text"
                                            class="form-control @error('sku') is-invalid @enderror" name="sku"
                                            value="{{ old('sku', $products->sku) }}" required>
                                        @error('sku')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="qty">Quantity:</label>
                                        <input id="qty" type="number"
                                            class="form-control @error('qty') is-invalid @enderror" name="qty"
                                            value="{{ old('qty', $products->qty) }}" required>
                                        @error('qty')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="stock_status">Stock Status:</label>
                                        <select id="stock_status"
                                            class="form-control @error('stock_status') is-invalid @enderror"
                                            name="stock_status" required>
                                            <option value="in_stock"
                                                {{ old('stock_status', $products->stock_status) == 'in_stock' ? 'selected' : '' }}>
                                                In Stock</option>
                                            <option value="out_of_stock"
                                                {{ old('stock_status', $products->stock_status) == 'out_of_stock' ? 'selected' : '' }}>
                                                Out of Stock</option>
                                        </select>
                                        @error('stock_status')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="weight">Weight:</label>
                                        <input id="weight" type="number"
                                            class="form-control @error('weight') is-invalid @enderror" name="weight"
                                            value="{{ old('weight', $products->weight) }}" required>
                                        @error('weight')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="price">Price:</label>
                                        <input id="price" type="number"
                                            class="form-control @error('price') is-invalid @enderror" name="price"
                                            value="{{ old('price', $products->price) }}" required>
                                        @error('price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="special_price">Special Price:</label>
                                        <input id="special_price" type="number"
                                            class="form-control @error('special_price') is-invalid @enderror"
                                            name="special_price"
                                            value="{{ old('special_price', $products->special_price) }}">
                                        @error('special_price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="special_price_from">Special Price From:</label>
                                        <input id="special_price_from" type="datetime-local"
                                            class="form-control @error('special_price_from') is-invalid @enderror"
                                            name="special_price_from"
                                            value="{{ old('special_price_from', $products->special_price_from) }}">
                                        @error('special_price_from')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="special_price_to">Special Price To:</label>
                                        <input id="special_price_to" type="datetime-local"
                                            class="form-control @error('special_price_to') is-invalid @enderror"
                                            name="special_price_to"
                                            value="{{ old('special_price_to', $products->special_price_to) }}">
                                        @error('special_price_to')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="short_description">Short Description:</label>
                                        <textarea id="short_description" class="form-control @error('short_description') is-invalid @enderror"
                                            name="short_description" rows="3">{{ old('short_description', $products->short_description) }}</textarea>
                                        @error('short_description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                </div>

                                <div class="col-md-6">
                                    <!-- Second Part of Fields -->
                                    <div class="form-group">
                                        <label for="description">Description:</label>
                                        <textarea id="editor" class="form-control @error('description') is-invalid @enderror" name="description"
                                            rows="5" required>{{$products->description }}</textarea>
                                        @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="related_product">Related Product:</label>
                                        <select id="related_product" type="text"
                                            class="form-control @error('related_product') is-invalid @enderror"
                                            name="related_product[]" multiple>
                                            @foreach ($relatedProducts as $relatedProduct)
                                                <option value="{{ $relatedProduct->id }}"
                                                    {{ in_array($relatedProduct->id, explode(', ',$products->related_product)?? []) ? 'selected' : '' }}>
                                                    {{ $relatedProduct->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('related_product')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="meta_tag">Meta Tag:</label>
                                        <input id="meta_tag" type="text"
                                            class="form-control @error('meta_tag') is-invalid @enderror" name="meta_tag"
                                            value="{{ old('meta_tag', $products->meta_tag) }}">
                                        @error('meta_tag')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="meta_title">Meta Title:</label>
                                        <input id="meta_title" type="text"
                                            class="form-control @error('meta_title') is-invalid @enderror"
                                            name="meta_title" value="{{ old('meta_title', $products->meta_title) }}">
                                        @error('meta_title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="meta_description">Meta Description:</label>
                                        <textarea id="meta_description" class="form-control @error('meta_description') is-invalid @enderror"
                                            name="meta_description" rows="3">{{ $products->meta_description }}</textarea>
                                        @error('meta_description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile">Image Upload</label>
                                        <input type="file" id="exampleInputFile" name="banner_image[]" 
                                        value='{{ $products->getMedia('banner_image') }}' multiple>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile">ThumbNail Upload</label>
                                        <input type="file" id="exampleInputFile" name="thumbnail_image" 
                                        value='{{ $products->getFirstMediaUrl('thumbnail_image') }}'>
                                    </div>
                                    <div class="form-group">
                                        <label for="categories">Category:</label>
                                        <select class="form-control @error('categories') is-invalid @enderror"
                                            name="categories[]" multiple required>
                                            @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ in_array($category->id, $products->categories->pluck('id')->toArray() ?? []) ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                        </select>
                                        @error('categories')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    @foreach (getAttributes() as $attribute)
                                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                                        <input type="hidden" name="attribute[]" value="{{$attribute->id}}">
                                        <span style="color:red;">*</span>{{$attribute->name}}</label>
                                        <select class="form-control form-control-user @error('value') is-invalid @enderror" name="value[{{$attribute->id}}][]" multiple>
                                            @foreach ($attribute->attributeValues as $_attValue)
                                            <option value="{{$_attValue->id}}" {{in_array($_attValue->id, $pro_Attribute_Values)? 'selected': ''}}>{{$_attValue->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('value')
                                        <span class="text-danger">{{$message}}</span>  
                                        @enderror
                                        
                                    </div>
                                    @endforeach
                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
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
