@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <h1>User List</h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-9">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">User List</h3>
                        <a href="{{ route('user.create') }}" class="btn btn-primary" style="float: right;">User Add</a>
                        @if (session()->has('success'))
                            <div class="callout callout-success" style="margin-top:20px;">{{ session()->get('success') }}
                            </div>
                        @endif
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table id="myTable" class="table table-bordered display">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>User Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @forelse($users as $user)
                                    <tr>
                                        <td>{{ $i++ . '.' }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            {{ implode(', ', $user->roles->pluck('name')->toArray()) }}
                                        </td>
                                        <td>
                                            @can('user_edit')
                                                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary"
                                                    style="float: left;margin-right:4px;"><i class="fa fa-edit"></i>Edit</a>
                                            @endcan
                                            @can('user_delete')
                                                <form action="{{ route('user.destroy', $user->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"><i
                                                            class="fa fa-trash"></i>DELETE</button>
                                                </form>
                                            @endcan
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" align="center">No data found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
        </div>
        <script>
            $(document).ready(function() {
                $('#myTable').DataTable();
            });
        </script>
    </section>
@endsection
