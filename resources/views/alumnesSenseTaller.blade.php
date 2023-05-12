@extends('layout')
@section('content')
     <div class="container">

      @auth
      <div class="container">
           
            <div class="row justify-content-center">
                    <div class="card">
                        <div class="card-body">
                            <p>GESTIÓ D'ALUMNES SENSE TALLER
                            </p>
                            <a class="btn btn-dark m-2" href="{{ route('dashboard.index')}}">INICI</a>

                            <a class="btn btn-dark m-2" href="{{ route('professors.mostrar')}}">GESTIONAR PROFESSORS</a>
                            <a class="btn btn-dark m-2" href="{{ route('alumnes.nou')}}">AFEGIR ALUMNE</a>
                            <table class="table">
                              <thead>
                                  <tr class="table table-striped table-dark table-hover">
                                      <th>NOM</th>
                                      <th>COGNOMS</th>
                                      <th>EMAIL</th>
                                       <th>ETAPA</th>
                                       <th>CURS</th>
                                       <th>GRUP</th>
                            
                                   
                                  </tr>
                              </thead>
                              <tbody>
                                  @foreach ($usuarisSenseTaller as $usuari)
                                      <tr>
                                          <td>{{ $usuari->name }}</td>       
                                            <td>{{ $usuari->cognoms }}</td>
                                          
                                                               
                                          <td>{{ $usuari->email }}</td>
                                          <td>{{ $usuari->etapa }}</td>
                                          <td>{{ $usuari->curs }}</td>
                                          <td>{{ $usuari->grup }}</td>
                                      
                                          @if(Auth::user()->superadmin == 1 || Auth::user()->professor == 1 || Auth::user()->admin == 1)                                
                                          <form method="POST" action="{{ route('usuariEditarUsuari.submit') }}">
                                            @csrf
                                            <input type="hidden" name="usuariID" value="{{ $usuari->id }}">

                                          <td><button class="btn btn-secondary">Afegir tallers</button></td>
                                        </form>
                                          @endif    
                                      </tr>
                                  @endforeach
                              </tbody>
                          </table>
                        </div>
                    </div>
            </div>
        </div>
      @else
  
      @endauth

  
@endsection
@section('title','form')