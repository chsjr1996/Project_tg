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
                                    <i class="fa fa-1x fa-caret-right"></i>
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
                            <p class="btn btn-dark border-dark m-0">{{ __('New') }}</p>
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
                        <table class="table">
                            <th>{{ __('actions') }}</th>
                            <th>{{ __('id') }}</th>
                            <th>{{ __('name') }}</th>
                            <th>{{ __('email') }}</th>
                            <th>{{ __('type') }}</th>
                            <tbody>
                                @foreach($list as $user)
                                    <tr>
                                        <td>
                                            <a href="#" class="btn btn-default btn-sm">{{ __('Edit') }}</a>
                                            <a href="#" class="btn btn-default btn-sm">{{ __('Delete') }}</a>
                                        </td>
                                        <td>{{ $user->user_id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td class="text-info">{{ $user->email }}</td>
                                        <td>{{ $user->user_type_id }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div>
                            {{ $list->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
