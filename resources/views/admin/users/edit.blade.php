@extends('admin.layouts.backend')

@section('content')
    <?php $user_addresses = $user->addresses->where('status', 'Primary')->first(); //dd($user_addresses); ?>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <div class="card card-primary card-outline ">
                        <div class="card-body">
                            <div class="btn-group">
                            </div>
                            <a href="{{ url()->previous() }}" class="btn btn-warning float-right"><i class="fa fa-reply"></i></a>
                        </div>
                    </div>

                    <div class="card card-info card-outline user_information {{ ((Session::get('_old_input') !== null and Session::get('_old_input')['form_level'] == 'user_information') || Session::get('level') == 'user_information') ? '' : ((Session::get('_old_input') !== null and Session::get('_old_input')['form_level'] == '') && Session::get('level') == '' ? '' : 'collapsed-card') }}">
                        <div class="card-header" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <h3 class="card-title">{{ __('lang.' . strtoupper('user_information')) }}</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-angle-double-{{ ((Session::get('_old_input') !== null and Session::get('_old_input')['form_level'] == 'user_information') || Session::get('level') == 'user_information') ? 'up' : ((Session::get('_old_input') !== null and Session::get('_old_input')['form_level'] == '') && Session::get('level') == '' ? 'up' : 'down') }}"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="{{ route('admin.users.update', $user->id) }}" class="client-form" method="POST">
                                        @csrf
                                        @method('PUT')
{{--                                        <input type="hidden" name="lead_id" value="{{ $user->lead_id }}">--}}
                                        <input type="hidden" name="address_id" value="{{ $user_addresses->id }}">
                                        <input type="hidden" name="form_level" value="user_information">

                                        <div class="row">

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="marketer_id" class="control-label">
                                                        <span class="req text-danger">* {{ __('lang.' . strtoupper('Marketer')) }}</span>
                                                    </label>
                                                    <select name="marketer_id" class="selectpicker @error('marketer_id') is-invalid @enderror" data-width="100%" data-placeholder="{{ __('lang.' . strtoupper('no_selected_item')) }}" required>
                                                        <option value="0">{{ __('lang.' . strtoupper('no_marketer')) }}</option>
                                                        @foreach ($marketers as $marketer)
                                                            <option value="{{ $marketer->id }}" {{ $marketer->id == $user->marketer_id ? 'selected' : '' }}>{{ $marketer->first_name . ' ' . $marketer->last_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @if($errors->has('marketer_id'))
                                                        <span class="help-block text-danger text-bold" role="alert">
                                                        {{ $errors->first('marketer_id') }}
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>

{{--                                            @if(in_array($_auth->roles->pluck('name')->first(), array('Super User', 'Management')) and ($user_role != 'Super User') and ($user->id != $_auth->id))--}}
{{--                                            <div class="col-md-3">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="role" class="control-label"><span class="req text-danger">* </span>{{ __('lang.' . strtoupper('role')) }}</label>--}}
{{--                                                    <select name="role" class="selectpicker @error('role') is-invalid @enderror" data-width="100%" data-placeholder="{{ __('lang.' . strtoupper('no_selected_item')) }}" required>--}}
{{--                                                        <option value=""></option>--}}
{{--                                                        @foreach ($roles as $role)--}}
{{--                                                            <option value="{{ $role->name }}" {{ !empty($user_role) && $role->name == $user_role ? 'selected' : '' }} >{{ __('lang.' . strtoupper($role->name)) }}</option>--}}
{{--                                                        @endforeach--}}
{{--                                                    </select>--}}
{{--                                                    @if($errors->has('role'))--}}
{{--                                                        <span class="help-block text-danger text-bold" role="alert">--}}
{{--                                                            {{ $errors->first('role') }}--}}
{{--                                                        </span>--}}
{{--                                                    @endif--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            @endif--}}

{{--                                            <div class="col-md-3">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="lead_id" class="control-label">{{ __('lang.' . strtoupper('Leader')) }}</label>--}}
{{--                                                    <select name="lead_id" class="selectpicker @error('lead_id') is-invalid @enderror" data-width="100%" data-placeholder="{{ __('lang.' . strtoupper('no_selected_item')) }}">--}}
{{--                                                        <option value="0">{{ __('lang.' . strtoupper('no_leader')) }}</option>--}}
{{--                                                        @foreach ($leaders as $leader)--}}
{{--                                                            <option value="{{ $leader->id }}" {{ $leader->id == $user->lead_id ? 'selected' : '' }}>{{ $leader->first_name . ' ' . $leader->last_name }}</option>--}}
{{--                                                        @endforeach--}}
{{--                                                    </select>--}}
{{--                                                    @if($errors->has('lead_id'))--}}
{{--                                                        <span class="help-block text-danger text-bold" role="alert">--}}
{{--                                                        {{ $errors->first('lead_id') }}--}}
{{--                                                    </span>--}}
{{--                                                    @endif--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
                                        </div>
                                        <hr class="bg-info">

                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="first_name" class="control-label">
                                                        <span class="req text-danger">* {{ __('lang.' . strtoupper('first_name')) }}</span>
                                                    </label>
                                                    <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{ $user->first_name }}" required>
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
                                                    <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{ $user->last_name }}" required>
                                                    @error('last_name')
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
                                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ $user->email }}" required>
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
                                                    <input type="text" name="mobile" class="form-control @error('mobile') is-invalid @enderror" value="{{ $user->mobile }}" required>
                                                    @error('mobile')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="phone" class="control-label">{{ __('lang.' . strtoupper('phone')) }}</label>
                                                    <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ $user->phone }}">
                                                    @error('phone')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="customer_group" class="control-label">{{ __('lang.' . strtoupper('customer_group')) }}</label>
                                                    <select name="customer_group" class="selectpicker @error('customer_group') is-invalid @enderror"  data-width="100%" data-placeholder="{{ __('lang.' . strtoupper('no_selected_item')) }}">
                                                        <option value=""></option>
                                                        @foreach ($customer_groups as $customer_group)
                                                            <option value="{{ $customer_group->name_en }}" {{ $customer_group->name_en == $user->customer_group ? 'selected' : '' }} >{{ __('lang.' . strtoupper(implode('_', explode(' ', $customer_group->name_en)))) }}</option>
                                                        @endforeach
                                                    </select>
                                                    @if($errors->has('customer_group'))
                                                        <span class="help-block text-danger text-bold" role="alert">
                                                            {{ $errors->first('customer_group') }}
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="subscription_code" class="control-label">{{ __('lang.' . strtoupper('subscription_code')) }}</label>
                                                    <input type="text" name="subscription_code" class="form-control @error('subscription_code') is-invalid @enderror" value="{{ $user->subscription_code }}">
                                                    @error('subscription_code')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>


{{--                                            </div>--}}

{{--                                            <div class="row">--}}

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="tax_number" class="control-label">{{ __('lang.' . strtoupper('tax_number')) }}</label>
                                                    <input type="text" name="tax_number" class="form-control @error('tax_number') is-invalid @enderror" value="{{ $user->tax_number }}">
                                                    @error('tax_number')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>




                                        </div>
                                        <hr class="bg-info">

                                        <div class="row">
                                            <div class="col-md-12">
                                                <strong>{{ __('lang.' . strtoupper('billing_address')) }}</strong>
                                                <hr class="bg-info">

                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="country" class="control-label ">
                                                                <span class="req text-danger">* {{ __('lang.' . strtoupper('Country')) }}</span>
                                                            </label>
                                                            <select name="country" class="selectpicker @error('country') is-invalid @enderror" data-placeholder="{{ __('lang.' . strtoupper('no_selected_item')) }}" data-width="100%" data-live-search="true" required>
                                                                <option value=""></option>
                                                                @foreach ($countries as $country)
                                                                    <option value="{{ $country->id }}" {{ $user_addresses->country == $country->id ? 'selected' : '' }}>{{ app()->getLocale() == 'en' ? $country->name_en : $country->name_fa }}</option>
                                                                @endforeach
                                                            </select>
                                                            @if($errors->has('country'))
                                                                <span class="help-block text-danger text-bold" role="alert">
                                                                    {{ $errors->first('country') }}
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="province" class="control-label">
                                                                <span class="req text-danger">* {{ __('lang.' . strtoupper('Province')) }}</span>
                                                            </label>
                                                            <select name="province" class="selectpicker @error('province') is-invalid @enderror" data-placeholder="{{ __('lang.' . strtoupper('no_selected_item')) }}" data-width="100%" data-live-search="true" required>
                                                                <option value=""></option>
                                                                @foreach ($provinces as $province)
                                                                    <option value="{{ $province->id }}" {{ $user_addresses->province == $province->id ? 'selected' : '' }}>{{ app()->getLocale() == 'en' ? $province->name_en : $province->name_fa }}</option>
                                                                @endforeach
                                                            </select>
                                                            @if($errors->has('province'))
                                                                <span class="help-block text-danger text-bold" role="alert">
                                                                    {{ $errors->first('province') }}
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="county" class="control-label">{{ __('lang.' . strtoupper('County')) }}</label>
                                                            <select name="county" class="selectpicker @error('county') is-invalid @enderror" data-placeholder="{{ __('lang.' . strtoupper('no_selected_item')) }}" data-width="100%" data-live-search="true">
                                                                <option value=""></option>
                                                                @foreach ($counties as $county)
                                                                    <option value="{{ $county->id }}" {{ $user_addresses->county == $county->id ? 'selected' : '' }}>{{ app()->getLocale() == 'en' ? $county->name_en : $county->name_fa }}</option>
                                                                @endforeach
                                                            </select>
                                                            @if($errors->has('county'))
                                                                <span class="help-block text-danger text-bold" role="alert">
                                                                    {{ $errors->first('county') }}
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="section" class="control-label">{{ __('lang.' . strtoupper('Section')) }}</label>
                                                            <select name="section" class="selectpicker @error('section') is-invalid @enderror" data-placeholder="{{ __('lang.' . strtoupper('no_selected_item')) }}" data-width="100%" data-live-search="true">
                                                                <option value=""></option>
                                                                @foreach ($sections as $section)
                                                                    <option value="{{ $section->id }}" {{ $user_addresses->section == $section->id ? 'selected' : '' }}>{{ app()->getLocale() == 'en' ? $section->name_en : $section->name_fa }}</option>
                                                                @endforeach
                                                            </select>
                                                            @if($errors->has('section'))
                                                                <span class="help-block text-danger text-bold" role="alert">
                                                                    {{ $errors->first('section') }}
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="city" class="control-label">{{ __('lang.' . strtoupper('City')) }}</label>
                                                            <select name="city" class="selectpicker @error('city') is-invalid @enderror" data-placeholder="{{ __('lang.' . strtoupper('no_selected_item')) }}" data-width="100%" data-live-search="true">
                                                                <option value=""></option>
                                                                @foreach ($cities as $city)
                                                                    <option value="{{ $city->id }}" {{ $user_addresses->city == $city->id ? 'selected' : '' }}>{{ app()->getLocale() == 'en' ? $city->name_en : $city->name_fa }}</option>
                                                                @endforeach
                                                            </select>
                                                            @if($errors->has('city'))
                                                                <span class="help-block text-danger text-bold" role="alert">
                                                                    {{ $errors->first('city') }}
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="zip_code" class="control-label">{{ __('lang.' . strtoupper('ZIP_CODE')) }}</label>
                                                            <input type="text" name="zip_code" class="form-control @error('zip_code') is-invalid @enderror" value="{{ $user_addresses->zip_code }}">
                                                            @error('zip_code')
                                                            <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="longitude" class="control-label">{{ __('lang.' . strtoupper('Longitude')) }}</label>
                                                            <input type="text" name="longitude" class="form-control @error('longitude') is-invalid @enderror" value="{{ $user_addresses->longitude }}">
                                                            @error('longitude')
                                                            <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="latitude" class="control-label">{{ __('lang.' . strtoupper('Latitude')) }}</label>
                                                            <input type="text" name="latitude" class="form-control @error('latitude') is-invalid @enderror" value="{{ $user_addresses->latitude }}">
                                                            @error('latitude')
                                                            <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="address" class="control-label">{{ __('lang.' . strtoupper('Address')) }}</label>
                                                            <textarea name="address" cols="30" rows="7" class="form-control @error('address') is-invalid @enderror">{{ $user_addresses->address }}</textarea>
                                                            @error('address')
                                                            <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

