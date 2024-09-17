@extends('layouts.layout')
@section('content')
<style>
    /* The container */
    .container {
        display: block;
        position: relative;
        padding-left: 35px;
        /* margin-bottom: 12px; */
        cursor: pointer;
        font-size: 14px;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    /* Hide the browser's default checkbox */
    .container input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
        height: 0;
        width: 0;
    }

    /* Create a custom checkbox */
    .checkmark {
        position: absolute;
        top: 0;
        left: 0;
        height: 25px;
        width: 25px;
        background-color: #eee;
    }

    /* On mouse-over, add a grey background color */
    .container:hover input~.checkmark {
        background-color: #ccc;
    }

    /* When the checkbox is checked, add a blue background */
    .container input:checked~.checkmark {
        background-color: #2196F3;
    }

    /* Create the checkmark/indicator (hidden when not checked) */
    .checkmark:after {
        content: "";
        position: absolute;
        display: none;
    }

    /* Show the checkmark when checked */
    .container input:checked~.checkmark:after {
        display: block;
    }

    /* Style the checkmark/indicator */
    .container .checkmark:after {
        left: 9px;
        top: 5px;
        width: 5px;
        height: 10px;
        border: solid white;
        border-width: 0 3px 3px 0;
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg);
    }
</style>
<div class="box box-danger">
    <div class="box-header bg-warning">
        <h3 class="box-title">Update Role</h3>
    </div>

    <div class="box-body">
        <div class="col-12">
            <form class="form-horizontal" method="post" action="{{ url('/roles/update/store/'.$role->id) }}">
                <div class="modal-body">
                    @csrf @method('post')
                    <input type="hidden" name="guard_name" value="web" />
                    <div class="box-body">
                        <div class="row">
                            <label label class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-10">
                                <input name="name" type="text" class="form-control" placeholder="Roles Name" value="12321" required >
                            </div>
                        </div>
                        <div style="border-bottom: 0.5px solid silver; margin-bottom: 15px"></div>
                        @foreach ($permission->groupBy('group_id') as $row)
                        <div class="row">
                            <label class="col-sm-2 control-label">{!! $row[0]->group->name ?? '-'!!}</label>
                            <div class="col-sm-10">
                                <div class="row">
                                    <div class="col-md-12">
                                        @foreach ($row as $name )
                                        <label class="col-md-2">
                                            <input type="checkbox" name="{{ $name->name }}" value="{{ $name->name }}"
                                            @foreach ($role_permission as $pr ) {{ $name->id == $pr->permission_id ?
                                                'checked' : '' }}
                                                @endforeach 
                                                />
                                                {{ $name->name }}
                                            {{-- <span class="checkmark"></span></span> --}}
                                        </label>
                                        @endforeach
                                    </div>
                                </div>

                            </div>
                        </div>
                        @endforeach


                    </div>
                </div>
                <div class="modal-footer">

                </div>
                <div style="position: fixed; right: 20px; bottom: 50px">
                    <a href="{{ url('/roles') }}" class="btn btn-sm btn-warning">Cancel</a>
                    <button type="submit" class="btn btn-sm btn-primary">Save</button>
                </div>

            </form>

        </div>
    </div>
</div>
@endsection

@section('datatables')
<script src="{{ asset('datatables/jquery-3.5.1.js') }}"></script>
<script src="{{ asset('datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('datatables/jszip.min.js') }}"></script>
<script src="{{ asset('datatables/pdfmake.min.js') }}"></script>
<script src="{{ asset('datatables/vfs_fonts.js') }}"></script>
<script src="{{ asset('datatables/buttons.html5.min.js') }}"></script>
<script src="{{ asset('datatables/buttons.print.min.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function() {
    $('#tables').DataTable( {
        dom: 'Blfrtip',
        // "scrollY": 600,
        "scrollX": true,
        buttons: [
            'copy',
            {
            extend: 'excel',
            messageTop: 'Periode {{ date('F Y', strtotime('last month')) }}' ,
            },
        ]
    } );
    } );

</script>

<script>
    $('.delete-confirm').on('click', function (event) {
        event.preventDefault();
        const url = $(this).attr('href');
        swal.fire({
            title: "Konfirmasi Hapus Data",
            text: "Apakah anda yakin ingin menghapus data ini!",
            type: "warning",
            showCancelButton: !0,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel!",
            reverseButtons: !0,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',

        }).then(function (event) {

            if (event.value === true) {
                window.location.href = url;
            }

        }, function (dismiss) {
            return false;
        });
    });
</script>

@endsection