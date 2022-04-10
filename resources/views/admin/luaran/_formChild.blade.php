@extends('crud.childModal')
@section('child-form')
<div class="form-group">
    <div class="form-line">
        <label for="name">Nama</label>
        <input type="text" name="nama" class="form-control nama" required>
    </div>

    <div class="form-group">
        <label for="type">Kelompok Kriteria</label>
        <select class="form-control show-tick kelompokEdit" name="kelompok" id="kelompok" required>
            <option disabled selected value>---- Pilih Salah Satu ----</option>
            <option value="Menurun;Cukup Menurun;Sedang;Cukup Meningkat;Meningkat">Kelompok 1 : Menurun, Cukup Menurun, Sedang, Cukup Meningkat, Meningkat</option>
            <option value="Meningkat;Cukup Meningkat;Sedang;Cukup Menurun;Menurun">Kelompok 2 : Meningkat, Cukup Meningkat, Sedang, Cukup Menurun, Menurun</option>
            <option value="Memburuk;Cukup Memburuk;Sedang;Cukup Membaik;Membaik">Kelompok 3 : Memburuk, Cukup Memburuk, Sedang, Cukup Membaik, Membaik</option>

        </select>
    </div>
</div>

{{-- <div class="form-group">
    <div class="form-line">
        <label for="number">Gambar Produk</label>
        <input type="text" name="theme" class="form-control">
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
