@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Business Search Map</div>
                <div class="container">
                    <br/>
                    <div class="col-md-12">
                        @if (Session::has('info'))
                        <div class="clearfix"></div>
                        <div class="alert alert-info" role="alert">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {!! Session::get('info') !!}
                        </div>
                        @endif

                        @if (Session::has('success'))
                        <div class="clearfix"></div>
                        <div class="alert alert-success" role="alert">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {!! Session::get('success') !!}
                        </div>
                        @endif

                        @if (Session::has('warning'))
                        <div class="clearfix"></div>
                        <div class="alert alert-warning" role="alert">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {!! Session::get('warning') !!}
                        </div>
                        @endif

                        @if (Session::has('error'))
                        <div class="clearfix"></div>
                        <div class="alert alert-danger" role="alert">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {!! Session::get('error') !!}
                        </div>
                        @endif

                        @if ($errors->any())
                        <div class="clearfix"></div>
                            <div class="alert alert-danger" role="alert">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('business_result_map') }}">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="business_name" class="col-md-12 col-form-label text-md-left"><strong>{{ __('Business Name :') }}</strong></label>
                                <div class="col-md-12">
                                    <input id="business_name" type="text" class="form-control{{ $errors->has('business_name') ? ' is-invalid' : '' }}" name="business_name" value="{{ old('business_name') }}">
    
                                    @if ($errors->has('business_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('business_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="building_number" class="col-md-12 col-form-label text-md-left"><strong>{{ __('Building Number :') }}<strong></label>
                                <div class="col-md-12">
                                    <input id="building_number" type="text" class="form-control{{ $errors->has('building_number') ? ' is-invalid' : '' }}" name="building_number" value="{{ old('building_number') }}">
    
                                    @if ($errors->has('building_number'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('building_number') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="latitude" class="col-md-12 col-form-label text-md-left"><strong>{{ __('Latitude :') }}</strong></label>
                                <div class="col-md-12">
                                    <input id="latitude" type="text" class="form-control{{ $errors->has('latitude') ? ' is-invalid' : '' }}" name="latitude" value="{{ old('latitude') }}">
    
                                    @if ($errors->has('latitude'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('latitude') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="longitude" class="col-md-12 col-form-label text-md-left"><strong>{{ __('Longitude :') }}<strong></label>
                                <div class="col-md-12">
                                    <input id="longitude" type="text" class="form-control{{ $errors->has('longitude') ? ' is-invalid' : '' }}" name="longitude" value="{{ old('longitude') }}">
    
                                    @if ($errors->has('longitude'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('longitude') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="lga" class="col-md-12 col-form-label text-md-left"><strong>{{ __('LGA :') }}</strong></label>
                                <div class="col-md-12">
                                    <select class="form-control" id="lga" name="lga">
                                        <option value="%%">All</option>
                                        @foreach($lga as $data)
                                        <option value="{{$data->lga}}">{{$data->lga}}</option>
                                        @endforeach
                                    </select>
    
                                    @if ($errors->has('lga'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('lga') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="ward" class="col-md-12 col-form-label text-md-left"><strong>{{ __('Ward :') }}<strong></label>
                                <div class="col-md-12">
                                    <select class="form-control" id="ward" name="ward">
                                        <option value="%%">All</option>
                                        @foreach($wards as $data)
                                        <option value="{{$data->ward}}">{{$data->ward}}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('ward'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('ward') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="street" class="col-md-12 col-form-label text-md-left"><strong>{{ __('Street :') }}</strong></label>
                                <div class="col-md-12">
                                    <select class="form-control" id="street" name="street">
                                        <option value="%%">All</option>
                                        @foreach($streets as $data)
                                        <option value="{{$data->street}}">{{$data->street}}</option>
                                        @endforeach
                                    </select>
    
                                    @if ($errors->has('street'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('street') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="users" class="col-md-12 col-form-label text-md-left"><strong>{{ __('Register By :') }}<strong></label>
                                <div class="col-md-12">
                                    <select class="form-control" id="ward" name="users">
                                        <option value="%%">All</option>
                                        @foreach($users as $data)
                                        <option value="{{$data->name}}">{{$data->name}}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('users'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('users') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="registered_on" class="col-md-12 col-form-label text-md-left"><strong>{{ __('Registered On :') }}</strong></label>
                                <div class="col-md-12">
                                    <input id="registered_on" type="date" class="form-control{{ $errors->has('registered_on') ? ' is-invalid' : '' }}" name="registered_on" value="{{ old('registered_on') }}">
    
                                    @if ($errors->has('registered_on'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('registered_on') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="registered_to" class="col-md-12 col-form-label text-md-left"><strong>{{ __('Registered To :') }}</strong></label>
                                <div class="col-md-12">
                                    <input id="registered_to" type="date" class="form-control{{ $errors->has('registered_to') ? ' is-invalid' : '' }}" name="registered_to" value="{{ old('registered_to') }}">
    
                                    @if ($errors->has('registered_to'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('registered_to') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <br/>
                        <div class="form-group row mb-0">
                            <div class="col-md-12" style="padding-left:30px;">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Search') }}
                                </button>
                            </div>
                        </div> 
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection