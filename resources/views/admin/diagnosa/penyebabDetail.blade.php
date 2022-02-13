<div class="modal fade " id="modalDetailPenyebab" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content">
            <input id="id" type="hidden" name="id" value="">
            <div class="modal-header">
                <h4 class="modal-title" id="modalFormTitle">Data Penyebab</h4>
            </div>
            <div class="modal-body">
                <form method="POST">
                      <div class="row">
                            <div class="col-lg-8">
                            <div class="form-group">
                                <div class="form-line">
                                    <label for="name">Penyebab</label>
                                    <input type="text" name="nama" class="form-control penyebab" placeholder="Tambahkan Penyebab Disini" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <button type="submit" class="btn btn-primary mt-4" id="savePenyebab">Tambah</button>
                                </div>
                            </div>
                        </div>
                      </div>
                    </form>
                <div class="row">


                    <div class="col-12">

                        <table id="detailPenyebab" class="table table-bordered  m-t-30" style="width: 100%">
                            <thead>
                                <tr>
                                    <th width="10%">No</th>
                                    <th>Nama</th>
                                    <th width="20%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect btn-danger" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
