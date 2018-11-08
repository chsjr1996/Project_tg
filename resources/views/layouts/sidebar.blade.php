<div class="col-lg-2 col-md-3 col-12 px-1 bg-dark float-left fixed-top custom-css full-sidebar" id="sticky-sidebar">
    <div class="py-2 sticky-top">
        <div class="nav flex-column">

            {{-- Project Logo --}}
            <div class="row">
                <div class="col-12 text-center">
                    <a class="navbar-brand text-white" href="{{ url('/home') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>
            </div>

            {{--  Profile photo  --}}
            <div class="row mt-5">
                <div class="col-12">
                    <div class="text-center">
                        <div class="custom-css adjust-img-profile d-inline-block">
                            @if ($userData->photo && file_exists(public_path('avatars/' . $userData->photo)))
                            <img src="{{ asset('avatars')}}/{{$userData->photo}}" alt="" class="img-thumbnail" />
                            @else
                            <i class="img-thumbnail fa fa-camera-retro"></i>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
                
            {{--  User data  --}}
            <div class="mt-3">
                <p class="mb-0 text-center text-white">
                    {{ $userData->name }}
                </p>
            </div>

            {{--  Sidebar links  --}}
            <div class="row mt-3">
                <div class="col-12">
                    
                    @if ($view == 'profile')
                        <div class="row mb-2">
                            <div class="col-3 pl-4 text-center">
                                <i class="fa fa-book-open text-white"></i>
                            </div>
                            <div class="col-9">
                                <a href="" class="text-white">
                                    {{ __('home.About') }}
                                </a>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-3 pl-4 text-center">
                                <i class="fa fa-suitcase text-white"></i>
                            </div>
                            <div class="col-9">
                                <a href="" class="text-white">
                                    {{ __('home.Experience') }}
                                </a>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-3 pl-4 text-center">
                                <i class="fa fa-graduation-cap text-white"></i>
                            </div>
                            <div class="col-9">
                                <a href="" class="text-white">
                                    {{ __('home.Education') }}
                                </a>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-3 pl-4 text-center">
                                <i class="fa fa-clipboard-check text-white"></i>
                            </div>
                            <div class="col-9">
                                <a href="" class="text-white">
                                    {{ __('home.Skills') }}
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="row mb-2">
                            <div class="col-3 pl-4 text-center">
                                <i class="fa fa-user-alt text-white"></i>
                            </div>
                            <div class="col-9">
                                <a href="/profile" class="text-white">
                                    {{ __('home.Profile') }}
                                </a>
                            </div>
                        </div>
                    @endif

                    <hr class="bg-white ml-3 mr-3">
                    
                    @if ($view == 'home')

                        {{-- Admin --}}
                        @if ($view == 'home' && $userData->user_type == 1)
                            <div class="row mb-2">
                                <div class="col-3 pl-4 text-center">
                                    <i class="fa fa-user-tie text-white"></i>
                                </div>
                                <div class="col-9">
                                    <a class="text-white" href="{{ url('admin/users') }}">
                                        {{ __('home.Admin') }}
                                    </a>
                                </div>
                            </div>
                        @endif

                        {{-- Setup --}}
                        <div class="row mb-2">
                            <div class="col-3 pl-4 text-center">
                                <i class="fa fa-cog text-white"></i>
                            </div>
                            <div class="col-9">
                                <a class="text-white" href="{{ url('user/setup') }}">
                                    {{ __('Account Settings') }}
                                </a>
                            </div>
                        </div>

                        {{-- Logout --}}
                        <div class="row mb-2">
                            <div class="col-3 pl-4 text-center">
                                <i class="fa fa-door-open text-white"></i>
                            </div>
                            <div class="col-9">
                                <a class="text-white" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    @else
                        {{-- Back to home --}}
                        <div class="row mb-2">
                            <div class="col-3 pl-4 text-center">
                                <i class="fa fa-arrow-left text-white"></i>
                            </div>
                            <div class="col-9">
                                <a class="text-white" href="/home">{{ __('home.Back') }}</a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>