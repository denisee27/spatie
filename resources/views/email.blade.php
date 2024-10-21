@extends('layouts.layout')
@section('content')
<div class="d-flex justify-content-between mb-3">
    <h2>Email List</h2>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">Create</button>
</div>  
<div>
    <table class="table table-bordered text-center">
        <tr>
            <th>No</th>
            <th>From</th>
            <th>Subject</th>
            <th>Created At</th>
            <th>Action</th>
        </tr>
        @foreach($datas as $key => $data)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $data->name }}</td>
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
                <form method="POST" action="{{ url('/email/create') }}">
                @csrf
                <div class="mb-3 ">
                    <div class="form-floating">
                        <input name="subject" type="text" class="form-control" id="subject" placeholder="subject" required>
                        <label for="subject">Subject</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 mb-3 ">
                        <div class="form-floating">
                            <input name="name" type="text" class="form-control" id="name" placeholder="Name" required>
                            <label for="name">Name</label>
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="form-floating">
                            <input name="to" type="text" class="form-control" id="to" placeholder="to" required>
                            <label for="to">Email To</label>
                        </div>
                    </div>
                </div>
                    <div class="form-floating">
                        <textarea name="message" rows="5" cols="15" type="text" class="h-100 form-control" id="message" placeholder="message" required></textarea>
                        <label for="message">Message</label>
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