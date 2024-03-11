@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <h1>Category Add</h1>
    </section>

    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Category Add</h3>
                        <a href="{{ route('category.index') }}" style="float: right;" class="btn btn-primary">Category List</a>
                    </div>
                    <div class="box-body">
                        <!-- create.blade.php -->

                        <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <!-- Category Parent ID -->
                                        <div class="form-group">
                                            <label for="category_parent_id">Parent Category</label>
                                            <select id="category_parent_id" name="category_parent_id" class="form-control">
                                                <option value="">Select</option>
                                                @foreach (getCategories() as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>

                                                    @foreach (SubCategories($category->id) as $subcategory)
                                                        <option value="{{ $subcategory->id }}">
                                                            {!! '&nbsp;' !!}-{{ $subcategory->name }}</option>

                                                        @foreach (SubSubCategories($subcategory->id) as $subsubcategory)
                                                            <option value="{{ $subsubcategory->id }}">
                                                                {!! '&nbsp;&nbsp;&nbsp;' !!}--{{ $subsubcategory->name }}
                                                            </option>
                                                        @endforeach
                                                    @endforeach
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Name -->
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" id="name" name="name" class="form-control">
                                        </div>

                                        <!-- Status -->
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select id="status" name="status" class="form-control">
                                                <option value="">Select</option>
                                                <option value="1">Active</option>
                                                <option value="2">Inactive</option>
                                            </select>
                                        </div>

                                        <!-- Show in Menu -->
                                        <div class="form-group">
                                            <label for="show_in_menu">Show in Menu</label>
                                            <select id="show_in_menu" name="show_in_menu" class="form-control">
                                                <option value="">Select</option>
                                                <option value="1">Yes</option>
                                                <option value="2">No</option>
                                            </select>
                                        </div>

                                        <!-- Short Description -->
                                        <div class="form-group">
                                            <label for="short_description">Short Description</label>
                                            <textarea id="short_description" name="short_description" class="form-control"></textarea>
                                        </div>
                                        <!-- Description -->
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea id="editor" name="description" class="form-control"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-6">

                                        <!-- URL Key -->
                                        <div class="form-group">
                                            <label for="url_key">URL Key</label>
                                            <input type="text" id="url_key" name="url_key" class="form-control">
                                        </div>

                                        <!-- Meta Tag -->
                                        <div class="form-group">
                                            <label for="meta_tag">Meta Tag</label>
                                            <input type="text" id="meta_tag" name="meta_tag" class="form-control">
                                        </div>

                                        <!-- Meta Title -->
                                        <div class="form-group">
                                            <label for="meta_title">Meta Title</label>
                                            <input type="text" id="meta_title" name="meta_title" class="form-control">
                                        </div>

                                        <!-- Meta Description -->
                                        <div class="form-group">
                                            <label for="meta_description">Meta Description</label>
                                            <textarea id="meta_description" name="meta_description" class="form-control"></textarea>
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
                                            <label for="product">Product:</label>
                                            <select class="form-control" name="product[]" multiple>
                                                @foreach ($product as $_product)
                                                    <option value="{{ $_product->id }}">
                                                        {{ $_product->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Submit Button -->
                                        <button type="submit" name="save" value="save"
                                            class="btn btn-primary">Save</button>
                                        <button type="submit" name="save" value="save_new" class="btn btn-primary">Save
                                            & New</button>
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
