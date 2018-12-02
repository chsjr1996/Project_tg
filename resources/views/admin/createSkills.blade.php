@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-10 pt-2">
                            <strong>Create a new skill</strong>
                        </div>
                        <div class="col-2 text-right">
                            <a href="{{ route("skills.list") }}" class="btn btn-dark border-dark m-0">
                                <i class="fa fa-list"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    <div class="row">
                        {!! Form::open(['url' => 'admin/skills/create', 'class' => 'w-75']) !!}

                        <div class="form-group">
                            {!! Form::label('title', 'Title') !!}
                            {!! Form::input('text', 'title', null, ['class' => 'form-control', 'autofocus', 'placeholder' => 'Title']) !!}
                        </div>

                        {!! Form::submit('Save', ['class' => 'btn btn-primary ']) !!}

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
