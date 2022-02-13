@extends('crud.modal')
@section('input-form')
<div class="form-group">
    <div class="form-line">
        <label for="name">Nama</label>
        <input type="text" name="intervensi" class="form-control" required>
    </div>
</div>
<div class="form-group">
    <div class="form-line">
        <label for="name">Kode</label>
        <input type="text" name="kode" class="form-control" required>
    </div>
</div>
<div class="form-group">
    <div class="form-line">
        <label for="description">Pengertian</label>
        <textarea name="pengertian" class="form-control desc" required></textarea>
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
