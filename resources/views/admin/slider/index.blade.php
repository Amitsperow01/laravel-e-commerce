@extends('layouts.admin')

@section('content')
	
<section class="content-header">
	<h1>Slider List</h1>
</section>

<section class="content">

	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Slider List</h3>
					<a href="{{ route('slider.create') }}" class="btn btn-primary" style="float: right;">Add Slider</a>
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
								<th>Ordering</th>
								<th>Status</th>
								<th>Image</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@php
								$i = 1;
							@endphp
							@forelse($slider as $_slider)
								<tr>
									<td>{{ $i++ . '.' }}</td>
									<td>{{ $_slider->title }}</td>
									<td>{{ $_slider->ordering }}</td>
									<td>{{ $_slider->status == 1 ? 'Enable' : 'Disable' }}</td>
									<td style="width: 150px;"><img src="{{ $_slider->getFirstMediaUrl('image') }}" alt="" style="width:100%;"></td>
				
									<td>
										@can('slider_edit')
											<a href="{{ route('slider.edit', $_slider->id) }}" class="btn btn-primary"
												style="float: left;margin-right:4px;"><i class="fa fa-edit"></i>Edit</a>
										@endcan
										@can('slider_delete')
											<form action="{{ route('slider.destroy', $_slider->id) }}" method="POST">
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