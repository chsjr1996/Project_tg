@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('setup.Profile') }}</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success custom-css close-alert" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="row">
                        {!! 
                            Form::open(
                                [
                                    'class'  => 'col-sm-12',
                                    'url'    => 'user/setup',
                                    'method' => 'post',
                                    'files'  => true
                                ]
                            ) 
                        !!}

                            <div class="form-group mb-lg-5">

                                {!! Form::label("user_photo", __('setup.ProfilePhoto'), ['class' => 'col-sm-12']) !!}

                                @if (Auth::user()->user_photo && file_exists(public_path('avatars/' . Auth::user()->user_photo)))

                                    <div class="col-md-12 mb-lg-3">
                                        <div class="custom-css adjust-img-profile">
                                            <img src="{{ asset('avatars')}}/{{Auth::user()->user_photo}}" alt="" class="img-thumbnail" />
                                        </div>
                                    </div>
                                    
                                @endif

                                {!! Form::file("user_photo", ['class' => 'col-sm-12']) !!}
                            </div>

                            <div class="form-group">

                                {!! Form::label("", __("setup.EmailAddress"), ['class' => 'col-sm-12']) !!}

                                {!! Form::label("", Auth::user()->email, ['class' => 'col-sm-12 text-info']) !!}

                            </div>

                            <div class="form-group col-sm-12">

                                {!! Form::label("name", __('setup.Name')) !!}

                                {!! Form::text("name", Auth::user()->name, ['class' => $errors->has('name') ? 'form-control is-invalid' : 'form-control']) !!}

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>
                                            {{ $errors->first('name') }}
                                        </strong>
                                    </span>
                                @endif

                            </div>
                            
                            <div class="col-sm-12">

                                {!! Form::submit(__('setup.Confirm'), ['class' => 'btn btn-primary']) !!}

                            </div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
