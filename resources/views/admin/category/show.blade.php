@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Category Name:-> <b>{{ $category->name }}</b> </div>

                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">Status:</label>
                        <div class="col-md-6">
                            {{ $category->status? 'Active' : 'Inactive' }}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">Show in Menu:</label>
                        <div class="col-md-6">
                            {{ $category->show_in_menu ? 'Yes' : 'No' }}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">Short Description:</label>
                        <div class="col-md-6">
                            {{ $category->short_description }}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">Description:</label>
                        <div class="col-md-6">
                            {{ $category->description }}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">URL Key:</label>
                        <div class="col-md-6">
                            {{ $category->url_key }}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">Meta Tag:</label>
                        <div class="col-md-6">
                            {{ $category->meta_tag }}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">Meta Title:</label>
                        <div class="col-md-6">
                            {{ $category->meta_title }}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">Meta Description:</label>
                        <div class="col-md-6">
                            {{ $category->meta_description }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
