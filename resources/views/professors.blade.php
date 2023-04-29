@extends('layout')
@section('content')
     <div class="container">

      @auth
      <div class="container">
           
            <div class="row justify-content-center">
                    <div class="card">
                        <div class="card-body">
                            <p>GESTIÓ DE PROFESSORS</p>
                            <a href="{{ route('dashboard.index')}}" class="btn btn-dark m-2">TORNAR</a>
                            <a class="btn btn-dark m-2" href="{{ route('alumnes.mostrar')}}">GESTIONAR ALUMNES</a>
                          
                            @if (session('alert'))
                            <div class="alert alert-success">{{ session('alert') }}</div>
                            @endif
                         
                            <table class="table">
                              <thead>
                                  <tr class="table table-dark table-striped table-hover">
                                    <th>NOM</th>
                                    <th>COGNOMS</th>
                                    <th>EMAIL</th>
                                    <th>ADMIN</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  @foreach ($data as $row)
                                      <tr>
                                        <td>{{ $row->name }}</td>       
                                        <td>{{ $row->cognoms }}</td>          
                                        <td>{{ $row->email }}</td>
                                        @if(Auth::user()->superadmin == 1)
                                        <form method="POST" action="{{ route('professors.actualitzar') }}">
                                          @csrf
                                          <td><input type="checkbox" name="admin"  @if( $row->admin == 1) checked @endif></td>
                                          <input type="hidden" name="id" value="{{$row->id}}">
                                          <td><button class="btn btn-secondary">Actualitzar</button></td>
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