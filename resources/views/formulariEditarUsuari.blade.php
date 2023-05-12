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
          <p>Aqui pots editarl'usuari "{{ $usuari->email  }}" i afegir els tallers</p>
          
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
          <form method="POST" action="{{ route('usuariAfegirTallersAdmin.submit') }}">

            @csrf

            <label for="name" class="col-md-4 col-form-label text-md-right ">{{('Nom alumne') }}</label>
            <div class="col">
              <input id="name" type="text" class="form-control" name="name" value="{{ $usuari->name  }}" required>
            </div>

          
            <label for="cognom" class="col-md-4 col-form-label text-md-right ">{{('Cognoms') }}</label>
            <div class="col">
              <input id="cognom" type="text" class="form-control" name="cognom" value="{{$usuari->cognoms  }}" required>
            </div>

            <label for="email" class="col-md-4 col-form-label text-md-right ">{{('Email') }}</label>
            <div class="col">
              <input id="email" type="text" class="form-control" name="email" value="{{ $usuari->email  }}" required>
            </div>


            
            <div class="form-group mt-5">
            <label for="etapa">Etapa:</label>
            <select id="etapa" name="etapa" class="form-control">
              <option value="" selected disabled>Escull una etapa</option>
              <option value="ESO" {{ $usuari->etapa == 'ESO' ? 'selected' : '' }}>ESO</option>
              <option value="BATX" {{ $usuari->etapa == 'BATX' ? 'selected' : '' }}>BATX</option>
              <option value="SMX" {{  $usuari->etapa== 'SMX' ? 'selected' : '' }}>SMX</option>
              <option value="DAW" {{  $usuari->etapa== 'DAW' ? 'selected' : '' }}>DAW</option>
              <option value="FPB" {{  $usuari->etapa == 'FPB' ? 'selected' : '' }}>FPB</option>
              <option value="ASIX" {{  $usuari->etapa == 'ASIX' ? 'selected' : '' }}>ASIX</option>
            </select>
            </div>

            
            <div class="form-group mt-3">
            <label for="curs">Curs:</label>
            <select id="curs" name="curs" class="form-control">
              <option value="" >{{  $usuari->curs}}</option>
            </select>
            </div>

            <div class="form-group mt-3">
            <label for="grup">Grup:</label>
            <select id="grup" name="grup" class="form-control">
              <option value="" selected disabled>Escull una etapa</option>
              <option value="-" {{  $usuari->grup== '-' ? 'selected' : '' }}>-</option>
              <option value="A" {{  $usuari->grup == 'A' ? 'selected' : '' }}>A</option>
              <option value="B" {{ $usuari->grup == 'B' ? 'selected' : '' }}>B</option>
              <option value="C" {{  $usuari->grup == 'C' ? 'selected' : '' }}>C</option>
              <option value="D" {{  $usuari->grup == 'D' ? 'selected' : '' }}>D</option>
            </select>
          </div>
            
            
            <script>
              const etapaSelect = document.getElementById('etapa');
              const cursoSelect = document.getElementById('curs');
              const optionsByEtapa = {
                ESO: [{
                    value: '1',
                    label: '1º ESO'
                  },
                  {
                    value: '2',
                    label: '2º ESO'
                  },
                  {
                    value: '3',
                    label: '3º ESO'
                  },
                  {
                    value: '4',
                    label: '4º ESO'
                  }
                ],
                BATX: [{
                    value: '1',
                    label: '1º BATX'
                  },
                  {
                    value: '2',
                    label: '2º BATX'
                  }
                ],
                SMX: [{
                    value: '1',
                    label: '1º SMX'
                  },
                  {
                    value: '2',
                    label: '2º SMX'
                  }
                ],
                DAW: [{
                    value: '1',
                    label: '1º DAW'
                  },
                  {
                    value: '2',
                    label: '2º DAW'
                  }
                ],
                FPB: [{
                    value: '1',
                    label: '1º FPB'
                  },
                  {
                    value: '2',
                    label: '2º FPB'
                  }
                ],
                ASIX: [{
                    value: '1',
                    label: '1º ASIX'
                  },
                  {
                    value: '2',
                    label: '2º ASIX'
                  }
                ]
              };

              etapaSelect.addEventListener('change', () => {
                const selectedEtapa = etapaSelect.value;
                const options = optionsByEtapa[selectedEtapa] || [];
                cursoSelect.innerHTML = '';
                options.forEach(option => {
                  const {
                    value,
                    label
                  } = option;
                  const optionElement = document.createElement('option');
                  optionElement.value = value;
                  optionElement.textContent = label;
                  cursoSelect.appendChild(optionElement);
                });
              });
            </script>
                <div class="form-group mt-5">
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
    
                <input type="hidden" name="usuariID" value="{{ $usuari->id }}">
            <div class="form-group row mb-0 mt-2">
              <div class="col ">
                <button type="submit" class="btn btn-danger">{{('GUARDAR')}}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endauth


@endsection
@section('title','form')