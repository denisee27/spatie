@extends('layouts.layout')
@section('content')

<div class="d-flex justify-content-between mb-3">
    <h2>Product List</h2>
    <button class="btn btn-primary">Create</button>
</div>
<div>
    <table class="table table-bordered text-center">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Description</th>
            <th>Created At</th>
            <th>Action</th>
        </tr>
        @foreach($datas as $key => $data)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $data->name }}</td>
            <td>{{ $data->description }}</td>
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