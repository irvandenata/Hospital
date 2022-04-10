@extends('crud.modal')
@section('input-form')


<div class="form-group">
    <div class="form-line">
        <label for="description">Luaran</label>
        <textarea name="luaran" class="form-control desc" required></textarea>
    </div>
</div>

<div class="form-group">
    <div class="form-line">
        <label for="name">Kode</label>
        <input type="text" name="kode" class="form-control" required>
    </div>
</div>

{{-- <div class="form-group">
    <div class="form-line">
        <label for="number">Gambar Produk</label>
        <input type="text" name="theme" class="form-control">
    </div>
</div> --}}


@endsection
