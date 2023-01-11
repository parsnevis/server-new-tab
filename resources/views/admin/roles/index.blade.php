@extends('admin.layouts.backend')

@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- /.col -->
                <div class="col-md-12">
                    <div class="card card-primary card-outline ">
                        <div class="card-body">
                            <div class="btn-group">
                            </div>
                            <a href="{{ url()->previous() }}" class="btn btn-warning float-right"><i class="fa fa-reply"></i></a>
                        </div>
                    </div>


                    <div class="card card-info card-outline shipment_information">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">

                                    <div class="table-responsive">
                                        <table class="widefat table table-striped text-center table-clients no-footer" data-table="data-table">
                                            <thead>
                                            <tr>
                                                <th>{{ __('lang.' . strtoupper('#')) }}</th>
                                                <th>{{ __('lang.' . strtoupper('role')) }}</th>
                                                <th>{{ __('lang.' . strtoupper('permissions')) }}</th>
                                                <th>{{ __('lang.' . strtoupper('operations')) }}</th>
                                            </tr>
                                            </thead>

                                            <tbody>
                                            @foreach ($roles as $role)
                                                <tr>
                                                    <td>
                                                        <span class="persian-number">{{ $role->id }}</span>
                                                    </td>

                                                    <td>{{ __('lang.' . strtoupper(implode('_', explode(' ', $role->name)))) }}</td>

                                                    <?php $permissions = $role->permissions()->pluck('name'); ?>
                                                    <td>
{{--                                                        @foreach($permissions as $permission)--}}
{{--                                                        <span class="label label-administrator float-right">{{ __('lang.' . $permission) }}</span>--}}
{{--                                                        @endforeach--}}
                                                        {{ count($permissions) }}
                                                    </td>

                                                    <td class="operation">
                                                        <div>
                                                            <form action="{{ route('admin.roles.destroy',$role->id) }}" method="POST">
                                                                <div class="btn-group">
                                                                    <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-info"><i class="fas fa-edit"></i></a>
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger" disabled><i class="fas fa-trash-alt"></i></button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </td>

                                                </tr>
                                            @endforeach
                                            </tbody>

                                            <tfoot>
                                            <tr>
                                                <th>{{ __('lang.' . strtoupper('#')) }}</th>
                                                <th>{{ __('lang.' . strtoupper('role')) }}</th>
                                                <th>{{ __('lang.' . strtoupper('permissions')) }}</th>
                                                <th>{{ __('lang.' . strtoupper('operations')) }}</th>
                                            </tr>
                                            </tfoot>

                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->

@endsection
