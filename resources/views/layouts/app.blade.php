<!DOCTYPE html> 
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" ng-app="uplersCRUD">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts --> 

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ url('public/css/app.css') }}" rel="stylesheet">
	
	 <link href="{{url('')}}/public/css/bootstrap.min.css" rel="stylesheet">
	 <link href="{{url('')}}/public/css/dataTables.bootstrap4.min.css" rel="stylesheet">
   
	

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @auth               
                        
							@if (\Auth::user()->role_id == 1)
							<li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Admin Menus<span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <ul>
										<li class="nav-item">
											<a class="nav-link" href="{{ route('locations.index') }}">{{ __('Locations') }}</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="{{ route('categories.index') }}">{{ __('Categories') }}</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="{{ route('events.index') }}">{{ __('Events') }}</a>
										</li>
									</ul>
                                </div>
                            </li>
							@else
							<li class="nav-item">
                                <a class="nav-link" href="{{ route('events.index') }}">{{ __('Events') }}</a>
                            </li>							
							@endif
							
							<li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
							
						@else
							<li class="nav-item">
                                <a class="nav-link" href="{{ route('events.index') }}">{{ __('Events') }}</a>
                            </li>
							<li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
						@endauth  
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
	<script src="{{url('')}}/public/js/jquery-2.1.1.js"></script>
    <script src="{{url('')}}/public/js/bootstrap.min.js"></script> 
    <script src="{{url('')}}/public/js/jquery.dataTables.min.js"></script> 
    <script src="{{url('')}}/public/js/dataTables.bootstrap4.min.js"></script> 
	<script>
 $(function() {
   $('#example').DataTable();
 });
</script>
</body>
</html>
