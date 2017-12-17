<?php
/**
 * User: MD. Rabbir Hossain
 */

?>

@extends('master')
@section('title','Search')
@section('content')
    <h1>Results for {{$keyword}}</h1>

    <div class="row">
        @foreach($results as $result)
            <div class="col-sm-4 col-md-3">
                <?php $uri = str_replace('http://www.edamam.com/ontologies/edamam.owl#','',trim($result['uri']));?>
                <div class="thumbnail">
                    <a href="{{ route('search.single', $uri) }}">
                        <img src="{{$result['image']}}" alt="Image">
                    </a>
                    <div class="caption">
                        <a href="{{ route('search.single', $uri) }}">
                            <h4 class="link-color">{{$result['label']}}</h4>
                        </a>

                        <p class="show-tab" >
                            <a style="color:#6a7978;" href="{{ route('search.single', $uri) }}">
                                {{round($result['calories'])}} Calories | {{$result['ingredients']}} Ingredients
                            </a>
                            <br>
                            <a class="link-color" href="{{$result['sourceUrl']}}" target="_blank">{{$result['source']}}</a>
                        </p>
                        {!! Form::open(['route'=>'add.favourites', 'role'=>'form','method'=>'POST']) !!}
                        {{Form::hidden('uri',$result['uri'])}}
                        <button type="submit" class="btn btn-info">
                            <span class="glyphicon glyphicon-heart fav-icon" aria-hidden="true"></span> Add To Favourite
                        </button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        @endforeach
    </div>


@stop
