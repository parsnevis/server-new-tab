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

                    <div class="card card-info card-outline">
                    <!-- /.card-header -->
                        <div class="card-body">
                            <div id="settings">
                                <div class="tab-content">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form action="{{ route('admin.users.store') }}" class="client-form" method="POST">
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
