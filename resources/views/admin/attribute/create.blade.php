@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <h1>Attribute Add</h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Attribute Add</h3>
                        @can('attribute_index')
                        <a href="{{ route('attribute.index') }}" class="btn btn-primary" style="float: right;">Attribute list</a>
                        @endcan
                        @if(session()->has('success'))
                        <div class="callout callout-success" style="margin-top: 20px;">
                            {{ session()->get('success') }}
                        </div>
                    @endif
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ route('attribute.store') }}" method="POST">
                        @csrf
                        <div class="box-body">
                            <label>Attribute name</label>
                            <div class="form-group @error('name') has-error @enderror">
                                <input type="text" name="name" class="form-control" placeholder="Enter attribute">
                                @error('name')
                                <p class="text-red">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Name Key</label>
                                <input type="text" name="name_key" class="form-control" placeholder="Enter name key">
                            </div>

                            <label>Is Variant</label>
                            <div class="form-group @error('is_variant') has-error @enderror">
                                <select name="is_variant" class="form-control">
                                    <option value="">Select Variant</option>
                                    <option value="1">Yes</option>
                                    <option value="2">No</option>
                                </select>
                                @error('is_variant')
                                <p class="text-red">{{ $message }}</p>
                                @enderror
                            </div>

                            <label>Select status</label>
                            <div class="form-group @error('status') has-error @enderror">
                                <select name="status" class="form-control">
                                    <option value="">Select status</option>
                                    <option value="1">Enable</option>
                                    <option value="2">Disable</option>
                                </select>
                                @error('status')
                                <p class="text-red">{{ $message }}</p>
                                @enderror
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
                                        <tr>
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
                                        </tr>

                                    </table>
                                </div>
                            </div>

                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" name="action" value="save" class="btn btn-primary">Save</button>
                            <button type="submit" name="action" value="save_and_new" class="btn btn-primary">Save & New</button>
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
