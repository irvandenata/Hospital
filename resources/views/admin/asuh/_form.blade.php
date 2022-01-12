@extends('crud.modal')
@section('input-form')
<div class="row">
    <div class="col-6">
        <div class="form-group">
            <div class="form-line">
                <label for="name">Nama Penanggung Jawab</label>
                <input type="text" name="penanggung_jawab" class="form-control" required>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-line mt-2">
                        <label for="name">Tanggal</label> <input type="text" name="tanggal" class="form-control" required>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-line mt-2">
                        <label for="name">Jam</label> <input type="text" name="jam" class="form-control" required>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <div class="form-line">
                <label for="name">Nama Ruangan</label>
                <input type="text" name="nama_ruangan" class="form-control" required>
            </div>
            <div class="form-line mt-2">
                <label for="name">PPJA</label>
                <input type="text" name="ppja" class="form-control" required>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label for="type">Diagnosa</label>
            <select class="form-control show-tick" name="diagnosa_id" id="diagnosa" required>
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
                <label for="name">Jumlah Intervensi dalam 24 Jam</label> <input type="number" name="jumlah_intervensi" class="form-control" required>
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
        <div class="form-group ">
            <label for="type">Kriteria Hasil</label>
            <div id="kriteriahasil">

            </div>

        </div>
    </div>
    <div class="col-10">
        <div class="form-group">
            <label for="type">Intervensi</label>
            <select class="form-control show-tick" name="intervensi_id" id="intervensiSelect" required>
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



{{-- <div class="form-group">
    <div class="form-line">
        <label for="number">Gambar Produk</label>
        <input type="text" name="name" class="form-control">
    </div>
</div> --}}

{{-- <div class="form-group">
   <label for="type">Pilih Salah Satu</label>
   <select class="form-control show-tick" name="type_id" id="typeID" required>
      <option disabled selected value>---- Pilih Salah Satu ----</option>
@foreach($type as $item)
      <option value="{!! $item->id !!}">{!! $item->name !!}</option>
@endforeach
   </select>
</div> --}}

@endsection
