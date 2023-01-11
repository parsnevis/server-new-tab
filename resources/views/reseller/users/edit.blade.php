@extends('reseller.layouts.reseller')

<?php
  $regions = $_auth->regions;

//  if(isset($user))dd('sdsd');
?>

@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- /.col -->
                <div class="col-md-12">
                    <div class="card card-info card-outline">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div id="settings">
                                <div class="tab-content">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form action="{{ isset($user) ? route('reseller.users.update', $user->id) : route('reseller.users.store') }}" class="client-form" method="POST">
                                                @csrf
                                                @if( isset($user) )
                                                    @method('PUT')
                                                @endif
                                                <input type="hidden" name="reseller_id" value="{{ $_auth->id }}">

                                                <div class="row mb-3">
                                                    <div class="col-3">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend carton">
                                                                <span class="input-group-text">
                                                                  <input type="checkbox" name="activated_at" id="activated_at" {{ isset($user) ? $user->activated_at != null ? 'checked' : '' : ''  }}>
                                                                </span>
                                                            </div>
                                                            <div class="input-group-append">
                                                                <label for="activated_at" class="m-0">
                                                                    <div class="input-group-text">
                                                                        {{ __('lang.' . strtoupper('activate')) }}
                                                                    </div>
                                                                </label>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="first_name" class="control-label">
                                                                <span class="req text-danger">* {{ __('lang.' . strtoupper('first_name')) }}</span>
                                                            </label>
                                                            <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{ isset($user) ? $user->first_name : old('first_name') }}" required>
                                                            @error('first_name')
                                                            <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="last_name" class="control-label">
                                                                <span class="req text-danger">* {{ __('lang.' . strtoupper('last_name')) }}</span>
                                                            </label>
                                                            <input type="text" id="last_name" name="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{ isset($user) ? $user->last_name : old('last_name') }}" required>
                                                            @error('last_name')
                                                            <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="national_id" class="control-label">
                                                                <span class="req text-danger">* {{ __('lang.' . strtoupper('national_id')) }}</span>
                                                            </label>
                                                            <input type="text" id="national_id" name="national_id" class="form-control @error('national_id') is-invalid @enderror" value="{{ isset($user) ? $user->national_id : old('national_id') }}" required>
                                                            @error('national_id')
                                                            <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="email" class="control-label">
                                                                <span class="req text-danger">* {{ __('lang.' . strtoupper('email')) }}</span>
                                                            </label>
                                                            <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ isset($user) ? $user->email : old('email') }}" required>
                                                            @error('email')
                                                            <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="mobile" class="control-label">
                                                                <span class="req text-danger">* {{ __('lang.' . strtoupper('Mobile')) }}</span>
                                                            </label>
                                                            <input type="text" id="mobile" name="mobile" class="form-control @error('mobile') is-invalid @enderror" value="{{ isset($user) ? $user->mobile : old('mobile') }}" required>
                                                            @error('mobile')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                    </div>



                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="region_id" class="control-label"><span class="req text-danger">* {{ __('lang.' . strtoupper('region')) }}</span></label>
                                                            <select id="region_id" name="region_id" class="selectpicker @error('region_id') is-invalid @enderror" data-width="100%" data-placeholder="{{ __('lang.' . strtoupper('no_selected_item')) }}" data-live-search="true" required>
                                                                <option value=""></option>
                                                                @foreach ($regions as $region)
                                                                    <option value="{{ $region->id }}" {{ isset($user) ? $user->region_id == $region->id ? 'selected' : '' : '' }}>{{ $region->title }}</option>
                                                                @endforeach
                                                            </select>
                                                            @if($errors->has('region_id'))
                                                                <span class="help-block text-danger text-bold" role="alert">
                                                            {{ $errors->first('region_id') }}
                                                        </span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="position" class="control-label">{{ __('lang.' . strtoupper('position')) }}</label>
                                                            <input type="text" id="position" name="position" class="form-control @error('position') is-invalid @enderror" value="{{ isset($user) ? $user->position : old('position') }}">
                                                            @error('position')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="phone" class="control-label">{{ __('lang.' . strtoupper('Phone')) }}</label>
                                                            <input type="text" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ isset($user) ? $user->phone : old('phone') }}">
                                                            @error('phone')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="local_phone" class="control-label">{{ __('lang.' . strtoupper('local_phone')) }}</label>
                                                            <input type="text" id="local_phone" name="local_phone" class="form-control @error('local_phone') is-invalid @enderror" value="{{ isset($user) ? $user->local_phone : old('local_phone') }}">
                                                            @error('local_phone')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row">
                                                    <div class="col-12">
                                                        <a href="#" class="btn btn-secondary">{{ __('lang.' . strtoupper('Cancel')) }}</a>
                                                        <button type="submit" class="btn btn-success float-right add-payment-item">{{ __('lang.' . strtoupper('Submit')) }}</button>
                                                    </div>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.nav-tabs-custom -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection
