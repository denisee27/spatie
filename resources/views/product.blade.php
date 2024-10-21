@extends('layouts.layout')
@section('content')

<div class="d-flex justify-content-between mb-3">
    <h2>Product List</h2>
    @role('admin')
    <button class="btn btn-primary">Create</button>
    @endrole

    
    
  </div>
  {{-- @can('read_product') --}}
<div>
    <table class="table table-bordered text-center">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Description</th>
            <th>Created At</th>
            <th>Action</th>
        </tr>
        @foreach($roles as $key => $role)
          <tr>
            <td>{{ $key += 1 }}</td>
            <td>{{ $role->name }}</td>
            <td>{{ $role->created_at }}</td>
          </tr>
        @endforeach
    </table>
</div>
{{-- @endcan --}}

<div class="modal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Modal body text goes here.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>


@endsection