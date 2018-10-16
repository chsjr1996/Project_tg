@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Users list') }}</div>

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
                                @foreach($users as $user)
                                    <tr>
                                        <td>
                                            <a href="#" class="btn  btn-default btn-sm">{{ __('Edit') }}</a>
                                            <a href="#" class="btn  btn-default btn-sm">{{ __('Delete') }}</a>
                                        </td>
                                        <td>{{ $user->user_id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td class="text-info">{{ $user->email }}</td>
                                        <td>{{ $user->user_type_id }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
