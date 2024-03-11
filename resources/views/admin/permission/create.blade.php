@extends('layouts.admin')

@section('content')
<section class="content-header">
    <h1>Permission Add</h1>
</section>

<section class="content">

<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Permission Add</h3>
              <a href="{{ route('permission.index') }}" style="float: right;" class="btn btn-primary">Permission List</a>
              @if(session()->has('success'))
                <div class="callout callout-success" style="float:left;width:100%;margin-top:5px;">{{ session()->get('success') }}</div>
              @endif
            </div>
            <!-- form start -->
            <form role="form" action="{{ route('permission.store') }}" method="POST">
                @csrf
              <div class="box-body">
                  <label for="exampleInputEmail1">Permission Name</label>
                <div class="form-group @error('name') has-error @enderror">
                  <input type="text" class="form-control" name="name" id="exampleInputEmail1" placeholder="Enter permission">
                  @error('name')
                    <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{{ $message }}</label>
                  @enderror
                </div>
              </div><!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary" name="action" value="save">Save</button>
                <button type="submit" class="btn btn-primary" name="action" value="save_and_new">Save & New</button>
              </div>
            </form>
          </div><!-- /.box -->
    </div>
</div>
</section>
@endsection

{{-- <div class="callout callout-success">
    <h4>I am a success callout!</h4>
    <p>This is a green callout.</p>
  </div> --}}

