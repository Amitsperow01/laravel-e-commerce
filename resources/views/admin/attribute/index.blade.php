@extends('layouts.admin')

@section('content')
<section class="content">

	<div class="row">
		<div class="col-md-10">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Attribute List</h3>
					<a href="{{ route('attribute.create') }}" class="btn btn-primary" style="float: right;">Add Attribute</a>
					@if (session()->has('success'))
						<div class="callout callout-success" style="float:left;width:100%;margin-top:5px;">
							{{ session()->get('success') }}</div>
					@endif
				</div><!-- /.box-header -->
				<div class="box-body">
                <table class="table table-striped table-bordered table-hover display" id="myTable">
                    <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>Name</th>
                            <th >Status</th>
                            <th >Variant</th>
                            <th>Name key</th>
                            <th >Action</th>

                        </tr>
                    </thead>
					<tbody>
						@php
							$i = 1;
						@endphp
						@foreach ($attributes as $attribute)
							<tr>
								<td>{{ $i++ }}</td>
								<td>{{ $attribute->name }}</td>
								<td>{{ $attribute->status ? 'active' : 'inactive' }}</td>
								<td>{{ $attribute->is_variant ? 'Yes' : 'No' }}</td>
								<td>{{ $attribute->name_key }}</td>
								<td>
									<a href="{{ route('attribute.edit', $attribute->id) }}"
										class="btn btn-primary btn-sm">Edit</a>
									<form action="{{ route('attribute.destroy', $attribute->id) }}" method="POST"
										style="display: inline-block;">
										@csrf
										@method('DELETE')
										<button type="submit" class="btn btn-danger btn-sm"
											onclick="return confirm('Are you sure you want to delete this attribute?')">Delete</button>
									</form>
									<a href="{{ route('attribute.show', $attribute->id) }}"
										class="btn btn-primary btn-success">Show</a>
								</td>
							</tr>
						@endforeach
					</tbody>
                </table>
            </div>

        </div>


    </div>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
@endsection
