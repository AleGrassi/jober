<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>@yield('titolo')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <!-- Fogli di stile -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ url('/') }}/css/@yield('stile')">
        <!-- jQuery e plugin JavaScript -->
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="{{ url('/') }}/js/myScript.js"></script>
    </head>

    <body>
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand brand-image" href="{{ route('offer.index') }}">
                    <img src="{{ asset('storage/img/jober.jpg') }}" class="brand-image" width="160px" alt="">
                </a>
                <button type="button" class="navbar-toggler navbar-light" data-bs-toggle="collapse" data-bs-target="#myNavbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        @yield('left_navbar')
                    </ul>
                    <ul class="navbar-nav navbar-right">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="i" role="button" data-bs-toggle="dropdown">
                                <img src="{{ asset('storage/img/flags/'.App::getLocale().'.png') }}" class="brand-image" width="16px" alt="">
                            </a>
                            <ul class="dropdown-menu flags-dropdown">
                                <li>
                                    <a class="dropdown-item" href="{{ route('lang.change',['lang'=>'it']) }}">
                                        <img src="{{ asset('storage/img/flags/it.png') }}" class="brand-image" width="16px" alt="">
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('lang.change',['lang'=>'en']) }}">
                                        <img src="{{ asset('storage/img/flags/en.png') }}" class="brand-image" width="16px" alt="">
                                    </a>
                                </li>
                            </ul>
                        </li>

                        @auth
                            @if(Auth::user()->user_type == 'worker' AND isset(Auth::user()->worker))
                                <li class="nav-item"><a class="nav-link" href="{{ route('worker.show', ['worker' => Auth::user()->worker->id]) }}"><i class="bi bi-person-circle"></i> {{ Auth::user()->name }}</a></li>
                            @elseif(Auth::user()->user_type == 'company' AND isset(Auth::user()->company))
                                <li class="nav-item"><a class="nav-link" href="{{ route('company.show', ['company' => Auth::user()->company->id]) }}"><i class="bi bi-person-circle"></i> {{ Auth::user()->name }}</a></li>
                            @endif
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('logout') }}" 
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="bi bi-box-arrow-right"></i> {{ trans('labels.logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        @else
                            <li class="nav-item"><a class="nav-link" href="{{ route('login') }}"><span class="glyphicon glyphicon-user"></span> {{ trans('labels.login') }}</a></li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    @yield('breadcrumb')
                </ol>
            </nav>
        </div>
        

        <div class="container">
            <header class="header-sezione">
                <h2>
                    @yield('titolo')
                </h2>
            </header>
        </div>
        
        @yield('corpo')
    </body>
</html>