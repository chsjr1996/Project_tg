@extends('layouts.home')

@section('content')

{{--  Include sidebar  --}}
@include('layouts.sidebar')

{{--  Include navbar  --}}
@include('layouts.navbar')

<profile-grid :query="'{{ $query }}'"></profile-grid>

@endsection
