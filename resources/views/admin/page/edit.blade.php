@extends('layouts.admin')
@section('content')
    <section class="content-header">
        <h1>Page Edit</h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Page Edit</h3>
                        <a href="{{ route('page.index') }}" style="float: right;" class="btn btn-primary">Page list</a>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ route('page.update', $page->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="box-body">
                            <label>Select Menu</label>
                            <div class="form-group @error('parent_id') has-error @enderror">
                                <select class="form-control" name="parent_id">
                                    <option value="">Select Menu</option>
                                    @foreach (getpages() as $_page)
                                        
                                    <option value="{{($_page->parent_id)}}" {{$_page==$page?'selected':""}}>{{ ($_page->title)}}</option>
                                    @endforeach
                                </select>
                                @error('parent_id')
                                <label class="control-label"><i class="fa fa-times-circle-o"></i> {{ $message }}</label>
                               @enderror
                            </div>
                            <label for="exampleInputEmail1">Enter Title</label>
                            <div class="form-group @error('title') has-error @enderror">
                                <input type="text" name="title" class="form-control" id="exampleInputEmail1"
                                    placeholder="Enter title" value="{{ $page->title }}">
                                   @error('title')
                                    <label class="control-label"><i class="fa fa-times-circle-o"></i> {{ $message }}</label>
                                   @enderror
                            </div>
                            <label for="exampleInputHeading">Enter Heading</label>
                            <div class="form-group @error('heading') has-error @enderror">
                                <input type="text" name="heading" class="form-control" id="exampleInputHeading"
                                    placeholder="Enter Heading" value="{{ $page->heading }}">
                                    @error('heading')
                                    <label class="control-label"><i class="fa fa-times-circle-o"></i> {{ $message }}</label>
                                   @enderror
                            </div>
                            <label for="exampleInputOrdering">Enter Ordering</label>
                            <div class="form-group @error('ordering') has-error @enderror">
                                <input type="number" name="ordering" class="form-control" id="exampleInputOrdering"
                                    placeholder="Enter Ordering" value="{{ $page->ordering }}">
                                    @error('ordering')
                                    <label class="control-label"><i class="fa fa-times-circle-o"></i> {{ $message }}</label>
                                   @enderror
                            </div>

                            <label>Select Status</label>
                            <div class="form-group @error('status') has-error @enderror">
                                <select class="form-control" name="status">
                                    <option value="">Select Status</option>
                                    <option value="1" {{ ($page->status==1) ? 'selected':'' }}>Enable</option>
                                    <option value="2" {{ ($page->status==2) ? 'selected':'' }}>Disable</option>
                                </select>
                                @error('status')
                                <label class="control-label"><i class="fa fa-times-circle-o"></i> {{ $message }}</label>
                               @enderror
                            </div>

                            <label for="exampleInputUrlkey">Enter URL Key</label>
                            <div class="form-group">
                                <input type="text" name="url_key" class="form-control" id="exampleInputUrlkey"
                                    placeholder="Enter Url key" value="{{ $page->url_key }}">
                                   
                            </div>

                            <label for="editor">Enter Description</label>
                            <div class="form-group">
                                <textarea name="description" id="editor">{{ $page->description }}</textarea>
                                
                            </div>

                            <div class="form-group">
                                <label for="exampleInputFile">Image Upload</label>
                                <input type="file" id="exampleInputFile" name="image" 
                                value='{{ $page->getFirstMediaUrl('image') }}'>
                            </div>

                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div><!-- /.box -->
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
