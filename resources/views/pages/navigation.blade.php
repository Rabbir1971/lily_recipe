<?php
/**
 * User: MD. Rabbir Hossain
 */
?>


<nav class="navbar navbar-fixed-top navbar-inverse">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{url('/')}}">Lily.Services</a>
        </div>
        {!! Form::open(['route'=>'search', 'role'=>'form', 'method'=>'POST', 'class'=>'navbar-form navbar-left']) !!}
        <div class="input-group">
            {{Form::text('search',null,['class'=>'form-control','required' => '','placeholder'=>'Search Your Recipe'])}}
            <span class="input-group-btn">
            {{Form::submit('Search',['class'=>'btn btn-default'])}}
        </span>
        </div>
        {!! Form::close() !!}
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                @if(Auth::check())
                    <li class="{{Request::is('favourites')?'active':''}}" ><a href="{{route('view.favourites')}}"><span class="glyphicon glyphicon-heart fav-icon" aria-hidden="true" ></span> Favourites</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            {{Auth::user()->name}}
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li ><a href="{{route('view.favourites')}}"><span class="glyphicon glyphicon-heart fav-icon" aria-hidden="true" ></span> Favourites</a></li>
                            <li>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li><a href="{{ route('login') }}">Login</a> </li>
                    <li><a href="{{ route('register') }}">Registration</a> </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

<script>
    $(".nav a").on("click", function(){
        $(".nav").find(".active").removeClass("active");
        $(this).parent().addClass("active");
    });
</script>


