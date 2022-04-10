@extends('layouts.app')

@section('title', $title)

@push('css')
    <link href="{{ asset('admin/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="{{ asset('admin/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Multi Item Selection examples -->
    <link href="{{ asset('admin/plugins/datatables/select.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- App css -->
    <link href="{{ asset('admin/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/css/icons.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet" type="text/css" />


    <script src="{{ asset('admin/js/modernizr.min.js') }}"></script>
@endpush

@push('style')
    <style>
        .mtop-100 {
            margin-top: 150px !important;
        }

    </style>
@endpush

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card-box table-responsive">

            <table id="datatable" class="table table-bordered  m-t-30">
                <thead>
                    <tr>
                        <th width="10%">No</th>
                        <th>Kode</th>
                        <th>Nama Intervensi</th>
                        <th>Pengertian</th>
                        <th>Terapeutik</th>
                        <th>Kolaborasi</th>
                        <th>Observasi</th>
                        <th>Edukasi</th>
                        <th width="10%">Action</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
    @include('admin.intervensi._form')
    @include('admin.intervensi.terapeutikDetail')
    @include('admin.intervensi.kolaborasiDetail')
    @include('admin.intervensi.observasiDetail')
    @include('admin.intervensi.edukasiDetail')
    @include('admin.intervensi._formChild')
</div>
@endsection

@push('scripts')

    <script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <!-- Buttons examples -->
    <script src="{{ asset('admin/plugins/datatables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/sweet-alert/sweetalert2.min.js') }}"></script>
    {{-- sweat allert --}}

    <!-- Responsive examples -->
    <script src="{{ asset('admin/plugins/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- Selection table -->
    <script src="{{ asset('admin/plugins/datatables/dataTables.select.min.js') }}"></script>

@endpush

@push('js')

    @include('crud.js')
    <script>
        let dataTable = $('#datatable').DataTable({
            dom: 'lBfrtip',
            buttons: [{
                className: 'btn btn-success btn-sm mr-2',
                text: 'Create',
                action: function (e, dt, node, config) {
                    createItem();
                }
            }, {
                className: 'btn btn-warning btn-sm mr-2',
                text: 'Reload',
                action: function (e, dt, node, config) {
                    reloadDatatable();
                    Toast.fire({
                        icon: 'success',
                        title: 'Reload'
                    })
                }
            }],
            responsive: true,
            processing: true,
            serverSide: true,
            searching: true,
            pageLength: 5,
            lengthMenu: [
                [5, 10, 15, -1],
                [5, 10, 15, "All"]
            ],
            ajax: {
                url: child_url,
                type: 'GET',
            },
            columns: [{
                    data: 'DT_RowIndex',
                    orderable: false
                },
                {
                    data: 'kode',
                    orderable: true
                },
                {
                    data: 'intervensi_keperawatan',
                    orderable: true
                },
                {
                    data: 'pengertian',
                    orderable: true
                },
                {
                    data: 'terapeutik',
                    orderable: true
                },


                {
                    data: 'kolaborasi',
                    orderable: true
                },
                {
                    data: 'observasi',
                    orderable: true
                },
                {
                    data: 'edukasi',
                    orderable: true
                },
                {
                    data: 'action',
                    name: '#',
                    orderable: false
                },
            ]
        });

    </script>
    <script>
        // chid
        function editChild(id, data, jenis) {

            $('#idChild').val(id);
            $('.nama').val(data);
            sessionStorage.setItem('jenis', jenis)
            $('#modalChildForm').modal('show');
        }

        function updateChild() {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: true,
            })
            console.log(sessionStorage.getItem('jenis'))
            var nama = $(".nama").val();
            var jenis = sessionStorage.getItem('jenis')
            $.ajax({
                url: '/api/update-' + jenis + '/' + $('#idChild').val(),
                type: "put",
                cache: false,
                dataType: 'json',
                data: {
                    nama: nama,
                    id: $('#idChild').val(),
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (result) {
                    if (jenis == 'terapeutik') {

                        reloadDatatableTerapeutik()
                    };
                    if (jenis == 'kolaborasi') reloadDatatableKolaborasi();
                    if (jenis == 'observasi') reloadDatatableObservasi();
                    if (jenis == 'edukasi') reloadDatatableEdukasi();
                },
                error: function (result) {
                    // $('#modal').modal('hide');

                    if (result.responseJSON) {
                        getError(result.responseJSON.errors);
                    } else {
                        console.log(result);
                    }
                },
            })
            swalWithBootstrapButtons.fire(
                'Success!',
                'Data diubah',
                'success'
            )

            $(".nama").val('')
        }


        $('#sendName').on('click', function (e) {
            if ($(".nama").val() != '') {
                e.preventDefault();
                updateChild();
            }

        })

        //TERAPEUTIK
        $('#saveTerapeutik').on('click', function (e) {
            if ($(".terapeutik").val() != '') {
                e.preventDefault();
                saveTerapeutik()

            }

        })

        function saveTerapeutik() {

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: true,
            })

            swalWithBootstrapButtons.fire({
                title: 'Are You Sure ?',
                text: "Kamu Akan Menambah Kolaborasi!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes!',
                cancelButtonText: 'No, Quit!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    var nama = $(".terapeutik").val();

                    $.ajax({
                        url: '/api/simpan-terapeutik',
                        type: "post",
                        cache: false,
                        dataType: 'json',
                        data: {
                            nama: nama,
                            intervensi_id: sessionStorage.getItem('idIntervensi')
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (result) {
                            reloadDatatableTerapeutik();
                        },
                        error: function (result) {
                            // $('#modal').modal('hide');

                            if (result.responseJSON) {
                                getError(result.responseJSON.errors);
                            } else {
                                console.log(result);
                            }
                        },
                    })
                    swalWithBootstrapButtons.fire(
                        'Success!',
                        'Data ditambahkan',
                        'success'
                    )
                    $(".terapeutik").val('')
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancel',
                        'Process Has Been Canceled',
                        'error'
                    )
                }
            })
        }

        function deleteTerapeutik(id) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: true,
            })

            swalWithBootstrapButtons.fire({
                title: 'Are You Sure ?',
                text: "Kamu Akan Menghapus Data Kolaborasi Ini!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes!',
                cancelButtonText: 'No, Quit!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {


                    $.ajax({
                        url: '/api/hapus-terapeutik/' + id,
                        type: "DELETE",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },

                        success: function (result) {
                            reloadDatatableTerapeutik();
                            Toast.fire({
                                icon: 'success',
                                title: 'Delete successfully'
                            })

                            // toastr.success('Berhasil Dihapus', 'Success');
                        },
                        error: function (errors) {
                            getError(errors.responseJSON.errors);
                        }
                    });
                    swalWithBootstrapButtons.fire(
                        'Success!',
                        'Terapeutik Berhasil dihapus',
                        'success'
                    )

                } else if (
                    // Read more about handling dismissals
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancel',
                        'Process Has Been Canceled',
                        'error'
                    )
                }
            })
        }

        function reloadDatatableTerapeutik() {
            $('#detailTerapeutik').DataTable().ajax.reload();
        }

        function detailTerapeutik(id) {
            sessionStorage.setItem('idIntervensi', id)
            $('#modalDetailTerapeutik').modal('show');
            $('#detailTerapeutik').dataTable().fnClearTable();
            $('#detailTerapeutik').dataTable().fnDestroy();
            let dataTableTerapeutik = $('#detailTerapeutik').DataTable({
                dom: 'lBfrtip',
                buttons: [{
                    className: 'btn btn-warning btn-sm mr-2',
                    text: 'Reload',
                    action: function (e, dt, node, config) {
                        reloadDatatableTerapeutik();
                        Toast.fire({
                            icon: 'success',
                            title: 'Reload'
                        })
                    }
                }, , ],
                responsive: true,
                processing: true,
                serverSide: true,
                searching: true,

                pageLength: 5,

                lengthMenu: [
                    [5, 10, 15, -1],
                    [5, 10, 15, "All"]
                ],
                ajax: {
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '/api/terapeutik-table',
                    type: 'POST',
                    data: {
                        id: id
                    },
                },
                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false
                    },
                    {
                        data: 'nama',
                        orderable: true
                    },
                    {
                        data: 'action',
                        name: '#',
                        orderable: false
                    },
                ]
            });
        }


         //KOLABORASI
        $('#saveKolaborasi').on('click', function (e) {
            if ($(".kolaborasi").val() != '') {
                e.preventDefault();
                saveKolaborasi()

            }

        })

        function saveKolaborasi() {

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: true,
            })

            swalWithBootstrapButtons.fire({
                title: 'Are You Sure ?',
                text: "Kamu Akan Menambah Kolaborasi!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes!',
                cancelButtonText: 'No, Quit!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    var nama = $(".kolaborasi").val();

                    $.ajax({
                        url: '/api/simpan-kolaborasi',
                        type: "post",
                        cache: false,
                        dataType: 'json',
                        data: {
                            nama: nama,
                            intervensi_id: sessionStorage.getItem('idIntervensi')
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (result) {
                            reloadDatatableKolaborasi();
                        },
                        error: function (result) {
                            // $('#modal').modal('hide');

                            if (result.responseJSON) {
                                getError(result.responseJSON.errors);
                            } else {
                                console.log(result);
                            }
                        },
                    })
                    swalWithBootstrapButtons.fire(
                        'Success!',
                        'Data ditambahkan',
                        'success'
                    )
                    $(".kolaborasi").val('')
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancel',
                        'Process Has Been Canceled',
                        'error'
                    )
                }
            })
        }

        function deleteKolaborasi(id) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: true,
            })

            swalWithBootstrapButtons.fire({
                title: 'Are You Sure ?',
                text: "Kamu Akan Menghapus Data Kolaborasi Ini!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes!',
                cancelButtonText: 'No, Quit!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {


                    $.ajax({
                        url: '/api/hapus-kolaborasi/' + id,
                        type: "DELETE",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },

                        success: function (result) {
                            reloadDatatableKolaborasi();
                            Toast.fire({
                                icon: 'success',
                                title: 'Delete successfully'
                            })

                            // toastr.success('Berhasil Dihapus', 'Success');
                        },
                        error: function (errors) {
                            getError(errors.responseJSON.errors);
                        }
                    });
                    swalWithBootstrapButtons.fire(
                        'Success!',
                        'Kolaborasi Berhasil dihapus',
                        'success'
                    )

                } else if (
                    // Read more about handling dismissals
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancel',
                        'Process Has Been Canceled',
                        'error'
                    )
                }
            })
        }

        function reloadDatatableKolaborasi() {
            $('#detailKolaborasi').DataTable().ajax.reload();
        }

        function detailKolaborasi(id) {
            sessionStorage.setItem('idIntervensi', id)
            $('#modalDetailKolaborasi').modal('show');
            $('#detailKolaborasi').dataTable().fnClearTable();
            $('#detailKolaborasi').dataTable().fnDestroy();
            let dataTableKolaborasi = $('#detailKolaborasi').DataTable({
                dom: 'lBfrtip',
                buttons: [{
                    className: 'btn btn-warning btn-sm mr-2',
                    text: 'Reload',
                    action: function (e, dt, node, config) {
                        reloadDatatableKolaborasi();
                        Toast.fire({
                            icon: 'success',
                            title: 'Reload'
                        })
                    }
                }, , ],
                responsive: true,
                processing: true,
                serverSide: true,
                searching: true,

                pageLength: 5,

                lengthMenu: [
                    [5, 10, 15, -1],
                    [5, 10, 15, "All"]
                ],
                ajax: {
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '/api/kolaborasi-table',
                    type: 'POST',
                    data: {
                        id: id
                    },
                },
                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false
                    },
                    {
                        data: 'nama',
                        orderable: true
                    },
                    {
                        data: 'action',
                        name: '#',
                        orderable: false
                    },
                ]
            });
        }

          //OBSERVASI
        $('#saveObservasi').on('click', function (e) {
            if ($(".observasi").val() != '') {
                e.preventDefault();
                saveObservasi()

            }

        })

        function saveObservasi() {

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: true,
            })

            swalWithBootstrapButtons.fire({
                title: 'Are You Sure ?',
                text: "Kamu Akan Menambah Observasi!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes!',
                cancelButtonText: 'No, Quit!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    var nama = $(".observasi").val();

                    $.ajax({
                        url: '/api/simpan-observasi',
                        type: "post",
                        cache: false,
                        dataType: 'json',
                        data: {
                            nama: nama,
                            intervensi_id: sessionStorage.getItem('idIntervensi')
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (result) {
                            reloadDatatableObservasi();
                        },
                        error: function (result) {
                            // $('#modal').modal('hide');

                            if (result.responseJSON) {
                                getError(result.responseJSON.errors);
                            } else {
                                console.log(result);
                            }
                        },
                    })
                    swalWithBootstrapButtons.fire(
                        'Success!',
                        'Data ditambahkan',
                        'success'
                    )
                    $(".observasi").val('')
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancel',
                        'Process Has Been Canceled',
                        'error'
                    )
                }
            })
        }

        function deleteObservasi(id) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: true,
            })

            swalWithBootstrapButtons.fire({
                title: 'Are You Sure ?',
                text: "Kamu Akan Menghapus Data Observasi Ini!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes!',
                cancelButtonText: 'No, Quit!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {


                    $.ajax({
                        url: '/api/hapus-observasi/' + id,
                        type: "DELETE",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },

                        success: function (result) {
                            reloadDatatableObservasi();
                            Toast.fire({
                                icon: 'success',
                                title: 'Delete successfully'
                            })

                            // toastr.success('Berhasil Dihapus', 'Success');
                        },
                        error: function (errors) {
                            getError(errors.responseJSON.errors);
                        }
                    });
                    swalWithBootstrapButtons.fire(
                        'Success!',
                        'Observasi Berhasil dihapus',
                        'success'
                    )

                } else if (
                    // Read more about handling dismissals
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancel',
                        'Process Has Been Canceled',
                        'error'
                    )
                }
            })
        }

        function reloadDatatableObservasi() {
            $('#detailObservasi').DataTable().ajax.reload();
        }

        function detailObservasi(id) {
            sessionStorage.setItem('idIntervensi', id)
            $('#modalDetailObservasi').modal('show');
            $('#detailObservasi').dataTable().fnClearTable();
            $('#detailObservasi').dataTable().fnDestroy();
            let dataTableObservasi = $('#detailObservasi').DataTable({
                dom: 'lBfrtip',
                buttons: [{
                    className: 'btn btn-warning btn-sm mr-2',
                    text: 'Reload',
                    action: function (e, dt, node, config) {
                        reloadDatatableObservasi();
                        Toast.fire({
                            icon: 'success',
                            title: 'Reload'
                        })
                    }
                }, , ],
                responsive: true,
                processing: true,
                serverSide: true,
                searching: true,

                pageLength: 5,

                lengthMenu: [
                    [5, 10, 15, -1],
                    [5, 10, 15, "All"]
                ],
                ajax: {
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '/api/observasi-table',
                    type: 'POST',
                    data: {
                        id: id
                    },
                },
                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false
                    },
                    {
                        data: 'nama',
                        orderable: true
                    },
                    {
                        data: 'action',
                        name: '#',
                        orderable: false
                    },
                ]
            });
        }



           //EDUKASI
        $('#saveEdukasi').on('click', function (e) {
            if ($(".edukasi").val() != '') {
                e.preventDefault();
                saveEdukasi()

            }

        })

        function saveEdukasi() {

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: true,
            })

            swalWithBootstrapButtons.fire({
                title: 'Are You Sure ?',
                text: "Kamu Akan Menambah Edukasi!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes!',
                cancelButtonText: 'No, Quit!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    var nama = $(".edukasi").val();

                    $.ajax({
                        url: '/api/simpan-edukasi',
                        type: "post",
                        cache: false,
                        dataType: 'json',
                        data: {
                            nama: nama,
                            intervensi_id: sessionStorage.getItem('idIntervensi')
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (result) {
                            reloadDatatableEdukasi();
                        },
                        error: function (result) {
                            // $('#modal').modal('hide');

                            if (result.responseJSON) {
                                getError(result.responseJSON.errors);
                            } else {
                                console.log(result);
                            }
                        },
                    })
                    swalWithBootstrapButtons.fire(
                        'Success!',
                        'Data ditambahkan',
                        'success'
                    )
                    $(".edukasi").val('')
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancel',
                        'Process Has Been Canceled',
                        'error'
                    )
                }
            })
        }

        function deleteEdukasi(id) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: true,
            })

            swalWithBootstrapButtons.fire({
                title: 'Are You Sure ?',
                text: "Kamu Akan Menghapus Data Edukasi Ini!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes!',
                cancelButtonText: 'No, Quit!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {


                    $.ajax({
                        url: '/api/hapus-edukasi/' + id,
                        type: "DELETE",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },

                        success: function (result) {
                            reloadDatatableEdukasi();
                            Toast.fire({
                                icon: 'success',
                                title: 'Delete successfully'
                            })

                            // toastr.success('Berhasil Dihapus', 'Success');
                        },
                        error: function (errors) {
                            getError(errors.responseJSON.errors);
                        }
                    });
                    swalWithBootstrapButtons.fire(
                        'Success!',
                        'Edukasi Berhasil dihapus',
                        'success'
                    )

                } else if (
                    // Read more about handling dismissals
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancel',
                        'Process Has Been Canceled',
                        'error'
                    )
                }
            })
        }

        function reloadDatatableEdukasi() {
            $('#detailEdukasi').DataTable().ajax.reload();
        }

        function detailEdukasi(id) {
            sessionStorage.setItem('idIntervensi', id)
            $('#modalDetailEdukasi').modal('show');
            $('#detailEdukasi').dataTable().fnClearTable();
            $('#detailEdukasi').dataTable().fnDestroy();
            let dataTableEdukasi = $('#detailEdukasi').DataTable({
                dom: 'lBfrtip',
                buttons: [{
                    className: 'btn btn-warning btn-sm mr-2',
                    text: 'Reload',
                    action: function (e, dt, node, config) {
                        reloadDatatableEdukasi();
                        Toast.fire({
                            icon: 'success',
                            title: 'Reload'
                        })
                    }
                }, , ],
                responsive: true,
                processing: true,
                serverSide: true,
                searching: true,

                pageLength: 5,

                lengthMenu: [
                    [5, 10, 15, -1],
                    [5, 10, 15, "All"]
                ],
                ajax: {
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '/api/edukasi-table',
                    type: 'POST',
                    data: {
                        id: id
                    },
                },
                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false
                    },
                    {
                        data: 'nama',
                        orderable: true
                    },
                    {
                        data: 'action',
                        name: '#',
                        orderable: false
                    },
                ]
            });
        }





        /** set data untuk edit**/
        function setData(result) {
            $('input[name=id]').val(result.id);
            $('input[name=intervensi]').val(result.intervensi_keperawatan);
            $('.desc').val(result.pengertian);
            $('input[name=kode]').val(result.kode);

        }


        /** reload dataTable Setelah mengubah data**/
        function reloadDatatable() {
            dataTable.ajax.reload();
        }

    </script>

    <script>
        function createItem() {
            setForm('create', 'POST', ('Create {{ $title }}'), true)

        }

        function editItem(id) {
            setForm('update', 'PUT', 'Edit {{ $title }}', true)
            editData(id)


        }

        function deleteItem(id) {
            deleteConfirm(id)

        }

    </script>



@endpush
