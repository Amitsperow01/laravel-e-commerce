@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <h1>Edit Category</h1>
    </section>

    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Edit Category</h3>
                        <a href="{{ route('category.index') }}" style="float: right;" class="btn btn-primary">Category List</a>
                    </div>
                    <div class="box-body">
                        <!-- edit.blade.php -->

                        <form action="{{ route('category.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <!-- Category Parent ID -->
                                        <div class="form-group">
                                            <label for="category_parent_id">Parent Category</label>
                                            <select id="category_parent_id" name="category_parent_id" class="form-control">
                                                <option value="">Select</option>
                                                @foreach (getCategories() as $cat)
                                                    <option value="{{ $cat->id }}" {{ $category->category_parent_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>

                                                    @foreach (SubCategories($cat->id) as $subcat)
                                                        <option value="{{ $subcat->id }}" {{ $category->category_parent_id == $subcat->id ? 'selected' : '' }}>
                                                            {!! '&nbsp;' !!}-{{ $subcat->name }}</option>

                                                        @foreach (SubSubCategories($subcat->id) as $subsubcat)
                                                            <option value="{{ $subsubcat->id }}" {{ $category->category_parent_id == $subsubcat->id ? 'selected' : '' }}>
                                                                {!! '&nbsp;&nbsp;&nbsp;' !!}--{{ $subsubcat->name }}</option>
                                                        @endforeach
                                                    @endforeach
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Name -->
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" id="name" name="name" class="form-control" value="{{ $category->name }}">
                                        </div>

                                        <!-- Status -->
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select id="status" name="status" class="form-control">
                                                <option value="">Select</option>
                                                <option value="1" {{ $category->status == 1 ? 'selected' : '' }}>Active</option>
                                                <option value="2" {{ $category->status == 2 ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                        </div>

                                        <!-- Show in Menu -->
                                        <div class="form-group">
                                            <label for="show_in_menu">Show in Menu</label>
                                            <select id="show_in_menu" name="show_in_menu" class="form-control">
                                                <option value="">Select</option>
                                                <option value="1" {{ $category->show_in_menu == 1 ? 'selected' : '' }}>Yes</option>
                                                <option value="2" {{ $category->show_in_menu == 2 ? 'selected' : '' }}>No</option>
                                            </select>
                                        </div>

                                        <!-- Short Description -->
                                        <div class="form-group">
                                            <label for="short_description">Short Description</label>
                                            <textarea id="short_description" name="short_description" class="form-control">{{ $category->short_description }}</textarea>
                                        </div>

                                         <!-- Description -->
                                         <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea id="editor" name="description" class="form-control">{{ $category->description }}</textarea>
                                        </div>
                                       
                                    </div>

                                    <div class="col-md-6">

                                        
                                        <!-- Meta Tag -->
                                        <div class="form-group">
                                            <label for="meta_tag">Meta Tag</label>
                                            <input type="text" id="meta_tag" name="meta_tag" class="form-control" value="{{ $category->meta_tag }}">
                                        </div>

                                        <!-- Meta Title -->
                                        <div class="form-group">
                                            <label for="meta_title">Meta Title</label>
                                            <input type="text" id="meta_title" name="meta_title" class="form-control" value="{{ $category->meta_title }}">
                                        </div>

                                        <!-- Meta Description -->
                                        <div class="form-group">
                                            <label for="meta_description">Meta Description</label>
                                            <textarea id="meta_description" name="meta_description" class="form-control">{{ $category->meta_description }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputFile">Image Upload</label>
                                            <input type="file" id="exampleInputFile" name="banner_image[]" 
                                            value='{{ $category->getMedia('banner_image') }}' multiple>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputFile">ThumbNail Upload</label>
                                            <input type="file" id="exampleInputFile" name="thumbnail_image" 
                                            value='{{ $category->getFirstMediaUrl('thumbnail_image') }}'>
                                        </div>
                                    <div class="form-group">
                                        <label for="product">Product:</label>
                                        <select class="form-control @error('product') is-invalid @enderror"
                                            name="product[]" multiple required>
                                            @foreach ($product as $product) 
                                                <option value="{{ $product->id }}"
                                                    {{ in_array($product->id, $category->product->pluck('id')->toArray() ?? []) ? 'selected' : '' }}>
                                                    {{ $product->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('product')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>


                                        <!-- Submit Button -->
                                        <button type="submit" name="save" value="save" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </div>
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
