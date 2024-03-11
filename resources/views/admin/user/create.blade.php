@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <h1>User Add</h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">User Add</h3>
                        <a href="{{ route('user.index') }}" type="button" class="btn btn-primary" style="float: right;">User List</a>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ route('user.store') }}" method="POST">
                        @csrf
                        <div class="box-body">
                            <label for="exampleInputName">Enter name</label>
                            <div class="form-group @error('name') has-error @enderror">
                                <input type="text" name="name" class="form-control" id="exampleInputName"
                                    placeholder="Enter name" value="{{ old('name') }}">
                                @error('name')
                                    <label class="control-label" for="exampleInputName"><i class="fa fa-times-circle-o"></i> {{ $message }}</label>
                                @enderror
                            </div>

                            <label for="exampleInputEmail1">Enter email</label>
                            <div class="form-group @error('email') has-error @enderror">
                                <input type="text" name="email" class="form-control" id="exampleInputEmail1"
                                    placeholder="Enter email" value="{{ old('email') }}">
                                    @error('email')
                                    <label class="control-label" for="exampleInputEmail1"><i class="fa fa-times-circle-o"></i> {{ $message }}</label>
                                @enderror
                            </div>
                            <label for="exampleInputPassword1">Enter password</label>
                            <div class="form-group @error('password') has-error @enderror">
                                <input type="password" name="password" class="form-control" id="exampleInputPassword1"
                                    placeholder="Password">
                                    @error('password')
                                    <label class="control-label" for="exampleInputPassword1"><i class="fa fa-times-circle-o"></i> {{ $message }}</label>
                                @enderror
                            </div>
                            <label for="exampleInputPassword2">Enter confirm password</label>
                            <div class="form-group @error('confirm_password') has-error @enderror">
                                <input type="password" name="confirm_password" class="form-control"
                                    id="exampleInputPassword2" placeholder="Password">
                                    @error('confirm_password')
                                    <label class="control-label" for="exampleInputPassword2"><i class="fa fa-times-circle-o"></i> {{ $message }}</label>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Select Roles</label>
                                @foreach($roles as $role)
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="roles[]" value="{{ $role->name }}" />
                                            {{ $role->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>


                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">SAVE</button>
                        </div>
                    </form>
                </div><!-- /.box -->
            </div>
        </div>
    </section>
@endsection
