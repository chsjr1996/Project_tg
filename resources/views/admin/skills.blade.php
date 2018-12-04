@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-10 pt-2">
                            <strong>{{ __('Users list') }}</strong>
                            @if ($list->total() > 0)
                                <span class="text-info">
                                    &nbsp;<i class="fa fa-1x fa-caret-right"></i>
                                    {{ $list->total() }}
                                    @if ($list->total() > 1)
                                        registers
                                    @else
                                        register
                                    @endif
                                </span>
                            @endif
                        </div>
                        <div class="col-2 text-right">
                            <a href="{{ route("skills.new") }}" class="btn btn-dark border-dark m-0">
                                <i class="fa fa-plus"></i>
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
                        @if (count($list) > 0)
                            <table class="table">
                                <th>{{ __('actions') }}</th>
                                <th>{{ __('id') }}</th>
                                <th>{{ __('created at') }}</th>
                                <th>{{ __('title') }}</th>
                                <th>{{ __('rate') }}</th>
                                <tbody>
                                    @foreach($list as $skill)
                                        <tr>
                                            <td>
                                                <a href="#" class="btn  btn-default btn-sm">{{ __('Edit') }}</a>
                                                <a href="#" class="btn  btn-default btn-sm">{{ __('Delete') }}</a>
                                            </td>
                                            <td>{{ $skill->id }}</td>
                                            <td>{{ $skill->created_at }}</td>
                                            <td>{{ $skill->title }}</td>
                                            <td>{{ $skill->rate }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $list->links() }}
                        @else
                            <p class="text-center w-100">no results found</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
