@extends('layouts.admin')

@section('content')

<section class="content-header">
	<h1>Slider Edit</h1>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title">Slider Edit</h3>
					<a href="{{ route('slider.index') }}" style="float: right;" class="btn btn-primary">Slider list</a>
				</div><!-- /.box-header -->
				<!-- form start -->
				<form role="form" action="{{ route('slider.update',$slider->id) }}" method="POST" enctype="multipart/form-data">
					@csrf
					@method('PUT')
					<div class="box-body">

						<label for="exampleInputEmail1">Enter Title</label>
						<div class="form-group @error('title') has-error @enderror">
							<input type="text" name="title" class="form-control" id="exampleInputEmail1"
								placeholder="Enter title" value="{{ $slider->title }}">
							   @error('title')
								<label class="control-label"><i class="fa fa-times-circle-o"></i> {{ $message }}</label>
							   @enderror
						</div>
						
						<label for="exampleInputOrdering">Enter Ordering</label>
						<div class="form-group @error('ordering') has-error @enderror">
							<input type="number" name="ordering" class="form-control" id="exampleInputOrdering"
								placeholder="Enter Ordering" value="{{ $slider->ordering }}">
								@error('ordering')
								<label class="control-label"><i class="fa fa-times-circle-o"></i> {{ $message }}</label>
							   @enderror
						</div>

						<label>Select Status</label>
						<div class="form-group @error('status') has-error @enderror">
							<select class="form-control" name="status">
								<option value="">Select Status</option>
								<option value="1" {{($slider->status==1) ? 'selected':'' }}>Enable</option>
								<option value="2" {{($slider->status==2) ? 'selected':'' }}>Disable</option>
							</select>
							@error('status')
							<label class="control-label"><i class="fa fa-times-circle-o"></i> {{ $message }}</label>
						   @enderror
						</div>
						<div class="form-group">
							<label for="exampleInputFile">Image Upload</label>
							<input type="file" id="exampleInputFile" name="image" 
							value='{{ $slider->getFirstMediaUrl('image') }}'>
						</div>
					</div><!-- /.box-body -->
					<div class="box-footer">
						<button type="submit" class="btn btn-primary">Save</button>
					</div>
				</form>
			</div><!-- /.box -->
		</div>
	</div>
	
@endsection