@extends('layout')
@section('content')
     <div class="container">

      @auth
      <div class="container">
        
            <div class="row justify-content-center">
                    <div class="card">
                                    
                      @if ($errors->any())
                      <div class="alert alert-danger">
                          @foreach ($errors->all() as $error)
                          <p>{{ $error }}</p>
                          @endforeach
                      </div>
                      @endif
          
                      @if (session('success'))
                      <div class="alert alert-success">
                          {{ session('success') }}
                      </div>
                      @endif
                        <div class="card-body">
                            <p>Alumnes apuntats al taller {{ $taller->taller}}</p>
                            <form method="POST" action="{{ route('detalls.taller') }}">
                              @csrf
                              <input type="hidden" name="id" value="{{$taller->id}}">
                              <button class="btn btn-secondary">TORNAR</button>
                            </form>
                         
                            </form>
                            <a class="btn btn-dark m-2" href="{{ route('dashboard.index')}}">INICI</a>
                            <a class="btn btn-dark m-2" href="{{ route('professors.mostrar')}}">GESTIONAR PROFESSORS</a>
                            <a class="btn btn-dark m-2" href="{{ route('alumnes.nou')}}">AFEGIR ALUMNE</a>
                            <a class="btn btn-dark m-2" href="{{ route('alumnes.sensetaller')}}">MOSTRAR ALUMNES SENSE TALLER</a>
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
                                  @foreach ($usuaris as $usuari)
                                      <tr>
                                          <td>{{ $usuari->name }}</td>       
                                          <td>{{ $usuari->cognoms }}</td>               
                                          <td>{{ $usuari->email }}</td>
                                          <td>{{ $usuari->etapa }}</td>
                                          <td>{{ $usuari->curs }}</td>
                                          <td>{{ $usuari->grup }}</td>
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