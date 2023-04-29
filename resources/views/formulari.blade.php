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
                            <p>Omplena el tot el formulari per realitzar la teva proposta de taller</p>
                        
                            <form method="POST" action="{{ route('formulari.submit') }}">

                                @csrf
                      
                            <label for="name" class="col-md-4 col-form-label text-md-right ">{{('Nom taller') }}</label>
                            <div class="col">
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                                    </div>
                                            
                                    <label for="proposat" class="col-md-4 col-form-label text-md-right">{{('Proposat per:') }}</label>
    
                                    <div class="col">
                                        <input id="proposat" type="text" class="form-control" name="proposat" value= {{ Auth::user()->email }} disabled required>
    
                                    </div>
                                    <label for="nAlumnes" class="col-md-4 col-form-label text-md-right">{{ ('Numero participants') }}</label>
    
                                    <div class="col">
                                        <input type="number" class="form-control" id="nAlumnes" name="nAlumnes" min="1" max="20" value="{{ old('nAlumnes') }}" required>
    
                                    </div>
                                    <label for="Descripció" class="col-md-4 col-form-label text-md-right">{{'Descripcio'}}</label>
    
                                    <div class="col">
                                        <textarea id="descripcio" class="form-control" name="descripcio" required>{{ old('descripco') }}</textarea>
    
                                    </div>

                                    <label for="material" class="col-md-4 col-form-label text-md-right">{{'Material'}}</label>
    
                                    <div class="col">
                                        <textarea id="material" class="form-control" name="material" required>{{ old('material') }}</textarea>
    
                                    </div>

                                    <label for="observacions" class="col-md-4 col-form-label text-md-right">{{'Observacions'}}</label>
    
                                    <div class="col">
                                        <textarea id="observacions" class="form-control" name="observacions" required>{{ old('observacions') }}</textarea>
    
                                    </div>

                                  
                                    <fieldset name="adrecat">
                                        <legend>Adreçat a:</legend>
                                        <div>
                                          <input type="checkbox" name="adrecat[]" value="1rESO" {{ in_array('1rESO', old('adrecat', [])) ? 'checked' : '' }}>
                                          <label for="1rESO">1r ESO</label>
                                        </div>
                                        <div>
                                          <input type="checkbox" name="adrecat[]" value="2nESO" {{ in_array('2nESO', old('adrecat', [])) ? 'checked' : '' }}>
                                          <label for="2nESO">2n ESO</label>
                                        </div>
                                        <div>
                                          <input type="checkbox" name="adrecat[]" value="3rESO" {{ in_array('3rESO', old('adrecat', [])) ? 'checked' : '' }}>
                                          <label for="3rESO">3r ESO</label>
                                        </div>
                                        <div>
                                          <input type="checkbox" name="adrecat[]" value="4tESO" {{ in_array('4tESO', old('adrecat', [])) ? 'checked' : '' }}>
                                          <label for="4tESO">4t ESO</label>
                                        </div>
                                        <div>
                                          <input type="checkbox" name="adrecat[]" value="1rSMX" {{ in_array('1rSMX', old('adrecat', [])) ? 'checked' : '' }}>
                                          <label for="1rSMX">1r SMX</label>
                                        </div>
                                        <div>
                                          <input type="checkbox" name="adrecat[]" value="2nSMX" {{ in_array('2nSMX', old('adrecat', [])) ? 'checked' : '' }}>
                                          <label for="2nSMX">2n SMX</label>
                                        </div>
                                        <div>
                                          <input type="checkbox" name="adrecat[]" value="1rDAW" {{ in_array('1rDAW', old('adrecat', [])) ? 'checked' : '' }}>
                                          <label for="1rDAW">1r DAW</label>
                                        </div>
                                        <div>
                                          <input type="checkbox" name="adrecat[]" value="2nDAW" {{ in_array('2nDAW', old('adrecat', [])) ? 'checked' : '' }}>
                                          <label for="2nDAW">2n DAW</label>
                                        </div>
                                        <div>
                                          <input type="checkbox" name="adrecat[]" value="1rASIX" {{ in_array('1rASIX', old('adrecat', [])) ? 'checked' : '' }}>
                                          <label for="1rAsix">1r ASIX</label>
                                        </div>
                                        <div>
                                            <input type="checkbox" name="adrecat[]" value="2nASIX" {{ in_array('2nASIX', old('adrecat', [])) ? 'checked' : '' }}>
                                            <label for="2bAsix">2n ASIX</label>
                                          </div>

                                    
                                <div class="form-group row mb-0 mt-2">
                                    <div class="col ">
                                        <button type="submit" class="btn btn-danger">{{('ENVIAR') }}</button>
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