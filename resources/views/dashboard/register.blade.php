@extends('layout')
@section('content')


    <head><link rel="stylesheet" href="{{asset('assets/css/style.css')}}"></head>
    <body>
<div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form name="form" action="" method="POST" class="rgit">
   
    
    @csrf
        <h3>Register Here</h3>

        <label for="username">Name</label>
        <input type="text" placeholder="Name" name="name">

        <label for="password">Email</label>
        <input type="email" placeholder="Email" name="email">

        <label for="username">Username</label>
        <input type="text" placeholder="Email or Phone" name="username">

        <label for="password">Password</label>
        <input type="password" placeholder="Password" name="password">

        <button type="submit" id="cetak" >Register</button>
        </div>
    </form>
</body>
@endsection