@extends('crud.modal')
@section('input-form')
<div class="form-group">
    <div class="form-line">
        <label for="name">Nama</label>
        <input type="text" name="diagnosis" class="form-control" required>
    </div>
</div>

<div class="form-group">
    <div class="form-line">
        <label for="description">Deskripsi</label>
        <textarea name="description" class="form-control desc" required></textarea>
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