{{--                                            <div class="col-md-6">--}}
{{--                                                <strong>{{ __('lang.' . strtoupper('shipping_address')) }}</strong>--}}
{{--                                                <hr class="bg-info">--}}

{{--                                                <div class="row">--}}
{{--                                                    <div class="col-md-6">--}}
{{--                                                        <div class="form-group">--}}
{{--                                                            <label for="shipping_country" class="control-label ">{{ __('lang.' . strtoupper('Country')) }}</label>--}}
{{--                                                            <select name="shipping_country" class="selectpicker @error('shipping_country') is-invalid @enderror" data-placeholder="{{ __('lang.' . strtoupper('no_selected_item')) }}" data-width="100%" data-live-search="true">--}}
{{--                                                                <option value=""></option>--}}
{{--                                                                @foreach ($countries as $country)--}}
{{--                                                                    <option value="{{ $country->id }}" {{ $user_addresses->shipping_country == $country->id ? 'selected' : '' }}>{{ app()->getLocale() == 'en' ? $country->name_en : $country->name_fa }}</option>--}}
{{--                                                                @endforeach--}}
{{--                                                            </select>--}}
{{--                                                            @if($errors->has('shipping_country'))--}}
{{--                                                                <span class="help-block text-danger text-bold" role="alert">--}}
{{--                                                                    {{ $errors->first('shipping_country') }}--}}
{{--                                                                </span>--}}
{{--                                                            @endif--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}

{{--                                                    <div class="col-md-6">--}}
{{--                                                        <div class="form-group">--}}
{{--                                                            <label for="shipping_province" class="control-label">{{ __('lang.' . strtoupper('Province')) }}</label>--}}
{{--                                                            <select name="shipping_province" class="selectpicker @error('shipping_province') is-invalid @enderror" data-placeholder="{{ __('lang.' . strtoupper('no_selected_item')) }}" data-width="100%" data-live-search="true">--}}
{{--                                                                <option value=""></option>--}}
{{--                                                                @foreach ($provinces as $province)--}}
{{--                                                                    <option value="{{ $province->id }}" {{ $user_addresses->shipping_province == $province->id ? 'selected' : '' }}>{{ app()->getLocale() == 'en' ? $province->name_en : $province->name_fa }}</option>--}}
{{--                                                                @endforeach--}}
{{--                                                            </select>--}}
{{--                                                            @if($errors->has('shipping_province'))--}}
{{--                                                                <span class="help-block text-danger text-bold" role="alert">--}}
{{--                                                                    {{ $errors->first('shipping_province') }}--}}
{{--                                                                </span>--}}
{{--                                                            @endif--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}

{{--                                                    <div class="col-md-6">--}}
{{--                                                        <div class="form-group">--}}
{{--                                                            <label for="shipping_county" class="control-label">{{ __('lang.' . strtoupper('County')) }}</label>--}}
{{--                                                            <select name="shipping_county" class="selectpicker @error('shipping_county') is-invalid @enderror" data-placeholder="{{ __('lang.' . strtoupper('no_selected_item')) }}" data-width="100%" data-live-search="true">--}}
{{--                                                                <option value=""></option>--}}
{{--                                                                @foreach ($counties as $county)--}}
{{--                                                                    <option value="{{ $county->id }}" {{ $user_addresses->shipping_county == $county->id ? 'selected' : '' }}>{{ app()->getLocale() == 'en' ? $county->name_en : $county->name_fa }}</option>--}}
{{--                                                                @endforeach--}}
{{--                                                            </select>--}}
{{--                                                            @if($errors->has('shipping_county'))--}}
{{--                                                                <span class="help-block text-danger text-bold" role="alert">--}}
{{--                                                                    {{ $errors->first('shipping_county') }}--}}
{{--                                                                </span>--}}
{{--                                                            @endif--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}

{{--                                                    <div class="col-md-6">--}}
{{--                                                        <div class="form-group">--}}
{{--                                                            <label for="shipping_section" class="control-label">{{ __('lang.' . strtoupper('Section')) }}</label>--}}
{{--                                                            <select name="shipping_section" class="selectpicker @error('shipping_section') is-invalid @enderror" data-placeholder="{{ __('lang.' . strtoupper('no_selected_item')) }}" data-width="100%" data-live-search="true">--}}
{{--                                                                <option value=""></option>--}}
{{--                                                                @foreach ($sections as $section)--}}
{{--                                                                    <option value="{{ $section->id }}" {{ $user_addresses->shipping_section == $section->id ? 'selected' : '' }}>{{ app()->getLocale() == 'en' ? $section->name_en : $section->name_fa }}</option>--}}
{{--                                                                @endforeach--}}
{{--                                                            </select>--}}
{{--                                                            @if($errors->has('shipping_section'))--}}
{{--                                                                <span class="help-block text-danger text-bold" role="alert">--}}
{{--                                                                    {{ $errors->first('shipping_section') }}--}}
{{--                                                                </span>--}}
{{--                                                            @endif--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}

{{--                                                    <div class="col-md-6">--}}
{{--                                                        <div class="form-group">--}}
{{--                                                            <label for="shipping_city" class="control-label">{{ __('lang.' . strtoupper('City')) }}</label>--}}
{{--                                                            <select name="shipping_city" class="selectpicker @error('shipping_city') is-invalid @enderror" data-placeholder="{{ __('lang.' . strtoupper('no_selected_item')) }}" data-width="100%" data-live-search="true">--}}
{{--                                                                <option value=""></option>--}}
{{--                                                                @foreach ($cities as $city)--}}
{{--                                                                    <option value="{{ $city->id }}" {{ $user_addresses->shipping_city == $city->id ? 'selected' : '' }}>{{ app()->getLocale() == 'en' ? $city->name_en : $city->name_fa }}</option>--}}
{{--                                                                @endforeach--}}
{{--                                                            </select>--}}
{{--                                                            @if($errors->has('shipping_city'))--}}
{{--                                                                <span class="help-block text-danger text-bold" role="alert">--}}
{{--                                                                    {{ $errors->first('shipping_city') }}--}}
{{--                                                                </span>--}}
{{--                                                            @endif--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}

{{--                                                    <div class="col-md-6">--}}
{{--                                                        <div class="form-group">--}}
{{--                                                            <label for="shipping_zip_code" class="control-label">{{ __('lang.' . strtoupper('ZIP_CODE')) }}</label>--}}
{{--                                                            <input type="text" name="shipping_zip_code" class="form-control @error('shipping_zip_code') is-invalid @enderror" value="{{ $user_addresses->shipping_zip_code }}">--}}
{{--                                                            @error('shipping_zip_code')--}}
{{--                                                            <span class="invalid-feedback" role="alert">--}}
{{--                                                            <strong>{{ $message }}</strong>--}}
{{--                                                        </span>--}}
{{--                                                            @enderror--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}

{{--                                                    <div class="col-md-12">--}}
{{--                                                        <div class="form-group">--}}
{{--                                                            <label for="shipping_address" class="control-label">{{ __('lang.' . strtoupper('Address')) }}</label>--}}
{{--                                                            <textarea name="shipping_address" cols="30" rows="7" class="form-control @error('shipping_address') is-invalid @enderror">{{ $user_addresses->shipping_address }}</textarea>--}}
{{--                                                            @error('shipping_address')--}}
{{--                                                            <span class="invalid-feedback" role="alert">--}}
{{--                                                            <strong>{{ $message }}</strong>--}}
{{--                                                        </span>--}}
{{--                                                            @enderror--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}

{{--                                                    <div class="col-md-6">--}}
{{--                                                        <div class="form-group">--}}
{{--                                                            <label for="shipping_longitude" class="control-label">{{ __('lang.' . strtoupper('Longitude')) }}</label>--}}
{{--                                                            <input type="text" name="shipping_longitude" class="form-control @error('shipping_longitude') is-invalid @enderror" value="{{ $user_addresses->shipping_longitude }}">--}}
{{--                                                            @error('shipping_longitude')--}}
{{--                                                            <span class="invalid-feedback" role="alert">--}}
{{--                                                        <strong>{{ $message }}</strong>--}}
{{--                                                    </span>--}}
{{--                                                            @enderror--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}

{{--                                                    <div class="col-md-6">--}}
{{--                                                        <div class="form-group">--}}
{{--                                                            <label for="shipping_latitude" class="control-label">{{ __('lang.' . strtoupper('Latitude')) }}</label>--}}
{{--                                                            <input type="text" name="shipping_latitude" class="form-control @error('shipping_latitude') is-invalid @enderror" value="{{ $user_addresses->shipping_latitude }}">--}}
{{--                                                            @error('shipping_latitude')--}}
{{--                                                            <span class="invalid-feedback" role="alert">--}}
{{--                                                            <strong>{{ $message }}</strong>--}}
{{--                                                        </span>--}}
{{--                                                            @enderror--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}

{{--                                                </div>--}}
{{--                                            </div>--}}
                                        </div>
                                        <hr class="bg-info">

{{--                                        <div class="row">--}}
{{--                                            <div class="col-md-12">--}}
{{--                                                <button type="submit" class="btn float-right btn-info add-payment-item">{{ __('lang.' . strtoupper('Submit') }}</button>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

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
                        <!-- /.card-body -->
                    </div>

                    <div class="card card-info card-outline bills {{ ((Session::get('_old_input') !== null and Session::get('_old_input')['form_level'] == 'bills') || Session::get('level') == 'bills') ? '' : ((Session::get('_old_input') !== null and Session::get('_old_input')['form_level'] == '') && Session::get('level') == '' ? '' : 'collapsed-card') }}">
                        <div class="card-header" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <h3 class="card-title">{{ __('lang.' . strtoupper('addresses')) }}</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-angle-double-{{ ((Session::get('_old_input') !== null and Session::get('_old_input')['form_level'] == 'bills') || Session::get('level') == 'bills') ? 'up' : ((Session::get('_old_input') !== null and Session::get('_old_input')['form_level'] == '') && Session::get('level') == '' ? 'up' : 'down') }}"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="widefat table table-striped text-center table-clients no-footer" data-table="data-table" id="">
                                        <thead>
                                        <tr>
                                            <th>{{ __('lang.' . strtoupper('#')) }}</th>
                                            <th>{{ __('lang.' . strtoupper('name_or_company_name')) }}</th>
                                            <th>{{ __('lang.' . strtoupper('email')) }}</th>
                                            <th>{{ __('lang.' . strtoupper('mobile')) }}</th>
                                            <th>{{ __('lang.' . strtoupper('phone_number')) }}</th>
{{--                                            <th>{{ __('lang.' . strtoupper('activated')) }}</th>--}}
{{--                                            <th>{{ __('lang.' . strtoupper('customer_group')) }}</th>--}}
{{--                                            <th>{{ __('lang.' . strtoupper('role')) }}</th>--}}
{{--                                            <th>{{ __('lang.' . strtoupper('subscription_code')) }}</th>--}}
{{--                                            <th>{{ __('lang.' . strtoupper('operations')) }}</th>--}}
                                        </tr>
                                        </thead>


                                        <tbody>
                                        @if ($addresses && count($addresses) > 0)
                                            @foreach ($addresses as $key=>$address)
                                                <tr>
                                                    <td>{{ ++$key }}</td>
                                                    <td>
                                                        @if(!in_array($user->roles->pluck('name')->first(), array('Super User', 'Management', 'Administrator'))
                                                        or (in_array($_auth->roles->pluck('name')->first(), array('Super User'))
                                                            and in_array($user->roles->pluck('name')->first(), array('Management', 'Administrator')))
                                                        or (in_array($_auth->roles->pluck('name')->first(), array('Management'))
                                                            and in_array($user->roles->pluck('name')->first(), array('Administrator')))
                                                        or ($user->id == $_auth->id))
{{--                                                            <a href="{{ route('admin.users.edit', $address->id) }}"><strong>{{ $address->first_name . ' ' . $address->last_name }}</strong></a>--}}
                                                            <strong>{{ $address->first_name . ' ' . $address->last_name }}</strong>
                                                        @else
                                                            <strong>{{ $address->first_name . ' ' . $address->last_name }}</strong>
                                                        @endif
                                                    </td>
                                                    <td class="email"><a href="mailto:{{ $address->email }}">{{ $address->email }}</a></td>
                                                    <td>{{ $address->mobile }}</td>
                                                    <td>{{ $address->phone_number }}</td>
{{--                                                    <td>--}}
{{--                                                        @if(!in_array($user->roles->pluck('name')->first(), array('Super User', 'Management', 'Administrator'))--}}
{{--                                                        or (in_array($_auth->roles->pluck('name')->first(), array('Super User'))--}}
{{--                                                            and in_array($user->roles->pluck('name')->first(), array('Management', 'Administrator')))--}}
{{--                                                        or (in_array($_auth->roles->pluck('name')->first(), array('Management'))--}}
{{--                                                            and in_array($user->roles->pluck('name')->first(), array('Administrator'))))--}}

{{--                                                            <div class="onoffswitch">--}}
{{--                                                                <input type="checkbox" name="customer_status" class="onoffswitch-checkbox" id="customer-{{ $address->id }}" {{ $address->activated == 'Yes' ? 'checked' : '' }}>--}}
{{--                                                                <label class="onoffswitch-label" for="customer-{{ $address->id }}"></label>--}}
{{--                                                            </div>--}}

{{--                                                        @endif--}}
{{--                                                    </td>--}}
{{--                                                    <td>--}}
{{--                                                        @if(empty($address->customer_group) || $address->customer_group == null)--}}
{{--                                                            <span class="label label-info mleft5 inline-block">{{ __("Doesn't have") }}</span>--}}
{{--                                                        @else--}}
{{--                                                            @foreach ($customer_groups as $customer_group)--}}
{{--                                                                @if($customer_group->name_en == $address->customer_group)--}}
{{--                                                                    <span class="label label-info mleft5 inline-block">{{ __('lang.' . strtoupper(implode('_', explode(' ', $customer_group->name_en)))) }}</span>--}}
{{--                                                                @endif--}}
{{--                                                            @endforeach--}}
{{--                                                        @endif--}}
{{--                                                    </td>--}}
{{--                                                    <td><span class="label label-warning">{{ __('lang.' . strtoupper($address->roles->pluck('name')->first())) }}</span></td>--}}
{{--                                                    <td><span>{{ $address->subscribtion_code }}</span></td>--}}

{{--                                                    <td>--}}
{{--                                                        <div>--}}
{{--                                                            <form action="{{ route('admin.users.destroy',$address->id) }}" method="POST">--}}
{{--                                                                <div class="btn-group">--}}
{{--                                                                    @if(!in_array($user->roles->pluck('name')->first(), array('Super User', 'Management', 'Administrator'))--}}
{{--                                                                    or (in_array($_auth->roles->pluck('name')->first(), array('Super User'))--}}
{{--                                                                        and in_array($user->roles->pluck('name')->first(), array('Management', 'Administrator')))--}}
{{--                                                                    or (in_array($_auth->roles->pluck('name')->first(), array('Management'))--}}
{{--                                                                        and in_array($user->roles->pluck('name')->first(), array('Administrator')))--}}
{{--                                                                    or ($user->id == $_auth->id))--}}

{{--                                                                        <a href="{{ route('admin.users.edit', $address->id) }}" class="btn btn-info"><i class="fas fa-edit"></i></a>--}}
{{--                                                                    @endif--}}

{{--                                                                    @if(!in_array($user->roles->pluck('name')->first(), array('Super User', 'Management', 'Administrator'))--}}
{{--                                                                    or (in_array($_auth->roles->pluck('name')->first(), array('Super User'))--}}
{{--                                                                        and in_array($user->roles->pluck('name')->first(), array('Management', 'Administrator')))--}}
{{--                                                                    or (in_array($_auth->roles->pluck('name')->first(), array('Management'))--}}
{{--                                                                        and in_array($user->roles->pluck('name')->first(), array('Administrator'))))--}}

{{--                                                                        @csrf--}}
{{--                                                                        @method('DELETE')--}}
{{--                                                                        <button type="submit" onclick="return confirm('آیا از حذف این آیتم مطمئن هستید؟');" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>--}}

{{--                                                                    @endif--}}
{{--                                                                </div>--}}
{{--                                                            </form>--}}
{{--                                                        </div>--}}
{{--                                                    </td>--}}
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>



                                        <tfoot>
                                        <tr>
                                            <th>{{ __('lang.' . strtoupper('#')) }}</th>
                                            <th>{{ __('lang.' . strtoupper('name_or_company_name')) }}</th>
                                            <th>{{ __('lang.' . strtoupper('email')) }}</th>
                                            <th>{{ __('lang.' . strtoupper('mobile')) }}</th>
                                            <th>{{ __('lang.' . strtoupper('phone_number')) }}</th>
{{--                                            <th>{{ __('lang.' . strtoupper('activated')) }}</th>--}}
{{--                                            <th>{{ __('lang.' . strtoupper('customer_group')) }}</th>--}}
{{--                                            <th>{{ __('lang.' . strtoupper('role')) }}</th>--}}
{{--                                            <th>{{ __('lang.' . strtoupper('subscription_code')) }}</th>--}}
{{--                                            <th>{{ __('lang.' . strtoupper('operations')) }}</th>--}}
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>

                        </div>
                        <!-- /.card-body -->
                    </div>

                    <div class="card card-info card-outline add_bill {{ ((Session::get('_old_input') !== null and Session::get('_old_input')['form_level'] == 'add_bill') || Session::get('level') == 'add_bill') ? '' : ((Session::get('_old_input') !== null and Session::get('_old_input')['form_level'] == '') && Session::get('level') == '' ? '' : 'collapsed-card') }}">
                        <div class="card-header" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <h3 class="card-title">{{ __('lang.' . strtoupper('add_address')) }}</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-angle-double-{{ ((Session::get('_old_input') !== null and Session::get('_old_input')['form_level'] == 'add_bill') || Session::get('level') == 'add_bill') ? 'up' : ((Session::get('_old_input') !== null and Session::get('_old_input')['form_level'] == '') && Session::get('level') == '' ? 'up' : 'down') }}"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-12">
                                    <form action="{{ route('admin.users.update', $user->id) }}" class="client-form" method="POST">
                                        @csrf
                                        <input type="hidden" name="lead_id" value="0">

                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="marketer_id" class="control-label"><span class="req text-danger">* {{ __('lang.' . strtoupper('Marketer')) }}</span></label>
                                                    <select name="marketer_id" class="selectpicker @error('marketer_id') is-invalid @enderror" data-width="100%" data-placeholder="{{ __('lang.' . strtoupper('no_selected_item')) }}" required>
                                                        <option value="0">{{ __('lang.' . strtoupper('no_marketer')) }}</option>
                                                        @foreach ($marketers as $marketer)
                                                            <option value="{{ $marketer->id }}">{{ $marketer->first_name . ' ' . $marketer->last_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @if($errors->has('marketer_id'))
                                                        <span class="help-block text-danger text-bold" role="alert">
                                                                    {{ $errors->first('marketer_id') }}
                                                                </span>
                                                    @endif
                                                </div>
                                            </div>

                                            {{--                                                    <div class="col-md-3">--}}
                                            {{--                                                        <div class="form-group">--}}
                                            {{--                                                            <label for="role" class="control-label"><span class="req text-danger">* </span>{{ __('lang.' . strtoupper('role')) }}</label>--}}
                                            {{--                                                            <select name="role" class="selectpicker @error('role') is-invalid @enderror" data-width="100%" data-placeholder="{{ __('lang.' . strtoupper('no_selected_item')) }}" required>--}}
                                            {{--                                                                <option value=""></option>--}}
                                            {{--                                                                @foreach ($roles as $role)--}}
                                            {{--                                                                    <option value="{{ $role->name }}">{{ __('lang.' . strtoupper($role->name)) }}</option>--}}
                                            {{--                                                                @endforeach--}}
                                            {{--                                                            </select>--}}
                                            {{--                                                            @if($errors->has('role'))--}}
                                            {{--                                                                <span class="help-block text-danger text-bold" role="alert">--}}
                                            {{--                                                                    {{ $errors->first('role') }}--}}
                                            {{--                                                                </span>--}}
                                            {{--                                                            @endif--}}
                                            {{--                                                        </div>--}}
                                            {{--                                                    </div>--}}

                                            {{--                                                    <div class="col-md-3">--}}
                                            {{--                                                        <div class="form-group">--}}
                                            {{--                                                            <label for="lead_id" class="control-label">{{ __('lang.' . strtoupper('Leader')) }}</label>--}}
                                            {{--                                                            <select name="lead_id" class="selectpicker @error('lead_id') is-invalid @enderror" data-width="100%" data-placeholder="{{ __('lang.' . strtoupper('no_selected_item')) }}">--}}
                                            {{--                                                                <option value="0">{{ __('lang.' . strtoupper('no_leader')) }}</option>--}}
                                            {{--                                                                @foreach ($leaders as $leader)--}}
                                            {{--                                                                    <option value="{{ $leader->id }}">{{ $leader->first_name . ' ' . $leader->last_name }}</option>--}}
                                            {{--                                                                @endforeach--}}
                                            {{--                                                            </select>--}}
                                            {{--                                                            @if($errors->has('lead_id'))--}}
                                            {{--                                                                <span class="help-block text-danger text-bold" role="alert">--}}
                                            {{--                                                                    {{ $errors->first('lead_id') }}--}}
                                            {{--                                                                </span>--}}
                                            {{--                                                            @endif--}}
                                            {{--                                                        </div>--}}
                                            {{--                                                    </div>--}}


                                        </div>
                                        <hr class="bg-info">

                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="first_name" class="control-label">
                                                        <span class="req text-danger">* {{ __('lang.' . strtoupper('first_name')) }}</span>
                                                    </label>
                                                    <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name') }}" required>
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
                                                    <input type="text" id="last_name" name="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name') }}" required>
                                                    @error('last_name')
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
                                                    <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
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
                                                    <input type="text" id="mobile" name="mobile" class="form-control @error('mobile') is-invalid @enderror" value="{{ old('mobile') }}" required>
                                                    @error('mobile')
                                                    <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="phone" class="control-label">{{ __('lang.' . strtoupper('Phone')) }}</label>
                                                    <input type="text" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}">
                                                    @error('phone')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="customer_group" class="control-label">{{ __('lang.' . strtoupper('customer_group')) }}</label>
                                                    <select name="customer_group" class="selectpicker @error('customer_group') is-invalid @enderror"  data-width="100%" data-placeholder="{{ __('lang.' . strtoupper('no_selected_item')) }}">
                                                        <option value=""></option>
                                                        @foreach ($customer_groups as $customer_group)
                                                            <option value="{{ $customer_group->name_en }}" {{ $customer_group->name_en == old('customer_group') ? 'selected' : '' }} >{{ __('lang.' . strtoupper(implode('_', explode(' ', $customer_group->name_en)))) }}</option>
                                                        @endforeach
                                                    </select>
                                                    @if($errors->has('customer_group'))
                                                        <span class="help-block text-danger text-bold" role="alert">
                                                                    {{ $errors->first('customer_group') }}
                                                                </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="subscription_code" class="control-label">{{ __('lang.' . strtoupper('subscription_code')) }}</label>
                                                    <input type="text" id="subscription_code" name="subscription_code" class="form-control @error('subscription_code') is-invalid @enderror" data-fieldto="customers" data-fieldid="13" value="{{ old('subscription_code') }}">
                                                    @error('subscription_code')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>




                                            {{--                                            </div>--}}

                                            {{--                                            <div class="row">--}}

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="tax_number" class="control-label">{{ __('lang.' . strtoupper('Tax_Number')) }}</label>
                                                    <input type="text" id="tax_number" name="tax_number" class="form-control @error('tax_number') is-invalid @enderror" value="{{ old('tax_number') }}">
                                                    @error('tax_number')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div>
                                        <hr class="bg-info">

                                        <div class="row">

                                            <div class="col-md-12">
                                                <strong>{{ __('lang.' . strtoupper('billing_address')) }}</strong>
                                                <hr class="bg-info">

                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="country" class="control-label ">
                                                                <span class="req text-danger">* {{ __('lang.' . strtoupper('Country')) }}</span>
                                                            </label>
                                                            <select id="country" name="country" class="selectpicker @error('country') is-invalid @enderror" data-placeholder="{{ __('lang.' . strtoupper('no_selected_item')) }}" data-width="100%" data-live-search="true" required>
                                                                <option value=""></option>
                                                                @foreach ($countries as $country)
                                                                    <option value="{{ $country->id }}" {{ old('country') == $country->id ? 'selected' : '' }}>{{ app()->getLocale() == 'en' ? $country->name_en : $country->name_fa }}</option>
                                                                @endforeach
                                                            </select>
                                                            @if($errors->has('country'))
                                                                <span class="help-block text-danger text-bold" role="alert">
                                                                            {{ $errors->first('country') }}
                                                                        </span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="province" class="control-label">
                                                                <span class="req text-danger">* {{ __('lang.' . strtoupper('Province')) }}</span>
                                                            </label>
                                                            <select id="province" name="province" class="selectpicker @error('province') is-invalid @enderror" data-placeholder="{{ __('lang.' . strtoupper('no_selected_item')) }}" data-width="100%" data-live-search="true" required>
                                                                <option value=""></option>
                                                                @foreach ($provinces as $province)
                                                                    <option value="{{ $province->id }}" {{ old('province') == $province->id ? 'selected' : '' }}>{{ app()->getLocale() == 'en' ? $province->name_en : $province->name_fa }}</option>
                                                                @endforeach
                                                            </select>
                                                            @if($errors->has('province'))
                                                                <span class="help-block text-danger text-bold" role="alert">
                                                                            {{ $errors->first('province') }}
                                                                        </span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="county" class="control-label">{{ __('lang.' . strtoupper('County')) }}</label>
                                                            <select id="county" name="county" class="selectpicker @error('county') is-invalid @enderror" data-placeholder="{{ __('lang.' . strtoupper('no_selected_item')) }}" data-width="100%" data-live-search="true">
                                                                <option value=""></option>
                                                                @foreach ($counties as $county)
                                                                    <option value="{{ $county->id }}" {{ old('county') == $county->id ? 'selected' : '' }}>{{ app()->getLocale() == 'en' ? $county->name_en : $county->name_fa }}</option>
                                                                @endforeach
                                                            </select>
                                                            @if($errors->has('county'))
                                                                <span class="help-block text-danger text-bold" role="alert">
                                                                            {{ $errors->first('county') }}
                                                                        </span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="section" class="control-label">{{ __('lang.' . strtoupper('Section')) }}</label>
                                                            <select id="section" name="section" class="selectpicker @error('section') is-invalid @enderror" data-placeholder="{{ __('lang.' . strtoupper('no_selected_item')) }}" data-width="100%" data-live-search="true">
                                                                <option value=""></option>
                                                                @foreach ($sections as $section)
                                                                    <option value="{{ $section->id }}" {{ old('section') == $section->id ? 'selected' : '' }}>{{ app()->getLocale() == 'en' ? $section->name_en : $section->name_fa }}</option>
                                                                @endforeach
                                                            </select>
                                                            @if($errors->has('section'))
                                                                <span class="help-block text-danger text-bold" role="alert">
                                                                            {{ $errors->first('section') }}
                                                                        </span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="city" class="control-label">{{ __('lang.' . strtoupper('City')) }}</label>
                                                            <select id="city" name="city" class="selectpicker @error('city') is-invalid @enderror" data-placeholder="{{ __('lang.' . strtoupper('no_selected_item')) }}" data-width="100%" data-live-search="true">
                                                                <option value=""></option>
                                                                @foreach ($cities as $city)
                                                                    <option value="{{ $city->id }}" {{ old('city') == $city->id ? 'selected' : '' }}>{{ app()->getLocale() == 'en' ? $city->name_en : $city->name_fa }}</option>
                                                                @endforeach
                                                            </select>
                                                            @if($errors->has('city'))
                                                                <span class="help-block text-danger text-bold" role="alert">
                                                                            {{ $errors->first('city') }}
                                                                        </span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="zip_code" class="control-label">{{ __('lang.' . strtoupper('ZIP_CODE')) }}</label>
                                                            <input type="text" id="zip_code" name="zip_code" class="form-control @error('zip_code') is-invalid @enderror" value="{{ old('zip_code') }}">
                                                            @error('zip_code')
                                                            <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="longitude" class="control-label">{{ __('lang.' . strtoupper('Longitude')) }}</label>
                                                            <input type="text" id="longitude" name="longitude" class="form-control @error('longitude') is-invalid @enderror" value="{{ old('longitude') }}">
                                                            @error('longitude')
                                                            <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="latitude" class="control-label">{{ __('lang.' . strtoupper('Latitude')) }}</label>
                                                            <input type="text" id="latitude" name="latitude" class="form-control @error('latitude') is-invalid @enderror" value="{{ old('latitude') }}">
                                                            @error('latitude')
                                                            <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="address" class="control-label">{{ __('lang.' . strtoupper('Address')) }}</label>
                                                            <textarea name="address" id="address" cols="30" rows="7" class="form-control @error('address') is-invalid @enderror">{{ old('address') }}</textarea>
                                                            @error('address')
                                                            <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                            {{--                                                    <div class="col-md-6">--}}
                                            {{--                                                        <strong>{{ __('lang.' . strtoupper('shipping_address')) }}</strong>--}}
                                            {{--                                                        <hr class="bg-info">--}}

                                            {{--                                                        <div class="row">--}}
                                            {{--                                                            <div class="col-md-6">--}}
                                            {{--                                                                <div class="form-group">--}}
                                            {{--                                                                    <label for="shipping_country" class="control-label ">{{ __('lang.' . strtoupper('Country')) }}</label>--}}
                                            {{--                                                                    <select id="shipping_country" name="shipping_country" class="selectpicker @error('shipping_country') is-invalid @enderror" data-placeholder="{{ __('lang.' . strtoupper('no_selected_item')) }}" data-width="100%" data-live-search="true">--}}
                                            {{--                                                                        <option value=""></option>--}}
                                            {{--                                                                        @foreach ($countries as $country)--}}
                                            {{--                                                                            <option value="{{ $country->id }}" {{ old('shipping_country') == $country->id ? 'selected' : '' }}>{{ app()->getLocale() == 'en' ? $country->name_en : $country->name_fa }}</option>--}}
                                            {{--                                                                        @endforeach--}}
                                            {{--                                                                    </select>--}}
                                            {{--                                                                    @if($errors->has('shipping_country'))--}}
                                            {{--                                                                        <span class="help-block text-danger text-bold" role="alert">--}}
                                            {{--                                                                            {{ $errors->first('shipping_country') }}--}}
                                            {{--                                                                        </span>--}}
                                            {{--                                                                    @endif--}}
                                            {{--                                                                </div>--}}
                                            {{--                                                            </div>--}}

                                            {{--                                                            <div class="col-md-6">--}}
                                            {{--                                                                <div class="form-group">--}}
                                            {{--                                                                    <label for="shipping_province" class="control-label">{{ __('lang.' . strtoupper('Province')) }}</label>--}}
                                            {{--                                                                    <select id="shipping_province" name="shipping_province" class="selectpicker @error('shipping_province') is-invalid @enderror" data-placeholder="{{ __('lang.' . strtoupper('no_selected_item')) }}" data-width="100%" data-live-search="true">--}}
                                            {{--                                                                        <option value=""></option>--}}
                                            {{--                                                                        @foreach ($provinces as $province)--}}
                                            {{--                                                                            <option value="{{ $province->id }}" {{ old('shipping_province') == $province->id ? 'selected' : '' }}>{{ app()->getLocale() == 'en' ? $province->name_en : $province->name_fa }}</option>--}}
                                            {{--                                                                        @endforeach--}}
                                            {{--                                                                    </select>--}}
                                            {{--                                                                    @if($errors->has('shipping_province'))--}}
                                            {{--                                                                        <span class="help-block text-danger text-bold" role="alert">--}}
                                            {{--                                                                            {{ $errors->first('shipping_province') }}--}}
                                            {{--                                                                        </span>--}}
                                            {{--                                                                    @endif--}}
                                            {{--                                                                </div>--}}
                                            {{--                                                            </div>--}}

                                            {{--                                                            <div class="col-md-6">--}}
                                            {{--                                                                <div class="form-group">--}}
                                            {{--                                                                    <label for="shipping_county" class="control-label">{{ __('lang.' . strtoupper('County')) }}</label>--}}
                                            {{--                                                                    <select id="shipping_county" name="shipping_county" class="selectpicker @error('shipping_county') is-invalid @enderror" data-placeholder="{{ __('lang.' . strtoupper('no_selected_item')) }}" data-width="100%" data-live-search="true">--}}
                                            {{--                                                                        <option value=""></option>--}}
                                            {{--                                                                        @foreach ($counties as $county)--}}
                                            {{--                                                                            <option value="{{ $county->id }}" {{ old('shipping_county') == $county->id ? 'selected' : '' }}>{{ app()->getLocale() == 'en' ? $county->name_en : $county->name_fa }}</option>--}}
                                            {{--                                                                        @endforeach--}}
                                            {{--                                                                    </select>--}}
                                            {{--                                                                    @if($errors->has('shipping_county'))--}}
                                            {{--                                                                        <span class="help-block text-danger text-bold" role="alert">--}}
                                            {{--                                                                            {{ $errors->first('shipping_county') }}--}}
                                            {{--                                                                        </span>--}}
                                            {{--                                                                    @endif--}}
                                            {{--                                                                </div>--}}
                                            {{--                                                            </div>--}}

                                            {{--                                                            <div class="col-md-6">--}}
                                            {{--                                                                <div class="form-group">--}}
                                            {{--                                                                    <label for="shipping_section" class="control-label">{{ __('lang.' . strtoupper('Section')) }}</label>--}}
                                            {{--                                                                    <select id="shipping_section" name="shipping_section" class="selectpicker @error('shipping_section') is-invalid @enderror" data-placeholder="{{ __('lang.' . strtoupper('no_selected_item')) }}" data-width="100%" data-live-search="true">--}}
                                            {{--                                                                        <option value=""></option>--}}
                                            {{--                                                                        @foreach ($sections as $section)--}}
                                            {{--                                                                            <option value="{{ $section->id }}" {{ old('shipping_section') == $section->id ? 'selected' : '' }}>{{ app()->getLocale() == 'en' ? $section->name_en : $section->name_fa }}</option>--}}
                                            {{--                                                                        @endforeach--}}
                                            {{--                                                                    </select>--}}
                                            {{--                                                                    @if($errors->has('shipping_section'))--}}
                                            {{--                                                                        <span class="help-block text-danger text-bold" role="alert">--}}
                                            {{--                                                                            {{ $errors->first('shipping_section') }}--}}
                                            {{--                                                                        </span>--}}
                                            {{--                                                                    @endif--}}
                                            {{--                                                                </div>--}}
                                            {{--                                                            </div>--}}

                                            {{--                                                            <div class="col-md-6">--}}
                                            {{--                                                                <div class="form-group">--}}
                                            {{--                                                                    <label for="shipping_city" class="control-label">{{ __('lang.' . strtoupper('City')) }}</label>--}}
                                            {{--                                                                    <select id="shipping_city" name="shipping_city" class="selectpicker @error('shipping_city') is-invalid @enderror" data-placeholder="{{ __('lang.' . strtoupper('no_selected_item')) }}" data-width="100%" data-live-search="true">--}}
                                            {{--                                                                        <option value=""></option>--}}
                                            {{--                                                                        @foreach ($cities as $city)--}}
                                            {{--                                                                            <option value="{{ $city->id }}" {{ old('shipping_city') == $city->id ? 'selected' : '' }}>{{ app()->getLocale() == 'en' ? $city->name_en : $city->name_fa }}</option>--}}
                                            {{--                                                                        @endforeach--}}
                                            {{--                                                                    </select>--}}
                                            {{--                                                                    @if($errors->has('shipping_city'))--}}
                                            {{--                                                                        <span class="help-block text-danger text-bold" role="alert">--}}
                                            {{--                                                                            {{ $errors->first('shipping_city') }}--}}
                                            {{--                                                                        </span>--}}
                                            {{--                                                                    @endif--}}
                                            {{--                                                                </div>--}}
                                            {{--                                                            </div>--}}

                                            {{--                                                            <div class="col-md-6">--}}
                                            {{--                                                                <div class="form-group">--}}
                                            {{--                                                                    <label for="shipping_zip_code" class="control-label">{{ __('lang.' . strtoupper('ZIP_CODE')) }}</label>--}}
                                            {{--                                                                    <input type="text" id="shipping_zip_code" name="shipping_zip_code" class="form-control @error('shipping_zip_code') is-invalid @enderror" value="{{ old('shipping_zip_code') }}">--}}
                                            {{--                                                                    @error('shipping_zip_code')--}}
                                            {{--                                                                    <span class="invalid-feedback" role="alert">--}}
                                            {{--                                                            <strong>{{ $message }}</strong>--}}
                                            {{--                                                        </span>--}}
                                            {{--                                                                    @enderror--}}
                                            {{--                                                                </div>--}}
                                            {{--                                                            </div>--}}

                                            {{--                                                            <div class="col-md-12">--}}
                                            {{--                                                                <div class="form-group">--}}
                                            {{--                                                                    <label for="shipping_address" class="control-label">{{ __('lang.' . strtoupper('Address')) }}</label>--}}
                                            {{--                                                                    <textarea name="shipping_address" id="shipping_address" cols="30" rows="7" class="form-control @error('shipping_address') is-invalid @enderror">{{ old('shipping_address') }}</textarea>--}}
                                            {{--                                                                    @error('shipping_address')--}}
                                            {{--                                                                    <span class="invalid-feedback" role="alert">--}}
                                            {{--                                                            <strong>{{ $message }}</strong>--}}
                                            {{--                                                        </span>--}}
                                            {{--                                                                    @enderror--}}
                                            {{--                                                                </div>--}}
                                            {{--                                                            </div>--}}

                                            {{--                                                            <div class="col-md-6">--}}
                                            {{--                                                                <div class="form-group">--}}
                                            {{--                                                                    <label for="shipping_longitude" class="control-label">{{ __('lang.' . strtoupper('Longitude')) }}</label>--}}
                                            {{--                                                                    <input type="text" id="shipping_longitude" name="shipping_longitude" class="form-control @error('shipping_longitude') is-invalid @enderror" value="{{ old('shipping_longitude') }}">--}}
                                            {{--                                                                    @error('shipping_longitude')--}}
                                            {{--                                                                    <span class="invalid-feedback" role="alert">--}}
                                            {{--                                                        <strong>{{ $message }}</strong>--}}
                                            {{--                                                    </span>--}}
                                            {{--                                                                    @enderror--}}
                                            {{--                                                                </div>--}}
                                            {{--                                                            </div>--}}

                                            {{--                                                            <div class="col-md-6">--}}
                                            {{--                                                                <div class="form-group">--}}
                                            {{--                                                                    <label for="shipping_latitude" class="control-label">{{ __('lang.' . strtoupper('Latitude')) }}</label>--}}
                                            {{--                                                                    <input type="text" id="shipping_latitude" name="shipping_latitude" class="form-control @error('shipping_latitude') is-invalid @enderror" value="{{ old('shipping_latitude') }}">--}}
                                            {{--                                                                    @error('shipping_latitude')--}}
                                            {{--                                                                    <span class="invalid-feedback" role="alert">--}}
                                            {{--                                                            <strong>{{ $message }}</strong>--}}
                                            {{--                                                        </span>--}}
                                            {{--                                                                    @enderror--}}
                                            {{--                                                                </div>--}}
                                            {{--                                                            </div>--}}

                                            {{--                                                        </div>--}}
                                            {{--                                                    </div>--}}

                                        </div>
                                        <hr class="bg-info">

                                        {{--                                                <div class="row">--}}
                                        {{--                                                    <div class="col-md-12">--}}
                                        {{--                                                        <button type="submit" class="btn float-right btn-info add-payment-item">{{ __('lang.' . strtoupper('Submit')) }}</button>--}}
                                        {{--                                                    </div>--}}
                                        {{--                                                </div>--}}

                                        <div class="row">
                                            <div class="col-12">
                                                <a href="#" class="btn btn-secondary">{{ __('lang.' . strtoupper('Cancel')) }}</a>
                                                <button type="submit" class="btn btn-success float-right add-payment-item">{{ __('lang.' . strtoupper('Submit')) }}</button>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>


                            {{--                            <div class="row">--}}
{{--                                <div class="col-md-12">--}}
{{--                                    <form action="{{ route('admin.users.store') }}" class="client-form" method="POST">--}}
{{--                                        @csrf--}}
{{--                                        <input type="hidden" name="lead_id" value="{{ $user->id }}">--}}
{{--                                        <input type="hidden" name="form_level" value="add_bill">--}}

{{--                                        <div class="row">--}}
{{--                                            <div class="col-md-3">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="role" class="control-label"><span class="req text-danger">* </span>{{ __('lang.' . strtoupper('role')) }}</label>--}}
{{--                                                    <select name="role" class="selectpicker @error('role') is-invalid @enderror" data-width="100%" data-placeholder="{{ __('lang.' . strtoupper('no_selected_item')) }}">--}}
{{--                                                        <option value=""></option>--}}
{{--                                                        @foreach ($roles as $role)--}}
{{--                                                            <option value="{{ $role->name }}">{{ __('lang.' . strtoupper($role->name)) }}</option>--}}
{{--                                                        @endforeach--}}
{{--                                                    </select>--}}
{{--                                                    @if($errors->has('role'))--}}
{{--                                                        <span class="help-block text-danger text-bold" role="alert">--}}
{{--                                                            {{ $errors->first('role') }}--}}
{{--                                                        </span>--}}
{{--                                                    @endif--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <hr class="bg-info">--}}

{{--                                        <div class="row">--}}
{{--                                            <div class="col-md-3">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="first_name" class="control-label">--}}
{{--                                                        <span class="req text-danger">* </span>{{ __('lang.' . strtoupper('first_name')) }}--}}
{{--                                                    </label>--}}
{{--                                                    <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name') }}" required>--}}
{{--                                                    @error('first_name')--}}
{{--                                                    <span class="invalid-feedback" role="alert">--}}
{{--                                                        <strong>{{ $message }}</strong>--}}
{{--                                                    </span>--}}
{{--                                                    @enderror--}}
{{--                                                </div>--}}
{{--                                            </div>--}}

{{--                                            <div class="col-md-3">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="last_name" class="control-label">--}}
{{--                                                        <span class="req text-danger">* </span>{{ __('lang.' . strtoupper('last_name')) }}--}}
{{--                                                    </label>--}}
{{--                                                    <input type="text" id="last_name" name="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name') }}" required>--}}
{{--                                                    @error('last_name')--}}
{{--                                                    <span class="invalid-feedback" role="alert">--}}
{{--                                                        <strong>{{ $message }}</strong>--}}
{{--                                                    </span>--}}
{{--                                                    @enderror--}}
{{--                                                </div>--}}
{{--                                            </div>--}}

{{--                                            <div class="col-md-3">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="subscription_code" class="control-label">{{ __('lang.' . strtoupper('subscription_code')) }}</label>--}}
{{--                                                    <input type="text" id="subscription_code" name="subscription_code" class="form-control @error('subscription_code') is-invalid @enderror" data-fieldto="customers" data-fieldid="13" value="{{ old('subscription_code') }}">--}}
{{--                                                    @error('subscription_code')--}}
{{--                                                    <span class="invalid-feedback" role="alert">--}}
{{--                                                        <strong>{{ $message }}</strong>--}}
{{--                                                    </span>--}}
{{--                                                    @enderror--}}
{{--                                                </div>--}}
{{--                                            </div>--}}


{{--                                            --}}{{--                                            </div>--}}

{{--                                            --}}{{--                                            <div class="row">--}}

{{--                                            <div class="col-md-3">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="tax_number" class="control-label">{{ __('lang.' . strtoupper('tax_number')) }}</label>--}}
{{--                                                    <input type="text" id="tax_number" name="tax_number" class="form-control @error('tax_number') is-invalid @enderror" value="{{ old('tax_number') }}">--}}
{{--                                                    @error('tax_number')--}}
{{--                                                    <span class="invalid-feedback" role="alert">--}}
{{--                                                        <strong>{{ $message }}</strong>--}}
{{--                                                    </span>--}}
{{--                                                    @enderror--}}
{{--                                                </div>--}}
{{--                                            </div>--}}

{{--                                            <div class="col-md-3">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="email" class="control-label"><span class="req text-danger">* </span>{{ __('lang.' . strtoupper('email')) }}</label>--}}
{{--                                                    <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>--}}
{{--                                                    @error('email')--}}
{{--                                                    <span class="invalid-feedback" role="alert">--}}
{{--                                                        <strong>{{ $message }}</strong>--}}
{{--                                                    </span>--}}
{{--                                                    @enderror--}}
{{--                                                </div>--}}
{{--                                            </div>--}}

{{--                                            <div class="col-md-3">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="phone" class="control-label">{{ __('lang.' . strtoupper('Phone')) }}</label>--}}
{{--                                                    <input type="text" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}">--}}
{{--                                                    @error('phone')--}}
{{--                                                    <span class="invalid-feedback" role="alert">--}}
{{--                                                        <strong>{{ $message }}</strong>--}}
{{--                                                    </span>--}}
{{--                                                    @enderror--}}
{{--                                                </div>--}}
{{--                                            </div>--}}

{{--                                            <div class="col-md-3">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="mobile" class="control-label"><span class="req text-danger">* </span>{{ __('lang.' . strtoupper('Mobile')) }}</label>--}}
{{--                                                    <input type="text" id="mobile" name="mobile" class="form-control @error('mobile') is-invalid @enderror" value="{{ old('mobile') }}" required>--}}
{{--                                                    @error('mobile')--}}
{{--                                                    <span class="invalid-feedback" role="alert">--}}
{{--                                                        <strong>{{ $message }}</strong>--}}
{{--                                                    </span>--}}
{{--                                                    @enderror--}}
{{--                                                </div>--}}
{{--                                            </div>--}}

{{--                                            <div class="col-md-3">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="customer_group" class="control-label">{{ __('lang.' . strtoupper('customer_group')) }}</label>--}}
{{--                                                    <select name="customer_group" class="selectpicker @error('customer_group') is-invalid @enderror"  data-width="100%" data-placeholder="{{ __('lang.' . strtoupper('no_selected_item')) }}">--}}
{{--                                                        <option value=""></option>--}}
{{--                                                        @foreach ($customer_groups as $customer_group)--}}
{{--                                                            <option value="{{ $customer_group->name_en }}" {{ $customer_group->name_en == old('customer_group') ? 'selected' : '' }} >{{ __('lang.' . strtoupper(implode('_', explode(' ', $customer_group->name_en)))) }}</option>--}}
{{--                                                        @endforeach--}}
{{--                                                    </select>--}}
{{--                                                    @if($errors->has('customer_group'))--}}
{{--                                                        <span class="help-block text-danger text-bold" role="alert">--}}
{{--                                                            {{ $errors->first('customer_group') }}--}}
{{--                                                        </span>--}}
{{--                                                    @endif--}}
{{--                                                </div>--}}
{{--                                            </div>--}}

{{--                                        </div>--}}
{{--                                        <hr class="bg-info">--}}

{{--                                        <div class="row">--}}

{{--                                            <div class="col-md-6">--}}
{{--                                                <strong>{{ __('lang.' . strtoupper('billing_address')) }}</strong>--}}
{{--                                                <hr class="bg-info">--}}

{{--                                                <div class="row">--}}
{{--                                                    <div class="col-md-6">--}}
{{--                                                        <div class="form-group">--}}
{{--                                                            <label for="billing_country" class="control-label ">{{ __('lang.' . strtoupper('Country')) }}</label>--}}
{{--                                                            <select id="billing_country" name="billing_country" class="selectpicker @error('billing_country') is-invalid @enderror" data-placeholder="{{ __('lang.' . strtoupper('no_selected_item')) }}" data-width="100%" data-live-search="true">--}}
{{--                                                                <option value=""></option>--}}
{{--                                                                @foreach ($countries as $country)--}}
{{--                                                                    <option value="{{ $country->id }}" {{ old('billing_country') == $country->id ? 'selected' : '' }}>{{ app()->getLocale() == 'en' ? $country->name_en : $country->name_fa }}</option>--}}
{{--                                                                @endforeach--}}
{{--                                                            </select>--}}
{{--                                                            @if($errors->has('billing_country'))--}}
{{--                                                                <span class="help-block text-danger text-bold" role="alert">--}}
{{--                                                                    {{ $errors->first('billing_country') }}--}}
{{--                                                                </span>--}}
{{--                                                            @endif--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}

{{--                                                    <div class="col-md-6">--}}
{{--                                                        <div class="form-group">--}}
{{--                                                            <label for="billing_province" class="control-label">{{ __('lang.' . strtoupper('Province')) }}</label>--}}
{{--                                                            <select id="billing_province" name="billing_province" class="selectpicker @error('billing_province') is-invalid @enderror" data-placeholder="{{ __('lang.' . strtoupper('no_selected_item')) }}" data-width="100%" data-live-search="true">--}}
{{--                                                                <option value=""></option>--}}
{{--                                                                @foreach ($provinces as $province)--}}
{{--                                                                    <option value="{{ $province->id }}" {{ old('billing_province') == $province->id ? 'selected' : '' }}>{{ app()->getLocale() == 'en' ? $province->name_en : $province->name_fa }}</option>--}}
{{--                                                                @endforeach--}}
{{--                                                            </select>--}}
{{--                                                            @if($errors->has('billing_province'))--}}
{{--                                                                <span class="help-block text-danger text-bold" role="alert">--}}
{{--                                                                    {{ $errors->first('billing_province') }}--}}
{{--                                                                </span>--}}
{{--                                                            @endif--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}

{{--                                                    <div class="col-md-6">--}}
{{--                                                        <div class="form-group">--}}
{{--                                                            <label for="billing_county" class="control-label">{{ __('lang.' . strtoupper('County')) }}</label>--}}
{{--                                                            <select id="billing_county" name="billing_county" class="selectpicker @error('billing_county') is-invalid @enderror" data-placeholder="{{ __('lang.' . strtoupper('no_selected_item')) }}" data-width="100%" data-live-search="true">--}}
{{--                                                                <option value=""></option>--}}
{{--                                                                @foreach ($counties as $county)--}}
{{--                                                                    <option value="{{ $county->id }}" {{ old('billing_county') == $county->id ? 'selected' : '' }}>{{ app()->getLocale() == 'en' ? $county->name_en : $county->name_fa }}</option>--}}
{{--                                                                @endforeach--}}
{{--                                                            </select>--}}
{{--                                                            @if($errors->has('billing_county'))--}}
{{--                                                                <span class="help-block text-danger text-bold" role="alert">--}}
{{--                                                                    {{ $errors->first('billing_county') }}--}}
{{--                                                                </span>--}}
{{--                                                            @endif--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}

{{--                                                    <div class="col-md-6">--}}
{{--                                                        <div class="form-group">--}}
{{--                                                            <label for="billing_section" class="control-label">{{ __('lang.' . strtoupper('Section')) }}</label>--}}
{{--                                                            <select id="billing_section" name="billing_section" class="selectpicker @error('billing_section') is-invalid @enderror" data-placeholder="{{ __('lang.' . strtoupper('no_selected_item')) }}" data-width="100%" data-live-search="true">--}}
{{--                                                                <option value=""></option>--}}
{{--                                                                @foreach ($sections as $section)--}}
{{--                                                                    <option value="{{ $section->id }}" {{ old('billing_section') == $section->id ? 'selected' : '' }}>{{ app()->getLocale() == 'en' ? $section->name_en : $section->name_fa }}</option>--}}
{{--                                                                @endforeach--}}
{{--                                                            </select>--}}
{{--                                                            @if($errors->has('billing_section'))--}}
{{--                                                                <span class="help-block text-danger text-bold" role="alert">--}}
{{--                                                                    {{ $errors->first('billing_section') }}--}}
{{--                                                                </span>--}}
{{--                                                            @endif--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}

{{--                                                    <div class="col-md-6">--}}
{{--                                                        <div class="form-group">--}}
{{--                                                            <label for="billing_city" class="control-label">{{ __('lang.' . strtoupper('City')) }}</label>--}}
{{--                                                            <select id="billing_city" name="billing_city" class="selectpicker @error('billing_city') is-invalid @enderror" data-placeholder="{{ __('lang.' . strtoupper('no_selected_item')) }}" data-width="100%" data-live-search="true">--}}
{{--                                                                <option value=""></option>--}}
{{--                                                                @foreach ($cities as $city)--}}
{{--                                                                    <option value="{{ $city->id }}" {{ old('billing_city') == $city->id ? 'selected' : '' }}>{{ app()->getLocale() == 'en' ? $city->name_en : $city->name_fa }}</option>--}}
{{--                                                                @endforeach--}}
{{--                                                            </select>--}}
{{--                                                            @if($errors->has('billing_city'))--}}
{{--                                                                <span class="help-block text-danger text-bold" role="alert">--}}
{{--                                                                    {{ $errors->first('billing_city') }}--}}
{{--                                                                </span>--}}
{{--                                                            @endif--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}

{{--                                                    <div class="col-md-6">--}}
{{--                                                        <div class="form-group">--}}
{{--                                                            <label for="billing_zip_code" class="control-label">{{ __('lang.' . strtoupper('ZIP_CODE')) }}</label>--}}
{{--                                                            <input type="text" id="billing_zip_code" name="billing_zip_code" class="form-control @error('billing_zip_code') is-invalid @enderror" value="{{ old('billing_zip_code') }}">--}}
{{--                                                            @error('billing_zip_code')--}}
{{--                                                            <span class="invalid-feedback" role="alert">--}}
{{--                                                            <strong>{{ $message }}</strong>--}}
{{--                                                        </span>--}}
{{--                                                            @enderror--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}

{{--                                                    <div class="col-md-12">--}}
{{--                                                        <div class="form-group">--}}
{{--                                                            <label for="billing_address" class="control-label">{{ __('lang.' . strtoupper('Address')) }}</label>--}}
{{--                                                            <textarea name="billing_address" id="billing_address" cols="30" rows="7" class="form-control @error('billing_address') is-invalid @enderror">{{ old('billing_address') }}</textarea>--}}
{{--                                                            @error('billing_address')--}}
{{--                                                            <span class="invalid-feedback" role="alert">--}}
{{--                                                            <strong>{{ $message }}</strong>--}}
{{--                                                        </span>--}}
{{--                                                            @enderror--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}

{{--                                                    <div class="col-md-6">--}}
{{--                                                        <div class="form-group">--}}
{{--                                                            <label for="billing_longitude" class="control-label">{{ __('lang.' . strtoupper('Longitude')) }}</label>--}}
{{--                                                            <input type="text" id="billing_longitude" name="billing_longitude" class="form-control @error('billing_longitude') is-invalid @enderror" value="{{ old('billing_longitude') }}">--}}
{{--                                                            @error('billing_longitude')--}}
{{--                                                            <span class="invalid-feedback" role="alert">--}}
{{--                                                        <strong>{{ $message }}</strong>--}}
{{--                                                    </span>--}}
{{--                                                            @enderror--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}

{{--                                                    <div class="col-md-6">--}}
{{--                                                        <div class="form-group">--}}
{{--                                                            <label for="billing_latitude" class="control-label" style="width:100%">{{ __('lang.' . strtoupper('Latitude')) }}</label>--}}
{{--                                                            <input type="text" id="billing_latitude" name="billing_latitude" class="form-control @error('billing_latitude') is-invalid @enderror" value="{{ old('billing_latitude') }}">--}}
{{--                                                            @error('billing_latitude')--}}
{{--                                                            <span class="invalid-feedback" role="alert">--}}
{{--                                                            <strong>{{ $message }}</strong>--}}
{{--                                                        </span>--}}
{{--                                                            @enderror--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}

{{--                                                </div>--}}
{{--                                            </div>--}}

{{--                                            <div class="col-md-6">--}}
{{--                                                <strong>{{ __('lang.' . strtoupper('shipping_address')) }}</strong>--}}
{{--                                                <hr class="bg-info">--}}

{{--                                                <div class="row">--}}
{{--                                                    <div class="col-md-6">--}}
{{--                                                        <div class="form-group">--}}
{{--                                                            <label for="shipping_country" class="control-label ">{{ __('lang.' . strtoupper('Country')) }}</label>--}}
{{--                                                            <select id="shipping_country" name="shipping_country" class="selectpicker @error('shipping_country') is-invalid @enderror" data-placeholder="{{ __('lang.' . strtoupper('no_selected_item')) }}" data-width="100%" data-live-search="true">--}}
{{--                                                                <option value=""></option>--}}
{{--                                                                @foreach ($countries as $country)--}}
{{--                                                                    <option value="{{ $country->id }}" {{ old('shipping_country') == $country->id ? 'selected' : '' }}>{{ app()->getLocale() == 'en' ? $country->name_en : $country->name_fa }}</option>--}}
{{--                                                                @endforeach--}}
{{--                                                            </select>--}}
{{--                                                            @if($errors->has('shipping_country'))--}}
{{--                                                                <span class="help-block text-danger text-bold" role="alert">--}}
{{--                                                                    {{ $errors->first('shipping_country') }}--}}
{{--                                                                </span>--}}
{{--                                                            @endif--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}

{{--                                                    <div class="col-md-6">--}}
{{--                                                        <div class="form-group">--}}
{{--                                                            <label for="shipping_province" class="control-label">{{ __('lang.' . strtoupper('Province')) }}</label>--}}
{{--                                                            <select id="shipping_province" name="shipping_province" class="selectpicker @error('shipping_province') is-invalid @enderror" data-placeholder="{{ __('lang.' . strtoupper('no_selected_item')) }}" data-width="100%" data-live-search="true">--}}
{{--                                                                <option value=""></option>--}}
{{--                                                                @foreach ($provinces as $province)--}}
{{--                                                                    <option value="{{ $province->id }}" {{ old('shipping_province') == $province->id ? 'selected' : '' }}>{{ app()->getLocale() == 'en' ? $province->name_en : $province->name_fa }}</option>--}}
{{--                                                                @endforeach--}}
{{--                                                            </select>--}}
{{--                                                            @if($errors->has('shipping_province'))--}}
{{--                                                                <span class="help-block text-danger text-bold" role="alert">--}}
{{--                                                                    {{ $errors->first('shipping_province') }}--}}
{{--                                                                </span>--}}
{{--                                                            @endif--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}

{{--                                                    <div class="col-md-6">--}}
{{--                                                        <div class="form-group">--}}
{{--                                                            <label for="shipping_county" class="control-label">{{ __('lang.' . strtoupper('County')) }}</label>--}}
{{--                                                            <select id="shipping_county" name="shipping_county" class="selectpicker @error('shipping_county') is-invalid @enderror" data-placeholder="{{ __('lang.' . strtoupper('no_selected_item')) }}" data-width="100%" data-live-search="true">--}}
{{--                                                                <option value=""></option>--}}
{{--                                                                @foreach ($counties as $county)--}}
{{--                                                                    <option value="{{ $county->id }}" {{ old('shipping_county') == $county->id ? 'selected' : '' }}>{{ app()->getLocale() == 'en' ? $county->name_en : $county->name_fa }}</option>--}}
{{--                                                                @endforeach--}}
{{--                                                            </select>--}}
{{--                                                            @if($errors->has('shipping_county'))--}}
{{--                                                                <span class="help-block text-danger text-bold" role="alert">--}}
{{--                                                                    {{ $errors->first('shipping_county') }}--}}
{{--                                                                </span>--}}
{{--                                                            @endif--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}

{{--                                                    <div class="col-md-6">--}}
{{--                                                        <div class="form-group">--}}
{{--                                                            <label for="shipping_section" class="control-label">{{ __('lang.' . strtoupper('Section')) }}</label>--}}
{{--                                                            <select id="shipping_section" name="shipping_section" class="selectpicker @error('shipping_section') is-invalid @enderror" data-placeholder="{{ __('lang.' . strtoupper('no_selected_item')) }}" data-width="100%" data-live-search="true">--}}
{{--                                                                <option value=""></option>--}}
{{--                                                                @foreach ($sections as $section)--}}
{{--                                                                    <option value="{{ $section->id }}" {{ old('shipping_section') == $section->id ? 'selected' : '' }}>{{ app()->getLocale() == 'en' ? $section->name_en : $section->name_fa }}</option>--}}
{{--                                                                @endforeach--}}
{{--                                                            </select>--}}
{{--                                                            @if($errors->has('shipping_section'))--}}
{{--                                                                <span class="help-block text-danger text-bold" role="alert">--}}
{{--                                                                    {{ $errors->first('shipping_section') }}--}}
{{--                                                                </span>--}}
{{--                                                            @endif--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}

{{--                                                    <div class="col-md-6">--}}
{{--                                                        <div class="form-group">--}}
{{--                                                            <label for="shipping_city" class="control-label">{{ __('lang.' . strtoupper('City')) }}</label>--}}
{{--                                                            <select id="shipping_city" name="shipping_city" class="selectpicker @error('shipping_city') is-invalid @enderror" data-placeholder="{{ __('lang.' . strtoupper('no_selected_item')) }}" data-width="100%" data-live-search="true">--}}
{{--                                                                <option value=""></option>--}}
{{--                                                                @foreach ($cities as $city)--}}
{{--                                                                    <option value="{{ $city->id }}" {{ old('shipping_city') == $city->id ? 'selected' : '' }}>{{ app()->getLocale() == 'en' ? $city->name_en : $city->name_fa }}</option>--}}
{{--                                                                @endforeach--}}
{{--                                                            </select>--}}
{{--                                                            @if($errors->has('shipping_city'))--}}
{{--                                                                <span class="help-block text-danger text-bold" role="alert">--}}
{{--                                                                    {{ $errors->first('shipping_city') }}--}}
{{--                                                                </span>--}}
{{--                                                            @endif--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}

{{--                                                    <div class="col-md-6">--}}
{{--                                                        <div class="form-group">--}}
{{--                                                            <label for="shipping_zip_code" class="control-label" style="width:100%">{{ __('lang.' . strtoupper('ZIP_CODE')) }}</label>--}}
{{--                                                            <input type="text" id="shipping_zip_code" name="shipping_zip_code" class="form-control @error('shipping_zip_code') is-invalid @enderror" value="{{ old('shipping_zip_code') }}">--}}
{{--                                                            @error('shipping_zip_code')--}}
{{--                                                            <span class="invalid-feedback" role="alert">--}}
{{--                                                            <strong>{{ $message }}</strong>--}}
{{--                                                        </span>--}}
{{--                                                            @enderror--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}

{{--                                                    <div class="col-md-12">--}}
{{--                                                        <div class="form-group">--}}
{{--                                                            <label for="shipping_address" class="control-label" style="width:100%">{{ __('lang.' . strtoupper('Address')) }}</label>--}}
{{--                                                            <textarea name="shipping_address" id="shipping_address" cols="30" rows="7" class="form-control @error('shipping_address') is-invalid @enderror">{{ old('shipping_address') }}</textarea>--}}
{{--                                                            @error('shipping_address')--}}
{{--                                                            <span class="invalid-feedback" role="alert">--}}
{{--                                                            <strong>{{ $message }}</strong>--}}
{{--                                                        </span>--}}
{{--                                                            @enderror--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}

{{--                                                    <div class="col-md-6">--}}
{{--                                                        <div class="form-group">--}}
{{--                                                            <label for="shipping_longitude" class="control-label" style="width:100%">{{ __('lang.' . strtoupper('Longitude')) }}</label>--}}
{{--                                                            <input type="text" id="shipping_longitude" name="shipping_longitude" class="form-control @error('shipping_longitude') is-invalid @enderror" value="{{ old('shipping_longitude') }}">--}}
{{--                                                            @error('shipping_longitude')--}}
{{--                                                            <span class="invalid-feedback" role="alert">--}}
{{--                                                        <strong>{{ $message }}</strong>--}}
{{--                                                    </span>--}}
{{--                                                            @enderror--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}

{{--                                                    <div class="col-md-6">--}}
{{--                                                        <div class="form-group">--}}
{{--                                                            <label for="shipping_latitude" class="control-label" style="width:100%">{{ __('lang.' . strtoupper('Latitude')) }}</label>--}}
{{--                                                            <input type="text" id="shipping_latitude" name="shipping_latitude" class="form-control @error('shipping_latitude') is-invalid @enderror" value="{{ old('shipping_latitude') }}">--}}
{{--                                                            @error('shipping_latitude')--}}
{{--                                                            <span class="invalid-feedback" role="alert">--}}
{{--                                                            <strong>{{ $message }}</strong>--}}
{{--                                                        </span>--}}
{{--                                                            @enderror--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}

{{--                                                </div>--}}
{{--                                            </div>--}}

{{--                                        </div>--}}
{{--                                        <hr class="bg-info">--}}

{{--                                        <div class="row">--}}
{{--                                            <div class="col-md-12">--}}
{{--                                                <button type="submit" class="btn float-right btn-info add-payment-item">{{ __('lang.' . strtoupper('Submit') }}</button>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

{{--                                        <div class="row">--}}
{{--                                            <div class="col-12">--}}
{{--                                                <a href="#" class="btn btn-secondary">{{ __('lang.' . strtoupper('Cancel')) }}</a>--}}
{{--                                                <button type="submit" class="btn btn-success float-right add-payment-item">{{ __('lang.' . strtoupper('Submit')) }}</button>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

{{--                                    </form>--}}
{{--                                </div>--}}
{{--                            </div>--}}




                        </div>
                        <!-- /.card-body -->
                    </div>

                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection
