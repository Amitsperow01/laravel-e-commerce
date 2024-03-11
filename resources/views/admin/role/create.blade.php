@extends('layouts.admin')

@section('content')
<section class="content-header">
    <h1>Role Add</h1>
</section>
{{-- {{ $permissions }} --}}
<section class="content">
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Role Add</h3>
                  <a href="{{ route('role.index') }}" style="float: right;" class="btn btn-primary">Role List</a>
                  @if(session()->has('success'))
                    <div class="callout callout-success" style="float:left;width:100%;margin-top:5px;">{{ session()->get('success') }}</div>
                  @endif
                </div>
                <!-- form start -->
                <form role="form" action="{{ route('role.store') }}" method="POST">
                    @csrf
                  <div class="box-body">
                      <label for="exampleInputEmail1">Role Name</label>
                    <div class="form-group @error('name') has-error @enderror">
                      <input type="text" class="form-control" name="name" value="{{ old('name') }}" id="exampleInputEmail1" placeholder="Enter role">
                      @error('name')
                        <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{{ $message }}</label>
                      @enderror
                    </div>

                    <div class="form-group">
                      <label>Select Permission</label>
                      <button type="button" class="btn btn-primary btn-xs" id="select_all_permission" style="float: right;">Select all</button>
                      @foreach($permissions as $permission)
                      <div class="checkbox add_checked">
                        <label>
                          <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"> {{ $permission->name }}
                        </label>
                      </div>
                      @endforeach
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

    <script>
      $(document).ready(function(){
        $("#select_all_permission").click(function(){
          $('.icheckbox_flat-blue').addClass('checked');
          $('.icheckbox_flat-blue input[type="checkbox"]').attr('checked', 'checked');
        });
      });
    </script>

</section>

@endsection