@extends('layout')
@section('content')

<head><link rel="stylesheet" href="{{asset('assets/css/style.css')}}"></head>
<body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form action="{{route('login.auth')}}" method="POST" class="logrg">
    @if (Session::get('succes'))
   <div class="alert alert-succes">
    {{Session::get('succes')}}</div>
    @endif
    @if (Session::get('fail'))
   <div class="alert alert-danger">
    {{Session::get('fail')}}</div>
    @endif
    @if (Session::get('notAllowed'))
   <div class="alert alert-danger">
    {{Session::get('notAllowed')}}</div>
    @endif

    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
        <li>{{ $error}}</li>
        @endforeach
</ul>
</div>
@endif

        
    @csrf
        <h3>Login Here</h3>

        <label for="username">Username</label>
        <input type="text" placeholder="Username" name="username">

        <label for="password">Password</label>
        <input type="password" placeholder="Password" name="password">

        <button type="submit">Login</button>
        <p>Don't have an account
        <a href="/register">register</a>
        </p>
        </div>
    </form>
</body>
    @endsection