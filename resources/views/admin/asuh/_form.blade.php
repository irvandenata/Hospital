@extends('crud.modal')
@section('input-form')
<div class="row">
    <div class="col-6">
        <div class="form-group">
            <input type="hidden" name="id" id="id">
            <div class="form-line">
                <label for="name">Nama Kepala Ruangan</label>
                <input type="text" id="pj" name="penanggung_jawab" class="form-control pj" required>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-line mt-2">
                        <label class="control-label ">Tanggal</label>
                        <div class="">
                            <div class="input-group">
                                <input autocomplete="off" type="text" class="form-control tgl" name="tanggal" placeholder="mm/dd/yyyy" id="datepicker-autoclose" required>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="ti-calendar"></i></span>
                                </div>
                            </div><!-- input-group -->
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-line mt-2">
                        <label for="name">Jam</label>
                        <div class="input-group">
                            <input autocomplete="off" id="timepicker2"  name="jam" type="text" class="form-control wkt" required>
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="mdi mdi-clock"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <div class="form-line">
                <label for="name">Nama Ruangan</label>
                <input type="text" name="nama_ruangan" class="form-control ruang" required>
            </div>
            <div class="form-line mt-2">
                <label for="name">PPJA</label>
                <input type="text" name="ppja" class="form-control ppja" required>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label for="type">Diagnosa</label>
            <select class="form-control show-tick diagnosa" name="diagnosa_id" id="diagnosa" required>
                <option disabled selected value>---- Pilih Salah Satu ----</option>
                @foreach($diagnosa as $item)
                    <option value="{!! $item->id !!}">{!! $item->diagnosis !!} - {!! $item->kode !!}</option>
                @endforeach
            </select>
        </div>

    </div>
    <div class="col-4">
        <div class="form-group ">
            <label for="type">Penyebab</label>
            <div id="penyebab">

            </div>

        </div>
    </div>
    <div class="col-4">
        <div class="form-group ">
            <label for="type">Data Objektif</label>
            <div id="objektif">

            </div>

        </div>
    </div>
    <div class="col-4">
        <div class="form-group ">
            <label for="type">Data Subjektif</label>
            <div id="subjektif">

            </div>

        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <div class="form-line">
                <label for="name">Jumlah Intervensi dalam 24 Jam</label> <input type="number" name="jumlah_intervensi" class="form-control interv" required>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label for="type">Luaran</label>
            <select class="form-control show-tick" name="luaran_id" id="luaran" required>
                <option disabled selected value>---- Pilih Salah Satu ----</option>
                @foreach($luaran as $item)
                    <option value="{!! $item->id !!}">{!! $item->luaran !!} - {!! $item->kode !!}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label for="type">Ekspektasi Luaran</label>
            <select class="form-control show-tick ekspektasi" name="ekspektasi" id="luaran" required>
                <option disabled selected value>---- Pilih Salah Satu ----</option>
                    <option value="Meningkat">Meningkat</option>
                    <option value="Menurun">Menurun</option>
                    <option value="Membaik">Membaik</option>

            </select>
        </div>
    </div>
    <div class="col-12">
        <div class="form-group ">
            <label for="type">Kriteria Hasil</label>
            <div id="kriteriahasil">

            </div>

        </div>
    </div>
    <div class="col-10">
        <div class="form-group">
            <label for="type">Intervensi</label>
            <select class="form-control show-tick" id="intervensiSelect" >
                <option disabled selected value>---- Pilih Salah Satu ----</option>
                @foreach($intervensi as $item)
                    <option value="{!! $item->id !!}">{!! $item->intervensi_keperawatan !!} - {!! $item->kode !!}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-2">
        <div class="btn btn-primary " id="tambahIntervensi" style="margin-top: 30px  ">Tambah</div>
    </div>
    <div class="col-12" id="intervensiAdd">

    </div>
</div>


@endsection
