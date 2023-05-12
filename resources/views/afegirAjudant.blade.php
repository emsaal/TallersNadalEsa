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
          <p>Aquí pots editar el taller, afegir el ajudant, etc.</p>

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
              <p>Responsable: {{ $taller->responsable }}</p>
             
              <p>Descripció: {{ $taller->descripcio }}</p>
              <p>Adreçat a: {{ $taller->adrecatA }}</p>
              <p>Número d'alumnes: {{ $taller->nAlumnes }}</p>
              <p>Material: {{ $taller->material }}</p>
              <p>Aula: {{ $taller->aula }}</p>
              <p>Observacions: {{ $taller->observacions }}</p>

              {{-- <form method="POST" action="{{ route('mostrarAlumnesTaller.submit') }}">
                @csrf
                <input type="hidden" name="tallerID" value=" {{ $taller->id }}">
                <div class="form-group mt-4">
                  <button type="submit" class="btn btn-danger">{{('GUARDAR TALLERS')}}</button>
                </div>
              </form> --}}
          </div>
        </div>
        <form method="POST" action="{{ route('usuariAfegirAjudants.submit') }}">
          @csrf
          <label for="usuari" class="label">Escull un ajudant:</label><br>
          Per afegir un nou ajudant <button type="button" id="afegirSelect">Afegir ajudant</button>
          <input type="hidden" name="tallerID" value="{{$taller->id}}">
          <select name="ajudants[]" class="form-select">
            <option disabled selected>Escollir ajudant</option>
            @foreach ($usuaris as $usuari)
              @if ($usuari->email !== $taller->responsable)
                <option value="{{ $usuari->id }}">{{ $usuari->email }}</option>
              @endif
            @endforeach
          </select>
          <div id="selects"></div>
          <div class="form-group mt-4">
            <button type="submit" class="btn btn-danger">{{('GUARDAR')}}</button>
          </div>
        </form>
              
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
          $(document).ready(function() {
            let selectedUsers = [];
        
            $(document).on('click', '#afegirSelect', function() {
              let options = '';
        
              options += '<option value="">Escollir ajudant</option>';
        
              @foreach ($usuaris as $usuari)
                if (!selectedUsers.includes({{ $usuari->id }})) {
                  options += '<option value="{{ $usuari->id }}">{{ $usuari->email }}</option>';
                }
              @endforeach
        
              $('#selects').append('<select name="ajudants[]" class="form-select">' + options + '</select>');
            });
        
            $(document).on('change', 'select[name="ajudants[]"]', function() {
              let selectedOption = $(this).val();
              selectedUsers.push(parseInt(selectedOption));
            });
          });
        </script>
        
              
           
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
