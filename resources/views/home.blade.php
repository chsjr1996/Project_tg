@extends('layouts.home')

@section('content')

{{--  Include sidebar  --}}
@include('layouts.sidebar')

{{--  Include navbar  --}}
@include('layouts.navbar')

<home-posts></home-posts>

@endsection
