@extends('layouts.layout')
@section('content')
<div class="d-flex justify-content-between mb-3">
    <h2>Role List</h2>
    <a href="{{ url('/roles/create') }}" class="btn btn-primary">Create</a>
</div>  
<div>
    <table class="table table-bordered text-center">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Created At</th>
            <th>Action</th>
        </tr>
        @foreach($datas as $key => $data)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $data->name }}</td>
            <td>{{ \Carbon\Carbon::parse($data->created_at)->locale('id')->isoFormat('DD MMMM YYYY') }}</td>
            <td>
                <a>Update</a>
                <a>Delete</a>
            </td>
        </tr>
        @endforeach
    </table>
</div>

@endsection