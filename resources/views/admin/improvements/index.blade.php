@extends('admin.master')

@section('table-rows')
    @foreach($improvements as $imp)
        <tr>
            <td>{{ $imp->id }}</td>
            <td>
                {{ $imp->title }}<br>
                <small class="text-muted">
                    {{ str_limit($imp->description, 64, '...') }}
                </small>
            </td>
            <td>
                <small class="text-muted">
                    {{ $imp->estimated_cost }}
                </small>
            </td>
            <td>{{ $imp->section_id }}</td>
            <td>
                {{ link_to_route('improvements.edit', 'Edit', [$imp->id], [
                    'class' => 'btn btn-warning'
                ]) }}
            </td>
        </tr>
    @endforeach
@endsection

@section('content')
    @parent
    <div class="container admin-container">
        <div class="table-wrapper">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title &amp; Description</th>
                        <th>Estimated Cost</th>
                        <th>Section</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @yield('table-rows')
                </tbody>
            </table>
        </div>
    </div>
@endsection
