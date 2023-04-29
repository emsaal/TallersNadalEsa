@extends('layout')
@section('content')
     <div class="container">

      @auth
      <div class="container w-75">
            <div class="row justify-content-center">
                    <div class="card">
                        <div class="card-body">
                            <p>Hola {{ Auth::user()->name }}! Aquests son els tallers que tenim preparats</p>
                    
                        </div>
                    </div>
            </div>
        </div>
      @else
  
      @endauth

  
@endsection
@section('title','form')