<div class="modal fade " id="modalForm"  role="dialog">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content p-3">
            <form method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <input id="id" type="hidden" name="id" value="">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalFormTitle">Modal title</h4>
                </div>
                <div class="modal-body">
                    @yield('input-form')
                </div>
                <div class="modal-footer">
                    <button type="submit" id="simp" class="btn  waves-effect btn-primary">Simpan</button>
                    <button type="button" class="btn  waves-effect btn-danger" data-dismiss="modal">Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
