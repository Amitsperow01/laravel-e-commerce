@extends('layouts.admin')

@section('content')

{{-- {{ $attribute->attributeValues }} --}}
    <section class="content-header">
        <h1>Attribute Edit</h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Attribute Edit</h3>
                        @can('attribute_index')
                        <a href="{{ route('attribute.index') }}" class="btn btn-primary" style="float: right;">Attribute list</a>
                        @endcan
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ route('attribute.update', $attribute->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="box-body">
                            <div class="form-group">
                                <label>Attribute name</label>
                                <input type="text" name="name" class="form-control" value="{{ $attribute->name }}" placeholder="Enter attribute">
                            </div>

                            {{-- <div class="form-group">
                                <label>Name Key</label>
                                <input type="text" name="name_key" value="" class="form-control" placeholder="Enter name key">
                            </div> --}}

                            <div class="form-group">
                                <label>Is Variant</label>
                                <select name="is_variant" class="form-control">
                                    <option value="">Select Variant</option>
                                    <option value="1" {{ ($attribute->status==1) ? 'selected':'' }}>Yes</option>
                                    <option value="2" {{ ($attribute->status==2) ? 'selected':'' }}>No</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Select status</label>
                                <select name="status" class="form-control">
                                    <option value="">Select status</option>
                                    <option value="1" {{ ($attribute->status==1) ? 'selected':'' }}>Enable</option>
                                    <option value="2" {{ ($attribute->status==2) ? 'selected':'' }}>Disable</option>
                                </select>
                            </div>


                            <div class="form-group">
                                <label>Attribute Values</label>
                                <div class="box-body">
                                    <table class="attribute_values table table-bordered">
                                        <tr>
                                            <th>Value Name</th>
                                            <th>Value Status</th>
                                            <th>
                                                <button type="button" class="add_more btn btn-primary">+</button>
                                            </th>
                                        </tr>
                                        @foreach($attribute->attributeValues as $value)
                                        <tr>
                                            <td>
                                                <input type="hidden" name="attributeId[]" value="{{ $value->id }}">
                                                <input type="text" name="attribute_value_name[]" value="{{ $value->name }}" class="form-control">
                                            </td>

                                            <td>
                                                <select name="attribute_value_status[]" class="form-control">
                                                    <option value="">Select status</option>
                                                    <option value="1" {{ ($value->status==1) ? 'selected':'' }}>Enable</option>
                                                    <option value="2" {{ ($value->status==2) ? 'selected':'' }}>Disable</option>
                                                </select>
                                            </td>
                                            <td>
                                                <button type="button" class="remove_tr btn btn-danger">X</button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </table>
                                </div>


                            </div>

                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div><!-- /.box -->
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function() {
            $(".add_more").click(function() {
                var trData = `<tr>
                                <td>
                                    <input type="text" name="attribute_value_name[]" class="form-control">
                                </td>
                                
                                <td>
                                    <select name="attribute_value_status[]" class="form-control">
                                        <option value="">Select status</option>
                                        <option value="1">Enable</option>
                                        <option value="2">Disable</option>
                                    </select>
                                </td>
                                <td>
                                    <button type="button" class="remove_tr btn btn-danger">X</button>
                                </td>
                            </tr>`;

                $('.attribute_values').append(trData);
            });
            $('.attribute_values').delegate('.remove_tr', 'click', function(){
                $(this).closest('tr').remove();
            });

        });
    </script>
@endsection
