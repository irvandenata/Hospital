@extends('layouts.app')
@section('title', $title)
@push('styles')
 <link rel="stylesheet" href="{{ asset('admin') }}/plugins/morris/morris.css">
    <link href="{{ asset('admin') }}/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin') }}/plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
     <script src="{{ asset('admin') }}/js/modernizr.min.js"></script>

@endpush
@push('css')
    <style>
        .mb-0 {
            margin: 0px 0px !important
        }

    </style>
@endpush
@section('content')
<div class="row">

    <!-- end col -->

    <div class="col-xl-3 col-md-6">
        <div class="card-box">
            <div class="widget-box-2">
                <div class="widget-detail-2">
                    <h1 class="m-0"> 8451 </h1>
                    <h4 class="text-muted m-0 m-b-10">Jumlah Asuhan</h4>
                </div>
                <div class="progress progress-bar-success-alt progress-sm mb-0">
                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
                        <span class="sr-only">100% Complete</span>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- end col -->
    <div class="col-xl-3 col-md-6">
        <div class="card-box">
            <div class="widget-box-2">
                <div class="widget-detail-2">
                    <h1 class="m-0"> 8451 </h1>
                    <h4 class="text-muted m-0 m-b-10">Jumlah Data Diagnosa</h4>
                </div>
                <div class="progress progress-bar-danger-alt progress-sm mb-0">
                    <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
                        <span class="sr-only">100% Complete</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card-box">
            <div class="widget-box-2">
                <div class="widget-detail-2">
                    <h1 class="m-0"> 8451 </h1>
                    <h4 class="text-muted m-0 m-b-10">Jumlah Data Luaran</h4>
                </div>
                <div class="progress progress-bar-primary-alt progress-sm mb-0">
                    <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
                        <span class="sr-only">100% Complete</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card-box">
            <div class="widget-box-2">
                <div class="widget-detail-2">
                    <h1 class="m-0"> 8451 </h1>
                    <h4 class="text-muted m-0 m-b-10">Jumlah Data Intervensi</h4>
                </div>
                <div class="progress progress-bar-warning-alt progress-sm mb-0">
                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
                        <span class="sr-only">100% Complete</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-12">
        <div class="card-box">
            <div class="dropdown pull-right">
                <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                    <i class="mdi mdi-dots-vertical"></i>
                </a>

            </div>
            <h4 class="header-title mt-0">Data Asuhan Perhari</h4>
            <div id="morris-bar-example" style="height: 280px;"></div>
        </div>
    </div>
</div>

@endsection


@push('scripts')
    <script src="{{ asset('admin') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('admin') }}/plugins/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('admin') }}/plugins/timepicker/bootstrap-timepicker.min.js"></script>
    <script src="{{ asset('admin') }}/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

    <script src="{{ asset('admin') }}/plugins/jquery-knob/jquery.knob.js"></script>
    <script src="{{ asset('admin') }}/plugins/morris/morris.min.js"></script>
	<script src="{{ asset('admin') }}/plugins/raphael/raphael-min.js"></script>

        <!-- App js -->
    <script src="{{ asset('admin') }}/js/jquery.core.js"></script>
    <script src="{{ asset('admin') }}/js/jquery.app.js"></script>
@endpush

@push('js')
    @include('crud.js')
    <script>
      !function($) {
    "use strict";

    var Dashboard1 = function() {
    	this.$realData = []
    };

    //creates Bar chart
    Dashboard1.prototype.createBarChart  = function(element, data, xkey, ykeys, labels, lineColors) {
        Morris.Bar({
            element: element,
            data: data,
            xkey: xkey,
            ykeys: ykeys,
            labels: labels,
            hideHover: 'auto',
            resize: true, //defaulted to true
            gridLineColor: '#eeeeee',
            pointFillColors:'#eeeeee',
            labelColor: '#000000',
            pointFillColors: '#000000',
            barSizeRatio: 0.2,
            barColors: lineColors
        });
    }

    //creates line chart


    //creates Donut chart



    Dashboard1.prototype.init = function() {

        //creating bar chart
        var $barData  = [
            { y: '10', a: 75 },
            { y: '11', a: 42 },
            { y: '12', a: 75 },
            { y: '13', a: 38 },
            { y: '14', a: 19 },
            { y: '16', a: 93 },
            { y: '17', a: 56 },
            { y: '18', a: 48 },
            { y: '19', a: 79 },
        ];
        this.createBarChart('morris-bar-example', $barData, 'y', ['a'], ['Data Asuhan'], ['#188ae2']);

        //create line chart


        //creating donut chart

    },
    //init
    $.Dashboard1 = new Dashboard1
    $.Dashboard1.Constructor = Dashboard1
}(window.jQuery),

//initializing
function($) {
    "use strict";
    $.Dashboard1.init();
}(window.jQuery);

    </script>

    <script>
        function createItem() {
            // setForm('create', 'POST', 'Tambah Kelas', true)
            // alert("belum ada")


        }
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
            $('.ruang').val(data.nama_ruangan)
            $('.ppja').val(data.ppja)
            $('.ppja').val(data.ppja)
            $('.interv').val(data.jumlah_intervensi)
            await getEditKriteria($('#luaran').val(), data.hasil_luaran.kriteria_hasil)
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

        function setEditKriteria(data, result) {
            let ang = result

            $('#kriteriahasil').empty()
            $.each(data, function (index, value) {
                var cek = ''
                $.each(ang, function (index, b) {
                    if (value.id == b.id) {
                        cek = 'checked'
                    }
                })
                $('#kriteriahasil').append('<div class="ml-5"><input class="form-check-input kriteriahasil" name="hasil_kriteriahasil[]" type="checkbox" value="' + value.id + '" ' + cek + '><label class="form-check-label" for="flexCheckChecked">' + value.nama + '</label></div>')
            });
        }

        function getEditKriteria(id, res) {

            $.ajax({
                url: "/api/kriteria/" + id,
                type: "GET",
                dataType: "json",
                success: function (result) {
                    setEditKriteria(result, res)
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
            $.each(data, function (index, value) {

                $('#kriteriahasil').append('<div class="ml-5"><input class="form-check-input kriteriahasil" name="hasil_kriteriahasil[]" type="checkbox" value="' + value.id + '"><label class="form-check-label" for="flexCheckChecked">' + value.nama + '</label></div>')
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
