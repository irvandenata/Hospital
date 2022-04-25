@extends('layouts.app')
@section('title', $title)
@push('styles')
    <link href="{{ asset('admin') }}/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin') }}/plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
      <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')
<div class="row justify-content-between">
    <div class="col-12 text-right mb-2">
        <button type="button" id="reload" class="btn btn-outline-warning">Reload</button>
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
    <script src="{{ asset('admin') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('admin') }}/plugins/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('admin') }}/plugins/timepicker/bootstrap-timepicker.min.js"></script>
    <script src="{{ asset('admin') }}/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush

@push('js')
    @include('crud.js')
    <script>
        $('#datepicker-autoclose').datepicker({
            autoclose: true,
            todayHighlight: true
        });

        $('#timepicker2').timepicker({
            showMeridian: false,
            icons: {
                up: 'mdi mdi-chevron-up',
                down: 'mdi mdi-chevron-down'
            }
        });

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

        function reloadDatatable() {
            dataTable.ajax.reload();
        };

    </script>

    <script>
        function createItem() {
            // setForm('create', 'POST', 'Tambah Kelas', true)
            // alert("belum ada")


        }

        $('#diagnosa').select2()
        $('#luaran').select2()
        $('#intervensiSelect').select2()
        $('#create').on('click', function () {
            $('#kriteriahasil').empty()
            $('#subjektif').empty()
            $('#penyebab').empty()
            $('#objektif').empty()
            $('#intervensiAdd').empty()
            setForm('create', 'POST', 'Tambah Data', true)
        })
        $('#reload').on('click', function () {
            reloadDatatable()
        })






        /// EDIT ITEM
        function editItem(id) {

            $.ajax({
                url: child_url + "/" + id,
                type: "GET",
                dataType: "json",
                success: function (result) {
                    // console.log(result)
                    setItem(result);
                },
                error: function (result) {
                    console.log(result);
                }
            })
        }


        async function setItem(data) {
            sessionStorage.setItem("subj", (data.tambahan_diagnosa_subjektif == null ? '' : data.tambahan_diagnosa_subjektif));
            sessionStorage.setItem("obj", (data.tambahan_diagnosa_objektif == null ? '' : data.tambahan_diagnosa_objektif));
            sessionStorage.setItem("peny", (data.tambahan_diagnosa_penyebab == null ? '' : data.tambahan_diagnosa_penyebab));
            $('#intervensiAdd').empty()
            sessionStorage.setItem('idEdit', data.id)
            $(`.diagnosa option[value='${data.diagnosa.id}']`).attr('selected', 'selected');
            await getEditObj($('#diagnosa').val(), data.hasil_diagnosa.data_subjektif)
            await getEditSbj($('#diagnosa').val(), data.hasil_diagnosa.data_objektif)
            await getEditPenyebab($('#diagnosa').val(), data.hasil_diagnosa.penyebab)
            await $(`#luaran option[value='${data.luaran.id}']`).attr('selected', 'selected');
            await $('#pj').val(data.penanggung_jawab)
            $('#id').val(data.id)
            $('.tgl').val(data.tanggal)
            $('.wkt').val(data.jam)

            if(data.status_pertama==1){
                $('#status').prop('checked', true);
            }else{
                $('#status').prop('checked', false);
            }
            $('.ekspektasi option[value="' + data.ekspektasi + '"]').prop("selected", true);
            $('.ruang').val(data.nama_ruangan)
            $('.ppja').val(data.ppja)
            $('.interv').val(data.jumlah_intervensi)
            await getEditKriteria($('#luaran').val(), data.hasil_luaran.kriteria_hasil,data.hasil_luaran.kriteria_sub)
            $.each(data.intervensi, function (index, value) {
                getEditIntervensi(value.id, value)
            });
            sessionStorage.setItem('id', $('#id').val())
            await setForm('update', 'PUT', 'Ubah Data', true)
        }

        function setEditObj(data, res) {
            $('#objektif').empty()
            let ang = res
            $.each(data, function (index, value) {
                var cek = ''
                $.each(ang, function (index, b) {
                    if (value.id == b.id) {
                        cek = 'checked'
                    }
                })
                $('#objektif').append('<div class="ml-5"><input class="form-check-input objektif" name="hasil_objektif[]" type="checkbox" value="' + value.id + '"' + cek + '><label class="form-check-label" for="flexCheckChecked">' + value.nama + '</label></div>')
            });

            $('#objektif').append('<input type="text" name="tambahan_diagnosa_objektif" class="form-control mt-2" placeholder="Tambahan objektif" value="' + sessionStorage.getItem('obj') + '">')
        }

        function getEditObj(id, data) {
            $.ajax({
                url: "/api/obj/" + id,
                type: "GET",
                dataType: "json",
                success: function (result) {
                    setEditObj(result, data)
                },
                error: function (result) {
                    console.log(result);
                }
            })
        }

        function setEditPenyebab(data, res) {
            $('#penyebab').empty()
            let ang = res
            $.each(data, function (index, value) {
                var cek = ''
                $.each(ang, function (index, b) {
                    if (value.id == b.id) {
                        cek = 'checked'
                    }
                })

                $('#penyebab').append('<div class="ml-5"><input class="form-check-input penyebab" name="hasil_penyebab[]" type="checkbox" value="' + value.id + '"' + cek + '><label class="form-check-label" for="flexCheckChecked">' + value.nama + '</label></div>')
            });
            $('#penyebab').append('<input type="text" name="tambahan_diagnosa_penyebab" class="form-control mt-2" placeholder="Tambahan Penyebab" value="' + sessionStorage.getItem('peny') + '">')

        }

        function getEditPenyebab(id, data) {
            $.ajax({
                url: "/api/penyebab/" + id,
                type: "GET",
                dataType: "json",
                success: function (result) {
                    setEditPenyebab(result, data)
                },
                error: function (result) {
                    console.log(result);
                }
            })


        }

        function setEditSbj(data, res) {
            $('#subjektif').empty()

            let ang = res
            $.each(data, function (index, value) {
                var cek = ''
                $.each(ang, function (index, b) {
                    if (value.id == b.id) {
                        cek = 'checked'
                    }
                })
                $('#subjektif').append('<div class="ml-5"><input class="form-check-input subj subjektif-' + value.id + '" name="hasil_subjektif[]" type="checkbox" value="' + value.id + '" ' + cek + '><label class="form-check-label" for="flexCheckChecked">' + value.nama + '</label></div>')
            });
            $('#subjektif').append('<input type="text" name="tambahan_diagnosa_subjektif" class="form-control mt-2" placeholder="Tambahan Subjektif" value="' + sessionStorage.getItem('subj') + '">')

        }

        function getEditSbj(id, data) {
            // console.log(data)
            $.ajax({
                url: "/api/sbj/" + id,
                type: "GET",
                dataType: "json",
                success: function (result) {
                    setEditSbj(result, data)
                },
                error: function (result) {
                    console.log(result);
                }
            })


        }

        function setEditKriteria(data, result,mentah) {

            let ang = result
            let dataKriteria = data
            let mentahKriteria = mentah.split("/")
            // console.log(mentahKriteria)
            $('#kriteriahasil').empty()
            $.each(data, function (index, value) {
                var cek = ''
                $.each(ang, function (index, b) {
                    if (value.id == b.id) {
                        cek = 'checked'
                    }
                })
                $('#kriteriahasil').append('<div class="ml-5"><input id="kriteria-'+value.id+'" class="form-check-input pilihKriteria" name="hasil_kriteriahasil[]" type="checkbox" value="' + value.id + '" ' + cek + '><label class="form-check-label" for="flexCheckChecked">' + value.nama + '</label><div class="tampKrit"></div></div>')
                $.each(ang, function (index, b) {

                       $('.pilihKriteria').click(async function () {
                            if ($(this).is(":checked")) {

                                var kri = data[data.findIndex(x => x.id == $(this).val())].kelompok.split(";");
                                await $(this).parent().find('.tampKrit').append(`  <select class="form-control show-tick subkrit my-2" name="hasil_kriteria2[]" ><option disabled selected value>---- Pilih Salah Satu ----</option></select>`)
                                var com = this
                                // console.log($(this).parent().find('.tampKrit'))
                                $.each(kri, function (index, value) {
                                    $(com).parent().find('.tampKrit').find('.subkrit').append('<option value="' + value + '">' + value + '</option>')
                                });
                            } else if ($(this).is(":not(:checked)")) {
                                $(this).parent().find('.tampKrit').empty()
                            }
                        });
                })

                 if ( cek == 'checked') {
                        // console.log(data.findIndex(x => x.id == value.id))
                        var kri = data[data.findIndex(x => x.id == value.id)].kelompok.split(";");
                        // console.log(kri)
                        var kri = dataKriteria[data.findIndex(x => x.id == value.id)].kelompok.split(";");
                                $("#kriteria-"+value.id).parent().find('.tampKrit').append(`<select class="form-control show-tick subkrit my-2" name="hasil_kriteria2[]" ><option disabled selected value>---- Pilih Salah Satu ----</option></select>`)
                                let id = value.id
                                // console.log($("#kriteria-"+value.id).parent().find('.tampKrit'))
                                $.each(kri, function (index, value) {
                                    $("#kriteria-"+id).parent().find('.tampKrit').find('.subkrit').append('<option value="' + value + '">' + value + '</option>')
                                });
                                // console.log(mentahKriteria[index].split("-")[1])
                       $("#kriteria-"+id).parent().find('.tampKrit').find('.subkrit option[value="'+ mentahKriteria[index].split("-")[1] +'"]').attr('selected','selected');
                    }



            });
        }

        function getEditKriteria(id, res,data) {

            $.ajax({
                url: "/api/kriteria/" + id,
                type: "GET",
                dataType: "json",
                success: function (result) {
                    setEditKriteria(result, res,data)
                },
                error: function (result) {
                    console.log(result);
                }
            })


        }


        function getEditIntervensi(id, res) {
            $.ajax({
                url: "/api/intervensi/" + id,
                type: "GET",
                dataType: "json",
                success: function (result) {
                    setEditIntervensi(result, res)
                },
                error: function (result) {
                    console.log(result);
                }
            })


        }

        function setEditIntervensi(data, result) {
            let ang = result
            if ($('#data-' + data.id).children().length > 0) {
                $('#data-' + data.id).remove()
            }

            $('#intervensiAdd').append('<div class="row" id="data-' + data.id + '"> <input type="hidden" name="intervensi_id[]"  class="form-control" value="' + data.id + '" ><div class="btn btn-danger btn-sm ml-2 mb-2" onClick="removeIntervensi(' + data.id + ')" data-id="' + data.id + '" id="hapusIntervensi-' + data.id + '" style="margin-top: 30px  ">Hapus</div><div class="col-12"><div> <p>Nama Intervensi</p><h5>' + data.nama + '</h5><p>Pengertian</p><h6>' + data.pengertian + '</h6></div><hr></div><div class="col-3"><div class="form-group "><label for="type">Kolaborasi</label><div id="kolaborasi-' + data.id + '"></div></div></div><div class="col-3"><div class="form-group "><label for="type">Terapeutik</label><div id="terapeutik-' + data.id + '"></div></div></div><div class="col-3"><div class="form-group ">    <label for="type">Edukasi</label>    <div id="edukasi-' + data.id + '"></div></div> </div><div class="col-3"><div class="form-group ">    <label for="type">Observasi</label>    <div id="observasi-' + data.id + '"></div></div></div><div class="col-12"><hr></div> </div>')
            $.each(data.kolaborasi, function (index, value) {
                var cek = ''
                $.each(ang.hasil_kolaborasi, function (index, b) {
                    if (value.id == b.id) {
                        cek = 'checked'
                    }
                })
                $('#kolaborasi-' + data.id).append('<div class="ml-5"><input class="form-check-input kolaborasi" name="hasil_kolaborasi_' + data.id + '[]" type="checkbox" value="' + value.id + '" ' + cek + '><label class="form-check-label" for="flexCheckChecked">' + value.nama + '</label></div>')
            });
            $.each(data.observasi, function (index, value) {
                var cek = ''
                $.each(ang.hasil_observasi, function (index, b) {
                    if (value.id == b.id) {
                        cek = 'checked'
                    }
                })
                $('#observasi-' + data.id).append('<div class="ml-5"><input class="form-check-input observasi" name="hasil_observasi_' + data.id + '[]" type="checkbox" value="' + value.id + '" ' + cek + '><label class="form-check-label" for="flexCheckChecked">' + value.nama + '</label></div>')
            });
            $.each(data.terapeutik, function (index, value) {
                var cek = ''
                $.each(ang.hasil_terapeutik, function (index, b) {
                    if (value.id == b.id) {
                        cek = 'checked'
                    }
                })
                $('#terapeutik-' + data.id).append('<div class="ml-5"><input class="form-check-input terapeutik" name="hasil_terapeutik_' + data.id + '[]" type="checkbox" value="' + value.id + '" ' + cek + '><label class="form-check-label" for="flexCheckChecked">' + value.nama + '</label></div>')
            });
            $.each(data.edukasi, function (index, value) {
                var cek = ''
                $.each(ang.hasil_edukasi, function (index, b) {
                    if (value.id == b.id) {
                        cek = 'checked'
                    }
                })
                $('#edukasi-' + data.id).append('<div class="ml-5"><input class="form-check-input edukasi" name="hasil_edukasi_' + data.id + '[]" type="checkbox" value="' + value.id + '" ' + cek + '><label class="form-check-label" for="flexCheckChecked">' + value.nama + '</label></div>')
            });

        }



        ///DETAIL ITEM

        function setDetail(item) {
            // console.log(item)
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
            $('.ekspektasiDetail').empty()
            $('#print').empty()
            $('#download').empty()

            $('#print').append("Print")
            $('#download').append("Download")
            $('#print').data('id', item.id);
            $('.ekspektasiDetail').append(item.ekspektasi)
            $.each(item.hasil_diagnosa.penyebab, function (index, value) {

                $('.penyebab').append("<li>" + value.nama + "</li>")
            });
            (item.tambahan_diagnosa_penyebab != null) ? $('.penyebab').append("<li>Tambahan : " + item.tambahan_diagnosa_penyebab + "</li>"): '';
            $('.subjek').empty()
            $.each(item.hasil_diagnosa.data_subjektif, function (index, value) {
                $('.subjek').append("<li>" + value.nama + "</li>")
            });
            (item.tambahan_diagnosa_subjektif != null) ? $('.subjek').append("<li>Tambahan : " + item.tambahan_diagnosa_penyebab + "</li>"): '';

            $('.objek').empty()
            $.each(item.hasil_diagnosa.data_objektif, function (index, value) {
                $('.objek').append("<li>" + value.nama + "</li>")
            });
            (item.tambahan_diagnosa_objektif != null) ? $('.objek').append("<li>Tambahan : " + item.tambahan_diagnosa_penyebab + "</li>"): '';


            $('.kriteriaHasil').empty()
            $.each(item.hasil_luaran.kriteria_hasil, function (index, value) {

                $('.kriteriaHasil').append("<li>" + value.nama + " : " +item.hasil_luaran.kriteria_sub.split("/")[index].split("-")[1]+ "</li>")
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
                $.each(value.hasil_observasi, function (index, value) {
                    $('.observasi-' + no).append("<li>" + value.nama + "</li>")
                });
                $.each(value.hasil_terapeutik, function (index, value) {

                    $('.terapeutik-' + no).append("<li>" + value.nama + "</li>")
                });
                $.each(value.hasil_edukasi, function (index, value) {

                    $('.edukasi-' + no).append("<li>" + value.nama + "</li>")
                });
                $.each(value.hasil_kolaborasi, function (index, value) {

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
                    // console.log(result)
                    setDetail(result);
                },
                error: function (result) {
                    console.log(result);
                }
            })
        }


        ///delete
        function deleteItem(id) {
            deleteConfirm(id)
            // alert("belum ada")
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
                $('#objektif').append('<div class="ml-5"><input class="form-check-input objektif" name="hasil_objektif[]" type="checkbox" value="' + value.id + '"><label class="form-check-label" for="flexCheckChecked">' + value.nama + '</label></div>')
            });
            $('#objektif').append('<input type="text" name="tambahan_diagnosa_objektif" class="form-control mt-2" placeholder="Tambahan Objektif">')
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

                $('#penyebab').append('<div class="ml-5"><input class="form-check-input penyebab" name="hasil_penyebab[]" type="checkbox" value="' + value.id + '"><label class="form-check-label" for="flexCheckChecked">' + value.nama + '</label></div>')
            });
            $('#penyebab').append('<input type="text" name="tambahan_diagnosa_penyebab" class="form-control mt-2" placeholder="Tambahan Penyebab">')
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
                $('#subjektif').append('<div class="ml-5"><input class="form-check-input subj subjektif-' + value.id + '" name="hasil_subjektif[]" type="checkbox" value="' + value.id + '"><label class="form-check-label" for="flexCheckChecked">' + value.nama + '</label></div>')
            });
            $('#subjektif').append('<input type="text" name="tambahan_diagnosa_subjektif" class="form-control mt-2" placeholder="Tambahan Subjektif">')
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
            let dataKriteria = data
            $.each(data, function (index, value) {

                $('#kriteriahasil').append('<div class="ml-5 "><input class="form-check-input pilihKriteria"  name="hasil_kriteriahasil[]" type="checkbox" value="' + value.id + '"><label class="form-check-label" for="flexCheckChecked">' + value.nama + '</label><div class="tampKrit"></div></div>')



            });
            $('.pilihKriteria').click(async function () {
                if ($(this).is(":checked")) {
                    // console.log(data)
                    // console.log($(this).val())
                    var kri = data[data.findIndex(x => x.id == $(this).val())].kelompok.split(";");
                    await $(this).parent().find('.tampKrit').append(`  <select class="form-control show-tick subkrit my-2" name="hasil_kriteria2[]" >
                        <option disabled selected value>---- Pilih Salah Satu ----</option>
                    </select>`)
                    var com = this
                    console.log($(this).parent().find('.tampKrit'))
                    $.each(kri, function (index, value) {
                        $(com).parent().find('.tampKrit').find('.subkrit').append('<option value="' + value + '">' + value + '</option>')
                    });
                } else if ($(this).is(":not(:checked)")) {
                    $(this).parent().find('.tampKrit').empty()
                }
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
            $('#intervensiAdd').append('<div class="row" id="data-' + data.id + '"> <input type="hidden" name="intervensi_id[]"  class="form-control" value="' + data.id + '" ><div class="btn btn-danger btn-sm ml-2 mb-2" onClick="removeIntervensi(' + data.id + ')" data-id="' + data.id + '" id="hapusIntervensi-' + data.id + '" style="margin-top: 30px  ">Hapus</div><div class="col-12"><div> <p>Nama Intervensi</p><h5>' + data.nama + '</h5><p>Pengertian</p><h6>' + data.pengertian + '</h6></div><hr></div><div class="col-3"><div class="form-group "><label for="type">Kolaborasi</label><div id="kolaborasi-' + data.id + '"></div></div></div><div class="col-3"><div class="form-group "><label for="type">Terapeutik</label><div id="terapeutik-' + data.id + '"></div></div></div><div class="col-3"><div class="form-group ">    <label for="type">Edukasi</label>    <div id="edukasi-' + data.id + '"></div></div> </div><div class="col-3"><div class="form-group ">    <label for="type">Observasi</label>    <div id="observasi-' + data.id + '"></div></div></div><div class="col-12"><hr></div> </div>')
            $.each(data.kolaborasi, function (index, value) {
                $('#kolaborasi-' + data.id).append('<div class="ml-5"><input class="form-check-input kolaborasi" name="hasil_kolaborasi_' + data.id + '[]" type="checkbox" value="' + value.id + '"><label class="form-check-label" for="flexCheckChecked">' + value.nama + '</label></div>')
            });
            $.each(data.observasi, function (index, value) {

                $('#observasi-' + data.id).append('<div class="ml-5"><input class="form-check-input observasi" name="hasil_observasi_' + data.id + '[]" type="checkbox" value="' + value.id + '"><label class="form-check-label" for="flexCheckChecked">' + value.nama + '</label></div>')
            });
            $.each(data.terapeutik, function (index, value) {

                $('#terapeutik-' + data.id).append('<div class="ml-5"><input class="form-check-input terapeutik" name="hasil_terapeutik_' + data.id + '[]" type="checkbox" value="' + value.id + '"><label class="form-check-label" for="flexCheckChecked">' + value.nama + '</label></div>')
            });
            $.each(data.edukasi, function (index, value) {

                $('#edukasi-' + data.id).append('<div class="ml-5"><input class="form-check-input edukasi" name="hasil_edukasi_' + data.id + '[]" type="checkbox" value="' + value.id + '"><label class="form-check-label" for="flexCheckChecked">' + value.nama + '</label></div>')
            });

        }

    </script>




@endpush
