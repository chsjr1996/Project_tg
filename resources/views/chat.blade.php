@extends('layouts.home')

@section('content')

{{--  Include sidebar  --}}
@include('layouts.sidebar')

{{--  Include navbar  --}}
@include('layouts.navbar')

<chat-screen :user="'{{ $receptor }}'"></chat-screen>

@endsection
