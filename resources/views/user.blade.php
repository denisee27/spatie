@extends('layouts.layout')
@section('content')
<div class="d-flex justify-content-between mb-3">
    <h2>Role List</h2>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">Create</button>
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

<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="createModalLabel">Create Group</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ url('/permission_group/create') }}">
                @csrf
                <div class="input-group mb-3">
                    <div class="form-floating">
                        <input name="name" type="text" class="form-control" id="name" placeholder="Name" required>
                        <label for="name">Name</label>
                    </div>
                    <div class="form-floating">
                        <select name="role" class="form-select" id="role">
                            <option selected>Select Role</option>
                            @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                        <label for="role">Role</label>
                    </div>
                    <div class="form-floating">
                        <input name="email" type="text" class="form-control" id="email" placeholder="email" required>
                        <label for="email">Email</label>
                    </div>
                    <div class="form-floating">
                        <input name="password" type="text" class="form-control" id="password" placeholder="password" required>
                        <label for="password">Password</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
        </div>
    </div>
</div>


@endsection