<div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg order-lg-first">
                <ul class="nav nav-tabs border-0 flex-column flex-lg-row navbar-nav ml-auto">
                    <li class="nav-item">
                        <a href="{{route('home')}}" class="nav-link">Главная</a>
                    </li>
                    {{--<li class="nav-item">--}}
                        {{--<a href="" class="nav-link" data-toggle="dropdown">Потом придумаю</a>--}}
                    {{--</li>--}}
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Вход') }}</a>
                        </li>
                        <li class="nav-item">
                            @if (Route::has('register'))
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Регистрация') }}</a>
                            @endif
                        </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('my_review') }}">{{ __('Мои отзывы') }}</a>
                            </li>
                            <li class="nav-item ">
                                {{--{{ Auth::user()->name }} <span class="caret"></span>--}}
                                <a class="nav-link" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Выход') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </li>
                            @endguest
                        @if(Auth::check() && Auth::user()->isAdmin)
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('all_review') }}">Получить все отзывы</a>
                                </li>
                        @endif

                </ul>
            </div>
        </div>
    </div>
</div>