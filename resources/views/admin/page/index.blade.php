@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <h1>Page List</h1>
    </section>

    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Page List</h3>
                        <a href="{{ route('page.create') }}" class="btn btn-primary" style="float: right;">Add Page</a>
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
                                    <th>Title</th>
                                    <th>Heading</th>
                                    <th>Ordering</th>
                                    <th>Status</th>
                                    <th>Url Key</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @forelse($pages as $page)
                                    <tr>
                                        <td>{{ $i++ . '.' }}</td>
                                        <td>{{ $page->title }}</td>
                                        <td>{{ $page->heading }}</td>
                                        <td>{{ $page->ordering }}</td>
                                        <td>{{ $page->status == 1 ? 'Enable' : 'Disable' }}</td>
                                        <td>{{ $page->url_key }}</td>
                                        <td style="width: 150px;"><img src="{{ $page->getFirstMediaUrl('image') }}"
                                                alt="" style="width:100%;"></td>
                                        <td>
                                            @can('page_edit')
                                                <a href="{{ route('page.edit', $page->id) }}" class="btn btn-primary"
                                                    style="float: left;margin-right:4px;"><i class="fa fa-edit"></i>Edit</a>
                                            @endcan
                                            @can('page_delete')
                                                <form action="{{ route('page.destroy', $page->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger"><i class="fa fa-trash"
                                                            aria-hidden="true"></i>DELETE</button>
                                                </form>
                                            @endcan
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" align="center">No data found.</td>
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
