@extends('layout')
@section('content')

<table class="table mt-5">
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">Name</th>
        <th scope="col">Username</th>
        <th scope="col">Email</th>
        <th scope="col">Created</th>
        </th>
      </tr>
    </thead>
   
    <tbody class="table-group-divider">
        @foreach ($items as $item)
            
        
        <tr>
          <th scope="row"></th>
          <td>{{$item['name']}}</td>
          <td>{{$item['username']}}</td>
          <td>{{$item['email']}}</td>
          <td>{{ \Carbon\Carbon::parse($item['created_at'])->format('j F, Y')}}</td>
        </tr>
        @endforeach
      </tbody>
  
  </table>
    @endsection