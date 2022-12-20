@extends('layout')
@section('content')

<img src="{{asset('assets/img/kupu.jpg')}}">
<h5> Anda tidak diperbolehkan mengakses halaman ini</h5>
<a href="{{route('todo.index')}}" class="btn btn-primary">Kembali</a>

@endsection