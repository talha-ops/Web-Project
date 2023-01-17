<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Edit Campground</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
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
                    Edit Campground
                </h1>
                <div style="width: 30%; margin: 0 auto;">
                    <form action="/campground/campground-detail/edit/{{$campground->id}}" method="post" id="main_form">
                        @csrf
                        <div class="mt-3">
                            <input class="form-control" type="text" name="edit_name" value = "{{$campground->name}}" value = "{{$campground->name}}" required>
                        </div>
                        <div class="mt-3">
                            <input class="form-control" type="text" name="edit_image" placeholder = "{{$campground->imageUrl}}" value = "{{$campground->imageUrl}}" required >
                        </div>
                        <div class="mt-3">
                            <textarea class="form-control" rows="8" name = 'edit_description' placeholder = "{{$campground->description}}" required></textarea>
                        </div>
                        <div class="mt-3">
                            <button class="btn btn-lg btn-primary w-100" type = 'submit'>
                                Submit
                            </button>
                        </div>
                        <div class="mt-3">
                            <a href="/campground/campground-detail/{{$campground->id}}">Go Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    
    <script>
        $("#main_form").validate({
                rules: {
                    edit_name: {
                        required: true,
                    },
                    edit_image: {
                        required: true,
                    },
                    edit_description: {
                        required: true,
                        minlength: 70
                    },

                },
                messages:{
                    edit_name: "Please Enter Name",
                    edit_image:"Please Enter URL",
                    edit_description:{
                        required: "Please Enter Description",
                        minlength: "Enter Description of 70 letters"
                    }
                }
            });
    </script>
</body>
</html>