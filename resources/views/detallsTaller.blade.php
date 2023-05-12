@extends('layout')

@section('content')
<div class="container">

  @auth
  <div class="container w-75">
    <a href="{{ route('dashboard.index') }}" class="btn btn-dark m-2">TORNAR</a>
    <div class="row justify-content-center">
      <div class="card">
        <div class="card-body  bg-dark  text-white ">
          <p>Hola {{ Auth::user()->name }}!</p>
          <p>Detalls del taller</p>

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

       
          <div class="card">
            <div class="card-body text-dark">
              <h3>{{ $taller->taller }}</h3>
              <div class="table-responsive">
                <table class="table">
                  <tbody>
                    <tr>
                      <th>Responsable:</th>
                      <td>{{ $taller->responsable }}</td>
                    </tr>
                    <tr>
                      <th>Descripció:</th>
                      <td>{{ $taller->descripcio }}</td>
                    </tr>
                    <tr>
                      <th>Adreçat a:</th>
                      <td>{{ $taller->adrecatA }}</td>
                    </tr>
                    <tr>
                      <th>Màxim número d'alumnes:</th>
                      <td>{{ $taller->nAlumnes }}</td>
                    </tr>
                    <tr>
                      <th>Plaçes ocupades</th>
                      <td>{{$usuarisApuntats}}/{{ $taller->nAlumnes }}</td>
                    </tr>
                    <tr>
                      <th>Material:</th>
                      <td>{{ $taller->material }}</td>
                    </tr>
                    <tr>
                      <th>Aula:</th>
                      <td>{{ $taller->aula }}</td>
                    </tr>
                    <tr>
                      <th>Observacions:</th>
                      <td>{{ $taller->observacions }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
          
        <form method="POST" action="{{ route('alumnesTaller') }}">
          @csrf
          <input type="hidden" name="tallerID" value="{{$taller->id}}">
            <button type="submit" class="btn btn-danger">{{('MOSTRAR ALUMNES APUNTATS A AQUEST TALLER')}}</button>
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
