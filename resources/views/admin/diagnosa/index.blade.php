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
                        <th>Diagnosis</th>
                        <th>Pengertian</th>
                        <th>Penyebab</th>
                        <th>Subjektif</th>
                        <th>Objektif</th>
                        <th width="10%">Action</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
    @include('admin.diagnosa._form')
    @include('admin.diagnosa.penyebabDetail')
    @include('admin.diagnosa.subjektifDetail')
    @include('admin.diagnosa.objektifDetail')
    @include('admin.diagnosa._formChild')
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
                    data: 'diagnosis',
                    orderable: true
                },
                {
                    data: 'definisi',
                    orderable: true
                },
                {
                    data: 'penyebab',
                    orderable: true
                },


                {
                    data: 'subjektif',
                    orderable: true
                },
                {
                    data: 'objektif',
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
        //PENYEBAB
        $('#savePenyebab').on('click', function (e) {
            if ($(".penyebab").val() != '') {
                e.preventDefault();
                savePenyebab()

            }

        })

        function savePenyebab() {

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: true,
            })

            swalWithBootstrapButtons.fire({
                title: 'Are You Sure ?',
                text: "Kamu Akan Menambah Penyebab!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes!',
                cancelButtonText: 'No, Quit!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    var nama = $(".penyebab").val();

                    $.ajax({
                        url: '/api/simpan-penyebab',
                        type: "post",
                        cache: false,
                        dataType: 'json',
                        data: {
                            nama: nama,
                            diagnosa_id: sessionStorage.getItem('idDiagnosa')
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (result) {
                            reloadDatatablePenyebab();
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
                    $(".penyebab").val('')
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

        function deletePenyebab(id) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: true,
            })

            swalWithBootstrapButtons.fire({
                title: 'Are You Sure ?',
                text: "Kamu Akan Menghapus Penyebab Ini!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes!',
                cancelButtonText: 'No, Quit!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    var screen = $("#screen").val();

                    $.ajax({
                        url: '/api/hapus-penyebab/' + id,
                        type: "DELETE",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },

                        success: function (result) {
                            reloadDatatablePenyebab();
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
                        'Penyebab Berhasil dihapus',
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

        function reloadDatatablePenyebab() {
            $('#detailPenyebab').DataTable().ajax.reload();
        }

        function detailPenyebab(id) {
            sessionStorage.setItem('idDiagnosa', id)
            $('#modalDetailPenyebab').modal('show');
            $('#detailPenyebab').dataTable().fnClearTable();
            $('#detailPenyebab').dataTable().fnDestroy();
            let dataTablePenyebab = $('#detailPenyebab').DataTable({
                dom: 'lBfrtip',
                buttons: [{
                    className: 'btn btn-warning btn-sm mr-2',
                    text: 'Reload',
                    action: function (e, dt, node, config) {
                        reloadDatatablePenyebab();
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
                    url: '/api/penyebab-table',
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

        function editChild(id,data,jenis){

            $('#idChild').val(id);
            $('.nama').val(data);
            sessionStorage.setItem('jenis',jenis)
            $('#modalChildForm').modal('show');
        }

        function updateChild(){
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
                        url: '/api/update-'+jenis+'/'+$('#idChild').val(),
                        type: "put",
                        cache: false,
                        dataType: 'json',
                        data: {
                            nama: nama,
                            id:  $('#idChild').val(),
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (result) {
                            if(jenis=='penyebab')reloadDatatablePenyebab();
                            if(jenis=='objektif')reloadDatatableObjektif();
                            if(jenis=='subjektif')reloadDatatableSubjektif();
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


        //subjektif
        $('#saveSubjektif').on('click', function (e) {
            if ($(".subjektif").val() != '') {
                e.preventDefault();
                saveSubjektif()
            }

        })

        function saveSubjektif() {

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: true,
            })

            swalWithBootstrapButtons.fire({
                title: 'Are You Sure ?',
                text: "Kamu Akan Menambah Data Subjektif!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes!',
                cancelButtonText: 'No, Quit!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    var nama = $(".subjektif").val();

                    $.ajax({
                        url: '/api/simpan-subjektif',
                        type: "post",
                        cache: false,
                        dataType: 'json',
                        data: {
                            nama: nama,
                            diagnosa_id: sessionStorage.getItem('idDiagnosa')
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (result) {
                            reloadDatatableSubjektif();
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
                        'Data Telah ditambah',
                        'success'
                    )
                    $(".subjektif").val('')

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

        function deleteSubjektif(id) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: true,
            })

            swalWithBootstrapButtons.fire({
                title: 'Are You Sure ?',
                text: "Kamu Akan Menghapus Data Subjektif Ini!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes!',
                cancelButtonText: 'No, Quit!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {

                    $.ajax({
                        url: '/api/hapus-subjektif/' + id,
                        type: "DELETE",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },

                        success: function (result) {
                            reloadDatatableSubjektif();
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
                        'Penyebab Berhasil dihapus',
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

        function reloadDatatableSubjektif() {
            $('#detailSubjektif').DataTable().ajax.reload();
        }

        function detailSubjektif(id) {

            sessionStorage.setItem('idDiagnosa', id)
            console.log(id)
            $('#modalDetailSubjektif').modal('show');
            $('#detailSubjektif').dataTable().fnClearTable();
            $('#detailSubjektif').dataTable().fnDestroy();
            let dataTablePenyebab = $('#detailSubjektif').DataTable({
                dom: 'lBfrtip',
                buttons: [{
                    className: 'btn btn-warning btn-sm mr-2',
                    text: 'Reload',
                    action: function (e, dt, node, config) {
                        reloadDatatableSubjektif();
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
                    url: '/api/subjektif-table',
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
        //OBJEKTIF
         $('#saveObjektif').on('click', function (e) {
            if ($(".objektif").val() != '') {
                e.preventDefault();
                saveObjektif()
            }

        })

        function saveObjektif() {

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: true,
            })

            swalWithBootstrapButtons.fire({
                title: 'Are You Sure ?',
                text: "Kamu Akan Menambah Data Objektif!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes!',
                cancelButtonText: 'No, Quit!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    var nama = $(".objektif").val();

                    $.ajax({
                        url: '/api/simpan-objektif',
                        type: "post",
                        cache: false,
                        dataType: 'json',
                        data: {
                            nama: nama,
                            diagnosa_id: sessionStorage.getItem('idDiagnosa')
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (result) {
                            reloadDatatableObjektif();
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
                        'Data Telah ditambah',
                        'success'
                    )
                    $(".objektif").val('')

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

        function deleteObjektif(id) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: true,
            })

            swalWithBootstrapButtons.fire({
                title: 'Are You Sure ?',
                text: "Kamu Akan Menghapus Data Objektif Ini!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes!',
                cancelButtonText: 'No, Quit!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {

                    $.ajax({
                        url: '/api/hapus-objektif/' + id,
                        type: "DELETE",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },

                        success: function (result) {
                            reloadDatatableObjektif();
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
                        'Data Berhasil dihapus',
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

        function reloadDatatableObjektif() {
            $('#detailObjektif').DataTable().ajax.reload();
        }

        function detailObjektif(id) {

            sessionStorage.setItem('idDiagnosa', id)
            $('#modalDetailObjektif').modal('show');
            $('#detailObjektif').dataTable().fnClearTable();
            $('#detailObjektif').dataTable().fnDestroy();
            let dataTableObjektif = $('#detailObjektif').DataTable({
                dom: 'lBfrtip',
                buttons: [{
                    className: 'btn btn-warning btn-sm mr-2',
                    text: 'Reload',
                    action: function (e, dt, node, config) {
                        reloadDatatableObjektif();
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
                    url: '/api/objektif-table',
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
            $('input[name=diagnosis]').val(result.diagnosis);
            $('.desc').val(result.definisi);
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
