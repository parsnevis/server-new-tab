@extends('reseller.layouts.reseller')

@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <section class="col-lg-12">

{{--                    <div class="callout callout-info">--}}
{{--                        <div class="btn">--}}
{{--                            <a href="{{ route('admin.user', 'all') }}">--}}
{{--                                <h4 class="text-all bold">{{ __('lang.' . strtoupper('all')) }}</h4>--}}
{{--                                <h3 class="persian-number bold">{{ $users_count }}</h3>--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                        @foreach ($all_roles as $roles_item)--}}
{{--                            @if($_auth->hasPermissionTo('users.index.'.lcfirst($roles_item)))--}}
{{--                            <div class="btn">--}}
{{--                                <a href="{{ route('admin.user', lcfirst($roles_item)) }}">--}}
{{--                                    <h4 class="text-{{$roles_item}} bold">{{ __('lang.' . strtoupper($roles_item)) }}</h4>--}}
{{--                                    <h3 class="persian-number bold">{{ $counts[lcfirst($roles_item)] }}</h3>--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                            @endif--}}
{{--                        @endforeach--}}
{{--                    </div>--}}

                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <?php $role = explode('/', url()->current()); $role = $role[count($role)-1]; ?>
                                            <input type="hidden" id="role" name="role" class="form-control" value="{{ $role }}">
                                            <input type="hidden" id="data-table-type" name="data-table-type" class="form-control" value="users">
                                            <input type="text" id="search" name="search" class="form-control @error('search') is-invalid @enderror" value="">
                                            @error('search')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="data_table">
                                <input type="hidden" name="auth_id" id="auth_id" value="{{ $_auth->id }}">
                                @include('reseller.users.data_table')
                            </div>
                        </div>
                    </div>
                </section>
                <!-- /.Left col -->
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection
