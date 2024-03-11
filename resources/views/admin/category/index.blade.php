@extends('layouts.admin')

<!-- list.blade.php -->
@section('content')
    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Category List</h3>
                        <a href="{{ route('category.create') }}" class="btn btn-primary" style="float: right;">Add Category</a>
                        @if (session()->has('success'))
                            <div class="callout callout-success" style="float:left;width:100%;margin-top:5px;">
                                {{ session()->get('success') }}</div>
                        @endif
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered display" id="myTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Show in Menu</th>
                                    <th>Meta Tag</th>
                                    <th>Meta Title</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->status ? 'active' : 'inactive' }}</td>
                                        <td>{{ $category->show_in_menu ? 'Yes' : 'No' }}</td>
                                        <td>{{ $category->meta_tag }}</td>
                                        <td>{{ $category->meta_title }}</td>
                                        <td>
                                            <a href="{{ route('category.edit', $category->id) }}"
                                                class="btn btn-primary btn-sm">Edit</a>
                                            <form action="{{ route('category.destroy', $category->id) }}" method="POST"
                                                style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
                                            </form>
                                            <a href="{{ route('category.show', $category->id) }}"
                                                class="btn btn-primary btn-success">Show</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <script>
            $(document).ready(function() {
                $('#myTable').DataTable();
            });
        </script>
    @endsection
