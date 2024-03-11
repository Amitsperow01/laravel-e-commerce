@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <h1>Slider Add</h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Slider add</h3>
                        <a href="{{ route('slider.index') }}" style="float: right;" class="btn btn-primary">Slider list</a>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ route('slider.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="box-body">

                            <label for="exampleInputEmail1">Enter Title</label>
                            <div class="form-group @error('title') has-error @enderror">
                                <input type="text" name="title" class="form-control" id="exampleInputEmail1"
                                    placeholder="Enter title" value="{{ old('title') }}">
                                @error('title')
                                    <label class="control-label"><i class="fa fa-times-circle-o"></i>
                                        {{ $message }}</label>
                                @enderror
                            </div>

                            <label for="exampleInputOrdering">Enter Ordering</label>
                            <div class="form-group @error('ordering') has-error @enderror">
                                <input type="number" name="ordering" class="form-control" id="exampleInputOrdering"
                                    placeholder="Enter Ordering" value="{{ old('ordering') }}">
                                @error('ordering')
                                    <label class="control-label"><i class="fa fa-times-circle-o"></i>
                                        {{ $message }}</label>
                                @enderror
                            </div>

                            <label>Select Status</label>
                            <div class="form-group @error('status') has-error @enderror">
                                <select class="form-control" name="status">
                                    <option value="">Select Status</option>
                                    <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Enable</option>
                                    <option value="2" {{ old('status') == 2 ? 'selected' : '' }}>Disable</option>
                                </select>
                                @error('status')
                                    <label class="control-label"><i class="fa fa-times-circle-o"></i>
                                        {{ $message }}</label>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Image Upload</label>
                                <input type="file" id="exampleInputFile" name="image">
                            </div>
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div><!-- /.box -->
            </div>
        </div>
    </section>
@endsection
