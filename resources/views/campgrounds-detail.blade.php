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
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="img-thumbnail" style="width: auto; height: auto;">
                        <img class="mt-1 ml-1 img-fluid w-100 h-100 figure-img rounded"  src="{{$campgroundDetail->imageUrl}}"
                            alt="IMG">
                        <div class="figure w-100">
                            <figcaption class="figure-caption" style="float: right;">
                                <h4> {{$campgroundDetail->money}}</h4>
                            </figcaption>
                            <h4><a href=""> {{$campgroundDetail->name}}</a></h4>
                            <p>
                                {{$campgroundDetail->description}}
                            </p>
                            @if($userid == $campgroundDetail->userId)
                                <div class="text-right">
                                    <a class="btn btn-success" href="/campground/campground-detail/edit-campground/{{$campgroundDetail->id}}">
                                        Edit Info
                                    </a>
                                </div>
                            @endif
                            @if($userid == $campgroundDetail->userId)
                                <div class="text-right mt-3">
                                    <form action="/campground/campground-detail/{{$campgroundDetail->id}}/delete" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">
                                            Delete CampGround
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div style="height: 50px;">

                    </div>
                    <div class="well bg-light px-3 py-3">

                        <form id="comment_form">
                            @csrf
                            <button type ="submit" class="text-right btn btn-success" id="add-comment" >
                                Add Comment
                            </button>
                            <div class="mt-4" style="width: 100%; margin: 0 auto;">
                                <input class="form-control" type="text" placeholder="Write your Experience" name="comment", id="comment">
                            </div>
                        </form>
                        <hr>
                        <!--Comment Structure-->
                        @foreach($comments as $comment)
                            <div class="mt-3 px-3 py-3">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4 style="display: inline;">{{$comment->username}}</h4>
                                        <h6 class="text-right" style="display: inline; float:right">{{$comment->created_at}}</h6>
                                        <p class="mt-4">
                                            {{$comment->comment}}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="px-3 py-3" id="commentside">
                            
                        </div>
                    </div>
                    
                </div>
                
            </div>
        </div>
    </section>
    <script>
        $("#comment_form").submit(function(e){
            // let comments = document.getElementById('#comment').innerHTML;
            var comments = $('#comment').val();
            e.preventDefault();
            $.ajax({
                url: "/campground/campground-detail/{{$campgroundDetail->id}}",
                type: "POST",
                data:{
                    comment:comments,
                },
                beforeSend: function(xhr, type) {
                    if (!type.crossDomain) {
                        xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
                    }
                },
                success:function(response){
                    if(response){
                        $("#commentside").append(
                           "<div class='row mt-4' >"+
                                "<div class='col-md-12'>"+
                                    "<h4 style='display: inline;'>"+ response.username +"</h4>"+
                                    "<h6 class='text-right' style='display: inline; float:right'>"+ response.created_at+"</h6>"+
                                    "<p class='mt-4'>"+ response.comment +"</p>"+
                                    "</div>"+
                            "</div>"
                        );
                    }
                    $('#comment').val('');
                }
            });
        });
    </script>   

</body>
</html>


