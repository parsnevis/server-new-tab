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
                        <div class="card-header">
                            <h3 class="card-title">{{ __('lang.' . strtoupper('permission_information')) }}</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-angle-double-up"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h1><i class='fa fa-key'></i> {{ __('lang.' . strtoupper($permission->name)) }}</h1>
                                    <hr>

                                    <form action="{{ route('admin.permissions.update', $permission->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="name" class="control-label "><span class="req text-danger">* </span>{{ __('lang.' . strtoupper('english_name')) }}</label>
                                                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $permission->name }}" required>
                                                    @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-success float-right">{{ __('lang.' . strtoupper('submit')) }}</button>
                                            </div>
                                        </div>
                                    </form>

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

