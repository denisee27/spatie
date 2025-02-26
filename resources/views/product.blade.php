@extends('layouts.layout')
@section('content')
    <div class="d-flex justify-content-between mb-3">
        <h2>Product List</h2>
        @role('admin')
        @endrole
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">Create</button>
    </div>
    {{-- @can('read_product') --}}
    <div>
        <table class="table table-bordered text-center">
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Description</th>
                <th>Categories</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
            @foreach ($datas as $key => $data)
                <tr>
                    <td>{{ $key += 1 }}</td>
                    <td>{{ $data->name }}</td>
                    <td>{{ $data->description }}</td>
                    <td>
                        @foreach ($data->categories as $key => $category)
                            {{ $category->name }}
                            @if ($key < count($data->categories) - 1)
                                ,
                            @endif
                        @endforeach
                    </td>
                    <td>{{ $data->created_at }}</td>
                    <td>
                        <button class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#updateModal{{ $data->id }}">Update</button>
                            <a href="{{ url('/products/delete/' . $data->id) }}" class="btn btn-danger">
                                <i class="fa-solid fa-trash"></i> Delete
                            </a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    {{-- @endcan --}}

    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="createModalLabel">Create Group</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ url('/products/create') }}">
                        @csrf
                        <div class="input-group mb-3">
                            <div class="form-floating">
                                <input name="name" type="text" class="form-control" id="name" placeholder="Name"
                                    required>
                                <label for="name">Name</label>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="form-floating">
                                <textarea name="description" type="text" class="form-control" id="description" placeholder="description" required></textarea>
                                <label for="description">Description</label>
                            </div>
                        </div>
                        <div id="categories-container">
                            <div class="row category-row">
                                <div class="col-9">
                                    <div class="input-group mb-3">
                                        <div class="form-floating">
                                            <div class="input-group mb-3">
                                                <div class="form-floating">
                                                    <select name="categories[]" class="form-select">
                                                        <option>Select Category</option>
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}">{{ $category->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <label for="category">Category</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="d-flex align-items-center justify-content-evenly">
                                        <div class="btn btn-danger" onclick="deleteCategory(this)"><i
                                                class="fa-solid fa-trash"></i></div>
                                        <div class="btn btn-primary" onclick="addCategory()">+</div>
                                    </div>
                                </div>
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

    @foreach ($datas as $data)
        <div class="modal fade" id="updateModal{{ $data->id }}" tabindex="-1"
            aria-labelledby="updateModalLabel{{ $data->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="updateModalLabel{{ $data->id }}">Update Product</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ url('/products/update/' . $data->id) }}">
                            @csrf @method('PUT')

                            <div class="input-group mb-3">
                                <div class="form-floating">
                                    <input name="name" type="text" class="form-control" id="name{{ $data->id }}"
                                        placeholder="Name" value="{{ $data->name }}" required>
                                    <label for="name{{ $data->id }}">Name</label>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <div class="form-floating">
                                    <textarea name="description" class="form-control" id="description{{ $data->id }}" placeholder="Description"
                                        required>{{ $data->description }}</textarea>
                                    <label for="description{{ $data->id }}">Description</label>
                                </div>
                            </div>

                            <div id="categories-container-{{ $data->id }}">
                                @foreach ($data->categories as $productCategory)
                                    <div class="row category-row">
                                        <div class="col-9">
                                            <div class="input-group mb-3">
                                                <div class="form-floating">
                                                    <select name="categories[]" class="form-select">
                                                        <option>Select Category</option>
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}"
                                                                {{ $category->id == $productCategory->id ? 'selected' : '' }}>
                                                                {{ $category->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <label for="category">Category</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="d-flex align-items-center justify-content-evenly">
                                                <div class="btn btn-danger" onclick="deleteCategoryUpdate(this)"><i
                                                        class="fa-solid fa-trash"></i></div>
                                                <div class="btn btn-primary"
                                                    onclick="addCategoryUpdate('{{ $data->id }}')">+</div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
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


    <script>
        function addCategory() {
            const container = document.getElementById('categories-container');
            const newRow = container.firstElementChild.cloneNode(true);
            newRow.querySelectorAll('[id]').forEach(el => el.removeAttribute('id'));
            const selectElement = newRow.querySelector('select');
            if (selectElement) {
                selectElement.selectedIndex = 0;
            }

            container.appendChild(newRow);
        }

        function deleteCategory(button) {
            const container = document.getElementById('categories-container');
            if (container.children.length > 1) {
                button.closest('.category-row').remove();
            } else {
                alert('Minimal satu kategori harus ada.');
            }
        }

        function addCategoryUpdate(id) {
            const container = document.getElementById(`categories-container-${id}`);
            const newRow = container.firstElementChild.cloneNode(true);
            newRow.querySelector('select').value = '';
            container.appendChild(newRow);
        }

        function deleteCategoryUpdate(button) {
            const row = button.closest('.category-row');
            const container = row.parentNode;
            if (container.children.length > 1) {
                row.remove();
            } else {
                alert('Minimal satu kategori harus ada.');
            }
        }
    </script>
@endsection
