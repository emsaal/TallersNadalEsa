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
                            <p>GESTIÓ D'ALUMNES</p>
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
                                  @foreach ($data as $row)
                                      <tr>
                                          <td>{{ $row->name }}</td>       
                                            <td>{{ $row->cognoms }}</td>
                                          
                                                               
                                          <td>{{ $row->email }}</td>
                                          <td>{{ $row->etapa }}</td>
                                          <td>{{ $row->curs }}</td>
                                          <td>{{ $row->grup }}</td>
                                      
                                          @if(Auth::user()->superadmin == 1 || Auth::user()->professor == 1 || Auth::user()->admin == 1)                                
                                          <form method="POST" action="{{ route('usuariEditarUsuari.submit') }}">
                                            @csrf
                                            <input type="hidden" name="usuariID" value="{{ $row->id }}">

                                          <td><button class="btn btn-secondary">Editar</button></td>
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