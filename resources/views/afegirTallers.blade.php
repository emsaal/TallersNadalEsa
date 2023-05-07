@extends('layout')

@section('content')
<div class="container">

  @auth
  <div class="container w-75">
    <a href="{{ route('dashboard.index') }}" class="btn btn-dark m-2">TORNAR</a>
    <div class="row justify-content-center">
      <div class="card bg-dark text-white">
        <div class="card-body">
          <p>Hola {{ Auth::user()->name }}!</p>
          <p>Escull tres tallers que t'interessin</p>

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

            <div class="form-group">
              <label for="primerTaller">Primer Taller:</label>
              <select name="primerTaller" class="form-control">
                @foreach ($tallers as $taller)
                <option value="{{ $taller->id }}">{{ $taller->taller }}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group mt-3">
              <label for="segonTaller">Segon Taller:</label>
              <select name="segonTaller" class="form-control">
                @foreach ($tallers as $taller)
                <option value="{{ $taller->id }}">{{ $taller->taller }}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group mt-3">
              <label for="tercerTaller">Tercer Taller:</label>
              <select name="tercerTaller" class="form-control">
                @foreach ($tallers as $taller)
                <option value="{{ $taller->id }}">{{ $taller->taller }}</option>
                @endforeach
              </select>
            </div>

            <input type="hidden" name="usuariID" value="{{ Auth::user()->id }}">

            <div class="form-group mt-4">
              <button type="submit" class="btn btn-danger">{{('GUARDAR TALLERS')}}</button>
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

@section('title', 'form')
