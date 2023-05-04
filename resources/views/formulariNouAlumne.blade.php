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
          <p>Omplena el tot el formulari per crear un nou usuari</p>

          <form method="POST" action="{{ route('formulariNouAlumne.submit') }}">

            @csrf

            <label for="name" class="col-md-4 col-form-label text-md-right ">{{('Nom alumne') }}</label>
            <div class="col">
              <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required>
            </div>

          
            <label for="cognom" class="col-md-4 col-form-label text-md-right ">{{('Cognoms') }}</label>
            <div class="col">
              <input id="cognom" type="text" class="form-control" name="cognom" value="{{ old('cognom') }}" required>
            </div>

            <label for="email" class="col-md-4 col-form-label text-md-right ">{{('Email') }}</label>
            <div class="col">
              <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" required>
            </div>


            <label for="etapa">Etapa:</label>
            <select id="etapa" name="etapa">
              <option value="" selected disabled>Escull una etapa</option>
              <option value="ESO" {{ old('etapa') == 'ESO' ? 'selected' : '' }}>ESO</option>
              <option value="BATX" {{ old('etapa') == 'BATX' ? 'selected' : '' }}>BATX</option>
              <option value="SMX" {{ old('etapa') == 'SMX' ? 'selected' : '' }}>SMX</option>
              <option value="DAW" {{ old('etapa') == 'DAW' ? 'selected' : '' }}>DAW</option>
              <option value="FPB" {{ old('etapa') == 'FPB' ? 'selected' : '' }}>FPB</option>
              <option value="ASIX" {{ old('etapa') == 'ASIX' ? 'selected' : '' }}>ASIX</option>
            </select>
            

            <label for="curs">Curs:</label>
            <select id="curs" name="curs">
              <option value="" selected disabled>Escull un curs</option>
            </select>

            <label for="etapa">Grup:</label>
            <select id="etapa" name="etapa">
              <option value="" selected disabled>Escull una etapa</option>
              <option value="-" {{ old('etapa') == '-' ? 'selected' : '' }}>-</option>
              <option value="A" {{ old('etapa') == 'A' ? 'selected' : '' }}>A</option>
              <option value="B" {{ old('etapa') == 'B' ? 'selected' : '' }}>B</option>
              <option value="C" {{ old('etapa') == 'C' ? 'selected' : '' }}>C</option>
              <option value="D" {{ old('etapa') == 'D' ? 'selected' : '' }}>D</option>
             
            </select>


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