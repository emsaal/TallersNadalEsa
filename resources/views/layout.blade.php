<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <title>@yield('title')</title>
    <meta name="Author" content="Emma S. Albano">
</head>
<body class="">
    {{-- @if(Auth::user() == true)        
    <form action="{{ route('dashboard.logout')}}">                    
        @csrf  
    <button class="btn btn-dark m-2" type="submit">LOG OUT</button> --}}
    {{-- @endif --}}
{{-- </form>   --}}
<form action="{{ route('usuari.tallers') }}" method="POST">
  @csrf
  <input type="hidden" name="usuariID" value="{{ Auth::user()->id }}">

  <button type="submit" class="btn btn-dark m-2">Perfil</button>
</form>
    @yield('content')
</body>
</html>