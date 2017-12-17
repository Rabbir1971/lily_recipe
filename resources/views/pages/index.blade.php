<?php
/**
 * User: MD. Rabbir Hossain
 */

 ?>
@extends('master')
@section('title', 'Home')

@section('content')
<h1>Welcome</h1>
<div class="col-md-6 col-md-offset-3">
    {!! Form::open(['route'=>'search', 'role'=>'form', 'method'=>'POST']) !!}
    <div class="input-group">
        {{Form::text('search',null,['class'=>'form-control','required' => '','placeholder'=>'Search Your Recipe'])}}
        <span class="input-group-btn">
            {{Form::submit('Search',['class'=>'btn btn-default'])}}
        </span>
    </div>
    {!! Form::close() !!}
</div>
@stop