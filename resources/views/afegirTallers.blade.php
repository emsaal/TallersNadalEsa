@extends('layout')
@section('content')
<div class="container">

  @auth
  <div class="container w-75 ">
    <a href="{{ route('dashboard.index')}}" class="btn btn-dark m-2">TORNAR</a>
    <div class="row justify-content-center ">
      <div class="card bg-dark text-white">
        <div class="card-body">
          <p>Hola {{ Auth::user()->name }}!</p>
          <p>Omplena el tot el formulari per crear un nou usuari</p>
          
          @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
          @endif
          
          @if (session('success'))
          <div class="alert alert-success">
            {{ session('success') }}
          </div>
          @endif
          <form method="POST" action="{{ route('usuariAfegirTallers.submit') }}">

            @csrf


            <select name="primerTaller">
              @foreach ($tallers as $taller)
                <option value="{{ $taller->id }}">{{ $taller->taller }}</option>
              @endforeach
            </select><br>
            <select name="segonTaller">
              @foreach ($tallers as $taller)
                <option value="{{ $taller->id }}">{{ $taller->taller }}</option>
              @endforeach
            </select><br>
            <select name="tercerTaller">
              @foreach ($tallers as $taller)
              <option value="{{ $taller->id }}">{{ $taller->taller }}</option>
            @endforeach
            </select><br>
            <input type="hidden" name="usuariID" value="{{ Auth::user()->id }}">
            <div class="form-group row mb-0 mt-2">
              <div class="col ">
                <button type="submit" class="btn btn-danger">{{('GUARDAR TALLERS') }}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@else

@endauth


@endsection
@section('title','form')