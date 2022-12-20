@extends('layout')
@section('content')

<div class="wrapper bg-white">
<div class="d-flex align-items-start justify-content-between">
    <div class="d-flex flex-column">
        <div class="h5">My Profile</div>
        <p class="text-muted text-justify">
            <a href="/todo/">Back</a>
        </p>
    </div>
    <div class="info btn ml-md-4 ml-0">
        <span class="fa-solid fa-check" title="complated"></span>
    </div>
</div>
@if(is_null($user['image_profile']))
<img src="{{asset('assets/img/kupu.jpg')}}" alt="" srcset="" width="100" style="border-radius: 50%" class="d-block m-auto">
@else
<img src="{{asset('assets/img/', $user['image_profile'])}}" alt="" srcset="" width="100" style="border-radius: 50%" class="d-block m-auto">
@endif
<p>Name : {{Auth::user()->name}}</p>
<p>Username : {{Auth::user()->username}}</p>
<p>Email : {{Auth::user()->email}}</p>
<div class="d-flex justify-content-center mt-2">
    <a href="/todo/profile/upload" class="btn btn-primary p-1">Ubah Profil foto</a>
<div class="work border-bottom ">
    <div class="d-flex align-items-center py-2 mt-1">
</div>


    </body>
    @endsection