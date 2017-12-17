<?php
/**
 * User: MD. Rabbir Hossain
 */?>

@extends('master')
@section('title','Favourites')
@section('content')
    <h1>Favourites</h1>
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
                        {!! Form::open(['route'=>'delete.favourites', 'role'=>'form','method'=>'DELETE']) !!}
                        {{Form::hidden('id',$result['id'])}}
                        <button type="submit" class="btn btn-danger btn-block" onclick="return confirmDelete();">
                            <span class="glyphicon glyphicon-trash" aria-hidden="true" ></span> Delete
                        </button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@stop

@section('scripts')
    <script>
        function confirmDelete(){
            if(confirm('Are you sure you want to Delete ?')){
                return true;
            }else{
                return false;
            }
        }
    </script>
@stop
