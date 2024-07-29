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
                <th>Name</th>
                <th>Link</th>
                <th>Position</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
            @foreach ($datas as $key => $data)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $data->parent_id ?? '-' }}</td>
                    <td>{{ $data->name }}</td>
                    <td>{{ $data->link ?? '-' }}</td>
                    <td>{{ $data->position }}</td>
                    <td>{{ $data->status == 1 ? 'Yes' : 'No' }}</td>
                    <td>{{ \Carbon\Carbon::parse($data->created_at)->locale('id')->isoFormat('DD MMMM YYYY') }}</td>
                    <td>
                        <button class="btn" data-bs-toggle="modal" data-bs-target="#editModal{{ $data->id }}"><i class="material-icons">edit</i></button>
                        <button class="btn" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="material-icons" style="color:red">delete</i></button>
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
                    <form method="POST" action="{{ url('/menu/create') }}">
                    @csrf
                    <div class="form-floating">
                        <select name="parent_id" class="form-select" id="parent_id">
                            <option selected>Open this select menu</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                        <label for="parent_id">Works with selects</label>
                    </div>
                    <br />
                    <div class="input-group mb-3">
                        <div class="form-floating">
                            <input name="name" type="text" class="form-control" id="name" placeholder="Name" required>
                            <label for="name">Name</label>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="form-floating">
                            <input name="link" type="text" class="form-control" id="link" placeholder="Link" required>
                            <label for="link">Link</label>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="form-floating">
                            <input name="icon" type="text" class="form-control" id="icon" placeholder="Icon" required>
                            <label for="icon">Icon</label>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="form-floating">
                            <input name="position" type="text" class="form-control" id="position" placeholder="Position" required>
                            <label for="position">Position</label>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="form-floating">
                            <input name="action" type="text" class="form-control" id="action" placeholder="action" required>
                            <label for="action">Actions</label>
                        </div>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="status" role="switch"
                            id="flexSwitchChstatuseckChecked" checked>
                        <label class="form-check-label" for="status">status</label>
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

    @foreach($datas as $data)
    <div class="modal fade" id="editModal{{ $data->id }}" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="createModalLabel">Create Menu</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ url('/menu/create') }}">
                    @csrf
                    <div class="form-floating">
                        <select name="parent_id" class="form-select" id="parent_id">
                            <option selected>Open this select menu</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                        <label for="parent_id">Works with selects</label>
                    </div>
                    <br />
                    <div class="input-group mb-3">
                        <div class="form-floating">
                            <input name="name" value="{{ $data->name }}" type="text" class="form-control" id="name" placeholder="Name" required>
                            <label for="name">Name</label>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="form-floating">
                            <input name="link" value="{{ $data->link }}" type="text" class="form-control" id="link" placeholder="Link" required>
                            <label for="link">Link</label>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="form-floating">
                            <input name="icon" value="{{ $data->icon }}" type="text" class="form-control" id="icon" placeholder="Icon" required>
                            <label for="icon">Icon</label>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="form-floating">
                            <input name="position" value="{{ $data->position }}" type="text" class="form-control" id="position" placeholder="Position" required>
                            <label for="position">Position</label>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="form-floating">
                            <input name="action" value="{{ implode(", ", $data->action) }}" type="text" class="form-control" id="action" placeholder="action" required>
                            <label for="action">Actions</label>
                        </div>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="status" role="switch"
                            id="flexSwitchChstatuseckChecked" checked>
                        <label class="form-check-label" for="status">status</label>
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
    @endforeach
@endsection
