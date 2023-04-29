@extends('layout')
@section('content')
     <div class="container">
        <a href="{{ url('login-google')}}" class="btn btn-dark mb-5 mt-3">LOGIN</a>
        <div class="row text-center alert alert-danger d-flex justify-content-center">ERROR LOGIN</div>
     </div>
@section('title','form')