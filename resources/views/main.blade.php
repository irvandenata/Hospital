@extends('layouts.app')

@push('styles')
    @section('content')
    <div class="row justify-content-between">
        <div class="col-5">
            <h5> Data Asuh</h5>
        </div>
        <div class="col-3 text-right mb-2">
            <button type="button" class="btn btn-outline-success">Create</button>
        </div>
        <div class="col-md-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="datatable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th width="10%">No</th>
                                    <th>Penanggung Jawab</th>
                                    <th>Ruangan</th>
                                    <th>Tanggal</th>
                                    <th>Jam</th>
                                    <th>PPJA</th>
                                    <th width="10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @endsection


    @push('scripts')

    @endpush

    @push('js')
        @include('crud.js')
        <script>
            console.log(child_url)
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
                        data: 'penanggung_jawab',
                        orderable: true
                    },
                    {
                        data: 'nama_ruangan',
                        orderable: true
                    },
                    {
                        data: 'tanggal',
                        orderable: true
                    },
                    {
                        data: 'jam',
                        orderable: true
                    },
                    {
                        data: 'ppja',
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
            function createItem() {
                setForm('create', 'POST', 'Tambah Kelas', true)

            }

            function editItem(id) {
                setForm('update', 'PUT', 'Ubah Kelas', true)
                editData(id)
            }

            function deleteItem(id) {
                deleteConfirm(id)
            }

        </script>

        <script>
            /** set data untuk edit**/
            function setData(result) {

                $('input[name=id]').val(result.id);
                $('input[name=nama]').val(result.nama);
                $('input[name=asal]').val(result.asal);
                $("#textarea").val(result.desc)
                // $('input[name=email]').val(result.email);
                // $('input[name=stock]').val(result.stock);
                // $('input[name=cost]').val(result.cost);

                // $("#typeID option").filter(function () {
                //    return $.trim($(this).val()) == result.type_id
                // }).prop('selected', true);
                // $('#typeID').selectpicker('refresh');

            }

            /** reload dataTable Setelah mengubah data**/
            function reloadDatatable() {
                dataTable.ajax.reload();
            }

            function setSkor(result) {
                $("#detail").empty()
                // console.log(result.skor);
                total = 0
                $.each(result.skor, function () {
                    // console.log(this)


                    $("#detail").append("<tr><th scope='row'>" + this[0] + "</th><td>" + this[1] + "</td></tr>")

                    total += this[1]

                })
                $("#detail").append("<tr><th scope='row'>Total Skor</th><td>" + total + "</td></tr>")


            }


            function detail(id) {
                $.ajax({
                    url: "/admin/detail/" + id,
                    type: "GET",
                    dataType: "json",
                    success: function (result) {

                        setSkor(result);
                    },
                    error: function (result) {
                        console.log(result);
                    }
                })
                $('#modalForm2').modal('show');
            }

        </script>


    @endpush
