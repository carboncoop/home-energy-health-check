@extends('master')

@section('content')
  <div class="container hii">
    @foreach($reports as $report)
      <div class="card my-3">
        <div class="card-header">
          <h5 class="card-title">Some report
            <span class="ml-4">
              {{ link_to_route('reports.edit', 'Edit', [$report['id']], ['class' => 'btn btn-warning']) }}
            </span>
          </h5>
        </div>
        <div class="card-body mb-4">
        </div>
      </div>
    @endforeach
  </div>
@endsection
