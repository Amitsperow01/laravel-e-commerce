@extends('layouts.admin')

@section('content')
    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Product List</h3>
                        <a href="{{ route('product.create') }}" class="btn btn-primary" style="float: right;">Add Product</a>
                        @if (session()->has('success'))
                            <div class="callout callout-success" style="float:left;width:100%;margin-top:5px;">
                                {{ session()->get('success') }}</div>
                        @endif
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered display" id="myTable">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Status</th>
                                    <th>Featured</th>
                                    <th>SKU</th>
                                    <th>Qnty</th>
                                    <th>Weight</th>
                                    <th>Related Product</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->status }}</td>
                                        <td>{{ $product->is_featured ? 'Yes' : 'No' }}</td>
                                        <td>{{ $product->sku }}</td>
                                        <td>{{ $product->qty }}</td>
                                        <td>{{ $product->weight }}</td>
                                        <td>{{ $product->related_product }}</td>

                                        <td>
                                            <a href="{{ route('product.edit', $product->id) }}"
                                                class="btn btn-primary btn-sm">Edit</a>
                                            <form action="{{ route('product.destroy', $product->id) }}" method="POST"
                                                style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                                            </form>
                                            <a href="{{ route('product.show', $product->id) }}"
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
        <script>
            $(document).ready(function() {
                $('#myTable').DataTable();
            });
        </script>
    </section>
@endsection
