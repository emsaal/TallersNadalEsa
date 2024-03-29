@extends('layout')

@section('content')
  <div class="container">
    @auth
      <div class="container">
        <div class="row justify-content-center">
          <div class="card">
            <div class="card-body">
              <p>Hola {{ Auth::user()->name }}! Aquests són els tallers que tenim preparats</p>
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

              @if (session('error'))
                <div class="alert alert-danger">
                  {{ session('error') }}
                </div>
              @endif

              <a class="btn btn-dark m-2" href="{{ route('form')}}">NOU TALLER</a>
              @if(Auth::user()->superadmin == 1  || Auth::user()->admin == 1)                                
                <a class="btn btn-dark m-2" href="{{ route('alumnes.actualitzar')}}">ACTUALITZAR DADES</a>
              @endif    
              @if(Auth::user()->superadmin == 1  || Auth::user()->admin == 1 || Auth::user()->professor == 1)                                
                <a class="btn btn-dark m-2" href="{{ route('alumnes.mostrar')}}">GESTIONAR ALUMNAT</a>
              @endif 
              @if(Auth::user()->superadmin == 1  || Auth::user()->admin == 1 || Auth::user()->professor == 1)                                
                <a class="btn btn-dark m-2" href="{{ route('professors.mostrar')}}">GESTIONAR PROFESSORS</a>
              @endif 

              <div class="table-responsive">
                <table class="table table-striped table-hover">
                  <thead>
                    <tr>
                      <th>NOM TALLER</th>
                      @if(Auth::user()->superadmin == 1 || Auth::user()->professor == 1 || Auth::user()->admin == 1)
                        <th>RESPONSABLE</th>
                        <th>AJUDANT</th>
                      @endif
                      <th>DESCRIPCIO</th>
                      <th>ADREÇAT A</th>
                      <th>N. ALUMNES</th>
                      <th>MATERIAL</th>
                      <th>OBSERVACIONS</th>
                      @if(Auth::user()->superadmin == 1)
                        <th>DATA CREACIO</th>
                      @endif
                      @if(Auth::user()->superadmin == 1)
                        <th>ACTIONS</th>
                      @endif
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($data as $row)
                      <tr>
                        <td>{{ $row->taller }}</td>
                        @if(Auth::user()->superadmin == 1 || Auth::user()->professor == 1 || Auth::user()->admin == 1)
                          <td>{{ $row->responsable }}</td>
                          <td>{{ $row->ajudant }}</td>
                        @endif
                        <td>{{ $row->descripcio }}</td>
                        <td>{{ $row->adrecatA }}</td>
                        <td>{{ $row->nAlumnes }}</td>
                        <td>{{ $row->material }}</td>
                        <td>{{ $row->observacions }}</td>
                        @if(Auth::user()->superadmin == 1)
                          <td>{{ $row->created_at }}</td>
                       @endif 
                        @if(Auth::user()->superadmin == 1)
                          <td>
                            <form method="POST" action="{{ route('dashboard.duplicar') }}">
                              @csrf
                              <input type="hidden" name="id" value="{{$row->id}}">
                              <button class="btn btn-secondary">Duplicar</button>
                            </form>
                          </td>
                          <td>
                            <form method="POST" action="{{ route('asignarAjudant') }}">
                              @csrf
                              <input type="hidden" name="id" value="{{$row->id}}">
                              <button class="btn btn-secondary">Asignar ajudants</button>
                            </form>
                          </td>
                          <td>
                          <form method="POST" action="{{ route('detalls.taller') }}">
                            @csrf
                            <input type="hidden" name="id" value="{{$row->id}}">
                            <button class="btn btn-secondary">Detalls</button>
                          </form>
                        </td>
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