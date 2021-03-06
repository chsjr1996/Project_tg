@extends('layouts.home')

@section('content')

{{--  Include sidebar  --}}
@include('layouts.sidebar')

{{--  Include navbar  --}}
@include('layouts.navbar')

<profile-preview :id="'{{ $userData->id }}'"></profile-preview>

<chat-button :id="'{{ $userData->id }}'" :name="'{{ $userData->name }}'"></chat-button>

@endsection
