<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YelpCamp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .error{
            color: red;
            font-style: italic;
        }
    </style>
</head>

<body>
    <header>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/campgrounds') }}">
                    YelpCamp
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
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <section>
        <div class="container my-5 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-12">
            <div class="row">
                <h1 style="text-align: center;">
                    Create a New Campground
                </h1>
                <div style="width: 30%; margin: 0 auto;">

                    <form action="/campgrounds" method="POST" id="main_form">
                        @csrf
                        <div class="mt-3">
                            <input id= "name" class="form-control" type="text" name="name" placeholder="Name" required>
                      </div>

                        <div class="mt-3">
                            <input class="form-control" type="text" name="image" placeholder="Image Url" required>
                        </div>
                        <div class="mt-3">
                            <input class="form-control" type="text" name="cost" placeholder="Cost" required>
                       </div>
                        <div class="mt-3">
                            <textarea class="form-control" type="text" name="description" placeholder="Description" required></textarea>
                        </div>
                        <div class="mt-3" >
                            <button class="btn btn-lg btn-primary w-100">
                                Submit
                            </button>
                        </div>
                    </form>
                    <div class="mt-3">
                        <a href="/campgrounds">Go Back</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $("#main_form").validate({
                rules: {
                    name: {
                        required: true,
                    },
                    image: {
                        required: true,
                    },
                    cost: {
                        required: true,
                    },
                    description: {
                        required: true,
                        minlength: 70
                    }

                },
                messages:{
                    name: "Please Enter Name",
                    image:"Please Enter URL",
                    cost:"Please Enter Amount",
                    description:{
                        required: "Please Enter Description",
                        minlength: "Enter Description of 70 letters"
                    }
                }
            });
    </script>
</body>

</html>