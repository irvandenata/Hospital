@extends('layouts.app')

@push('styles')
    @section('content')
    <div class="row justify-content-between">
        <div class="col-5">
            <h5> Data Asuh</h5>
        </div>
        <div class="col-3 text-right mb-2">
            <button type="button" id="create" class="btn btn-outline-success">Create</button>
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
            <iframe id="printf" style="display: none" name="printf"></iframe>
        </div>

    </div>
    @include('admin.asuh._form')
    @include('admin.asuh._detail')
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
                // setForm('create', 'POST', 'Tambah Kelas', true)
                alert("belum ada")


            }
            $('#create').on('click', function () {
                $('#modalForm').modal('show');
            })

            function editItem(id) {
                // setForm('update', 'PUT', 'Ubah Kelas', true)
                // editData(id)
                alert("belum ada")
            }

            function deleteItem(id) {
                // deleteConfirm(id)
                alert("belum ada")
            }

            function setDetail(item) {

                $('#modalDetail').modal('show');
                $('#penjaw').empty()
                $('#penjaw').append(item.penanggung_jawab)
                $('#room').empty()
                $('#room').append(item.nama_ruangan)
                $('#ppja').empty()
                $('#ppja').append(item.ppja)
                $('.diagnosis').empty()
                $('.diagnosis').append(item.diagnosa.diagnosis + " ( " + item.diagnosa.kode + " )")
                $('#time').empty()
                $('#time').append(item.tanggal + " - " + item.jam)
                $('.lamaIntervensi').empty()
                $('.lamaIntervensi').append(item.jumlah_intervensi)
                $('.luaran').empty()
                $('.luaran').append(item.luaran.luaran + " ( " + item.luaran.kode + " )")
                $('.penyebab').empty()
                $('#print').empty()
                $('#download').empty()

                $('#print').append("Print")
                $('#download').append("Download")
                $('#print').data('id', item.id);
                $.each(item.hasil_diagnosa.penyebab, function (index, value) {

                    $('.penyebab').append("<li>" + value.nama + "</li>")
                });
                $('.subjek').empty()
                $.each(item.hasil_diagnosa.data_subjektif, function (index, value) {
                    $('.subjek').append("<li>" + value.nama + "</li>")
                });
                $('.objek').empty()
                $.each(item.hasil_diagnosa.data_objektif, function (index, value) {
                    $('.objek').append("<li>" + value.nama + "</li>")
                });

                $('.kriteriaHasil').empty()
                $.each(item.hasil_luaran.kriteria_hasil, function (index, value) {

                    $('.kriteriaHasil').append("<li>" + value.nama + "</li>")
                });
                $('.data').empty()

                $.each(item.intervensi, function (index, value) {
                    let no = index
                    let data = `<div class="mb-4">
                         <h5 >No. ` + (index + 1) + `</h5>
                        <h5 class="judulIntervensi">` + value.nama + ` ( ` + value.kode + `)</h5>
                    <span>Pengertian : </span> <span class="pengertianIntervensi">` + value.pengertian + `</span>
                    <div class="row mt-2">

                        <div class="col-3">
                            <h6 class="">Observasi</h6>

                            <ul class="ml-2 observasi-` + no + `">

                            </ul>

                        </div>
                        <div class="col-3">
                            <h6 class="">Terapeutik</h6>

                            <ul class="ml-2 terapeutik-` + no + `">

                            </ul>

                        </div>
                        <div class="col-3">
                            <h6 class="">Edukasi</h6>

                            <ul class="ml-2 edukasi-` + no + `">

                            </ul>

                        </div>
                        <div class="col-3">
                            <h6 class="">Kolaborasi</h6>

                            <ul class="ml-2 kolaborasi-` + no + `">

                            </ul>

                        </div>

                    </div>
                    </div>
                    <hr>
                    `

                    $('.data').append(data)
                    $.each(value.observasi, function (index, value) {
                        $('.observasi-' + no).append("<li>" + value.nama + "</li>")
                    });
                    $.each(value.terapeutik, function (index, value) {

                        $('.terapeutik-' + no).append("<li>" + value.nama + "</li>")
                    });
                    $.each(value.edukasi, function (index, value) {

                        $('.edukasi-' + no).append("<li>" + value.nama + "</li>")
                    });
                    $.each(value.kolaborasi, function (index, value) {

                        $('.kolaborasi-' + no).append("<li>" + value.nama + "</li>")
                    });
                });
            }
            $('#download').on('click', function () {
                window.location.href = '/generate-pdf/' + $('#print').data('id')
            });

            $('#print').on('click', function () {

                $.ajaxSetup({
                    url: '/generate-pdf/view/' + $('#print').data('id'),
                    type: 'GET',

                    beforeSend: function () {

                    },
                    complete: function () {

                    }
                });

                $.ajax({
                    success: function (viewContent) {
                        // console.log(typeof (viewContent))
                        var newWin = window.frames["printf"];
                        newWin.document.write(viewContent);
                        newWin.document.close();

                    }
                });
            });


            function detailItem(id) {
                $.ajax({
                    url: child_url + "/" + id,
                    type: "GET",
                    dataType: "json",
                    success: function (result) {
                        setDetail(result);
                    },
                    error: function (result) {
                        console.log(result);
                    }
                })
            }

        </script>

        <script>
            $('#diagnosa').on('change', function () {
                getObj($('#diagnosa').val())
                getSbj($('#diagnosa').val())
                getPenyebab($('#diagnosa').val())
            });

            function setObj(data) {
                $('#objektif').empty()
                $.each(data, function (index, value) {
                    console.log(value)
                    $('#objektif').append('<div class="ml-5"><input class="form-check-input objektif" name="hasil_objektif[]" type="checkbox" value="" ><label class="form-check-label" for="flexCheckChecked">' + value.nama + '</label></div>')
                });
            }

            function getObj(id) {
                $.ajax({
                    url: "/api/obj/" + id,
                    type: "GET",
                    dataType: "json",
                    success: function (result) {
                        setObj(result)
                    },
                    error: function (result) {
                        console.log(result);
                    }
                })
            }




            function setPenyebab(data) {
                $('#penyebab').empty()
                $.each(data, function (index, value) {
                    console.log(value)
                    $('#penyebab').append('<div class="ml-5"><input class="form-check-input penyebab" name="hasil_penyebab[]" type="checkbox" value="" ><label class="form-check-label" for="flexCheckChecked">' + value.nama + '</label></div>')
                });
            }

            function getPenyebab(id) {
                $.ajax({
                    url: "/api/penyebab/" + id,
                    type: "GET",
                    dataType: "json",
                    success: function (result) {
                        setPenyebab(result)
                    },
                    error: function (result) {
                        console.log(result);
                    }
                })


            }



            function setSbj(data) {
                $('#subjektif').empty()
                $.each(data, function (index, value) {
                    console.log(value)
                    $('#subjektif').append('<div class="ml-5"><input class="form-check-input subjektif" name="hasil_subjektif[]" type="checkbox" value="" ><label class="form-check-label" for="flexCheckChecked">' + value.nama + '</label></div>')
                });
            }

            function getSbj(id) {
                $.ajax({
                    url: "/api/sbj/" + id,
                    type: "GET",
                    dataType: "json",
                    success: function (result) {
                        setSbj(result)
                    },
                    error: function (result) {
                        console.log(result);
                    }
                })


            }


            $('#luaran').on('change', function () {
                getKriteria($('#luaran').val())
            });

            function setKriteria(data) {
                $('#kriteriahasil').empty()
                $.each(data, function (index, value) {
                    console.log(value)
                    $('#kriteriahasil').append('<div class="ml-5"><input class="form-check-input kriteriahasil" name="hasil_kriteriahasil[]" type="checkbox" value=""><label class="form-check-label" for="flexCheckChecked">' + value.nama + '</label></div>')
                });
            }

            function getKriteria(id) {
                $.ajax({
                    url: "/api/kriteria/" + id,
                    type: "GET",
                    dataType: "json",
                    success: function (result) {
                        setKriteria(result)
                    },
                    error: function (result) {
                        console.log(result);
                    }
                })


            }
            $('#tambahIntervensi').on('click', function () {
                getIntervensi($('#intervensiSelect').val())

            })

            function getIntervensi(id) {
                $.ajax({
                    url: "/api/intervensi/" + id,
                    type: "GET",
                    dataType: "json",
                    success: function (result) {
                        setIntervensi(result)
                    },
                    error: function (result) {
                        console.log(result);
                    }
                })


            }

            function removeIntervensi(id) {
                $('#data-' + id).remove()
            }


            function setIntervensi(data) {
                if ($('#data-' + data.id).children().length > 0) {
                    $('#data-' + data.id).remove()
                }
                $('#intervensiAdd').append('<div class="row" id="data-' + data.id + '"> <div class="btn btn-danger btn-sm ml-2 mb-2" onClick="removeIntervensi(' + data.id + ')" data-id="' + data.id + '" id="hapusIntervensi-' + data.id + '" style="margin-top: 30px  ">Hapus</div><div class="col-12"><div> <p>Nama Intervensi</p><h5>' + data.nama + '</h5><p>Pengertian</p><h6>' + data.pengertian + '</h6></div><hr></div><div class="col-3"><div class="form-group "><label for="type">Kolaborasi</label><div id="kolaborasi-' + data.id + '"></div></div></div><div class="col-3"><div class="form-group "><label for="type">Terapeutik</label><div id="terapeutik-' + data.id + '"></div></div></div><div class="col-3"><div class="form-group ">    <label for="type">Edukasi</label>    <div id="edukasi-' + data.id + '"></div></div> </div><div class="col-3"><div class="form-group ">    <label for="type">Observasi</label>    <div id="observasi-' + data.id + '"></div></div></div></div><hr>')
                $.each(data.kolaborasi, function (index, value) {
                    $('#kolaborasi-' + data.id).append('<div class="ml-5"><input class="form-check-input kolaborasi" name="hasil_kolaborasi[]" type="checkbox" value=""><label class="form-check-label" for="flexCheckChecked">' + value.nama + '</label></div>')
                });
                $.each(data.observasi, function (index, value) {

                    $('#observasi-' + data.id).append('<div class="ml-5"><input class="form-check-input observasi" name="hasil_observasi[]" type="checkbox" value=""><label class="form-check-label" for="flexCheckChecked">' + value.nama + '</label></div>')
                });
                $.each(data.terapeutik, function (index, value) {

                    $('#terapeutik-' + data.id).append('<div class="ml-5"><input class="form-check-input terapeutik" name="hasil_terapeutik[]" type="checkbox" value=""><label class="form-check-label" for="flexCheckChecked">' + value.nama + '</label></div>')
                });
                $.each(data.edukasi, function (index, value) {

                    $('#edukasi-' + data.id).append('<div class="ml-5"><input class="form-check-input edukasi" name="hasil_edukasi[]" type="checkbox" value=""><label class="form-check-label" for="flexCheckChecked">' + value.nama + '</label></div>')
                });

            }

        </script>




    @endpush
