@extends('master')

@section('content')
  <div class="container">
    @foreach($improvements as $imp)
      <div class="card my-3">
        <div class="card-header">
          {{ $imp['title'] }}
        </div>
        <div class="card-body mb-4">
          {{ $imp['description']}}
        </div>
      </div>
    @endforeach
  </div>
@endsection
