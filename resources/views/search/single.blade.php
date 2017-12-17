<?php
/**
 * User: MD. Rabbir Hossain
 */
?>

@extends('master')
@section('title', $label)
@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1 shadow-single">
            <div class="row">
                <div class="col-md-6 recipe-top-photo">
                    <img src="{{$result['image']}}" alt="Image" align="middle">
                </div>
                <div class="col-md-6 recipe-top-text">
                        <span class="recipe-top-text-top">
                            <h3 class="link-color">{{$result['label']}}</h3>
                            <p><a href="{{$result['url']}}" target="_blank">See Full recipe on: <span class="link-color">{{$result['source']}}</span></a></p>
                        </span>
                        <span class="recipe-top-text-bottom">
                            {!! Form::open(['route'=>'add.favourites', 'role'=>'form','method'=>'POST']) !!}
                                {{Form::hidden('uri',$result['uri'])}}
                                <button type="submit" class="btn btn-info">
                                    <span class="glyphicon glyphicon-heart fav-icon" aria-hidden="true"></span> Add To Favourite
                                </button>
                            {!! Form::close() !!}
                        </span>
                    </span>
                </div>
            </div>
            <div class="row recipe-bottom">
                <div class="col-md-6 pad-">
                    <h4 class="h4-title">{{count($result['ingredients'])}} Ingredients</h4>
                    @foreach($result['ingredients'] as $ingredients => $ingredient)
                        <p>
                            {{$ingredient['text']}} <br>
                            <small>Weight: {{round($ingredient['weight'])}} <span style="font-style: italic">gram</span></small>
                        </p>
                    @endforeach
                    <h4 class="h4-title " style="margin-top: 45px">Preparation</h4>
                    <a href="{{$result['url']}}" class="btn btn-default" target="_blank">Instructions</a> on
                    <a href="{{$result['url']}}">{{$result['source']}}</a>
                </div>
                <div class="col-md-6">
                    <h4 class="h4-title">Nutrition</h4>
                    <table class="table">
                        @foreach($result['totalNutrients'] as $nutrients => $nutrient)
                            <tr>
                                <td>{{$nutrient['label']}}</td>
                                <td>{{round($nutrient['quantity'])}}</td>
                                <td><small style="font-style: italic">{{$nutrient['unit']}}</small></td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>

@stop
