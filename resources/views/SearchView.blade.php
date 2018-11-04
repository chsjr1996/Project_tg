@extends('layouts.home')

@section('content')

{{--  Include sidebar  --}}
@include('layouts.sidebar')

{{--  Include navbar  --}}
@include('layouts.navbar')

<search-view></search-view>

@endsection
