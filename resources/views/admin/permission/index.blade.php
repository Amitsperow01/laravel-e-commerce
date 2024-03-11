@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <h1>Permission List</h1>
    </section>

    <section class="content">
        {{-- {{ $permissions }} --}}

        <div class="row">
            <div class="col-md-6">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Permission List</h3>
                        <a href="{{ route('permission.create') }}" class="btn btn-primary" style="float: right;">Add
                            Permission</a>
                        @if (session()->has('success'))
                            <div class="callout callout-success" style="float:left;width:100%;margin-top:5px;">
                                {{ session()->get('success') }}</div>
                        @endif
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table id="myTable" class="table table-bordered display">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @forelse($permissions as $permission)
                                    <tr>
                                        <td>{{ $i++ . '.' }}</td>
                                        <td>{{ $permission->name }}</td>
                                        <td>
                                            <a href="{{ route('permission.edit', $permission->id) }}"
                                                class="btn btn-primary" style="float: left;margin-right:4px;"><i
                                                    class="fa fa-edit"></i>Edit</a>
                                            <form action="{{ route('permission.destroy', $permission->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger"><i class="fa fa-trash"
                                                        aria-hidden="true"></i>DELETE</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" align="center">No data found.</td>
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