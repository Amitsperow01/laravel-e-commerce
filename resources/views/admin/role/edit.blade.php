@extends('layouts.admin')

@section('content')
<section class="content-header">
    <h1>Role Edit</h1>
</section>

<section class="content">

<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Role Edit</h3>
              <a href="{{ route('role.index') }}" style="float: right;" class="btn btn-primary">Role List</a>
            </div>
            <!-- form start -->
            <form role="form" action="{{ route('role.update', $role->id) }}" method="POST">
                @csrf
                @method('PUT')
              <div class="box-body">
                  <label for="exampleInputEmail1">Role Name</label>
                <div class="form-group @error('name') has-error @enderror">
                  <input type="text" class="form-control" name="name" value="{{ $role->name }}" id="exampleInputEmail1" placeholder="Enter role">
                  @error('name')
                    <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{{ $message }}</label>
                  @enderror
                </div>

                <div class="form-group">
                    <label>Select Permission</label>
                    @foreach($permissions as $permission)
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="permissions[]" value="{{ $permission->name }}" {{ (in_array($permission->name, $role_permission)) ? 'checked':'' }}> {{ $permission->name }}
                      </label>
                    </div>
                    @endforeach
                  </div>

              </div><!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary" value="update">Update</button>
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

