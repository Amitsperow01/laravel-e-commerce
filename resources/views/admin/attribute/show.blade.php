@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <h1>Attribute information</h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Attribute information</h3>
                        <a href="{{ route('attribute.index') }}" class="btn btn-primary" style="float: right;">Back</a>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th>Attribute name</th>
                                <td>{{ $attributeData->name }}</td>
                            </tr>
                            <tr>
                                <th>Name Key</th>
                                <td>{{ $attributeData->name_key }}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>{{ $attributeData->status == 1 ? 'Enable' : 'Disable' }}</td>
                            </tr>
                            <tr>
                                <th>Is Variant</th>
                                <td>{{ $attributeData->is_variant == 1 ? 'YES' : 'NO' }}</td>
                            </tr>
                            <tr>
                                <th>Attribute Values name</th>
                                <td>{{ implode(', ', $attributeData->attributeValues->pluck('name')->toArray()) }}</td>
                            </tr>


                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div>
    </section>
@endsection
