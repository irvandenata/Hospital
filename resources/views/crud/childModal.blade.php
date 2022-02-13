<div class="modal fade " id="modalChildForm" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md " role="document">
        <div class="modal-content p-3">
            <form method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <input id="idChild" type="hidden" name="id" value="">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalFormTitle">Edit Data</h4>
                </div>
                <div class="modal-body">
                    @yield('child-form')
                </div>
                <div class="modal-footer">
                    <button type="submit" id="sendName" class="btn  waves-effect btn-primary" data-dismiss="modal">Simpan</button>
                    <button type="button" class="btn  waves-effect btn-danger" data-dismiss="modal">Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
