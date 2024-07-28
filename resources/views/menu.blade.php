@extends('layouts.layout')
@section('content')
    <div class="d-flex justify-content-between mb-3">
        <h2>Menu Navigation</h2>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">Create</button>
    </div>
    <div>
        <table class="table table-bordered text-center">
            <tr>
                <th>No</th>
                <th>Parent</th>
                <th>Menu</th>
                <th>Link</th>
                <th>Position</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
            @foreach ($datas as $key => $data)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $data->name }}</td>
                    <td>{{ $data->name }}</td>
                    <td>{{ $data->name }}</td>
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

    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="createModalLabel">Create Menu</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-floating">
                        <select name="parent_id" class="form-select" id="parent_id">
                          <option selected>Open this select menu</option>
                          <option value="1">One</option>
                          <option value="2">Two</option>
                          <option value="3">Three</option>
                        </select>
                        <label for="parent_id">Works with selects</label>
                      </div>
                      <br/>
                    <div class="input-group mb-3">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="name" placeholder="Name" required>
                            <label for="name">Name</label>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="link" placeholder="Link" required>
                            <label for="link">Link</label>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="icon" placeholder="Icon" required>
                            <label for="icon">Icon</label>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="position" placeholder="Position" required>
                            <label for="position">Position</label>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="action" placeholder="action" required>
                            <label for="action">Actions</label>
                        </div>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="status" role="switch" id="flexSwitchChstatuseckChecked" checked>
                        <label class="form-check-label" for="status">status</label>
                      </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection
