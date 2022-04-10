<div class="modal fade " id="modalDetail" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content">
            <input id="id" type="hidden" name="id" value="">
            <div class="modal-header">
                <h4 class="modal-title" id="modalFormTitle">Data Kriteria Hasil</h4>
            </div>
            <div class="modal-body">
                <form method="POST">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <div class="form-line">
                                    <label for="name">Kriteria Hasil</label>
                                    <input type="text" name="nama" class="form-control kriteria" placeholder="Tambahkan Data Kriteria Hasil Disini" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-5">

                            <div class="form-group">
                                <label for="type">Kelompok Kriteria</label>
                                <select class="form-control show-tick kelompok" name="kelompok" id="kelompok" required>
                                    <option disabled selected value>---- Pilih Salah Satu ----</option>
                                    <option value="Menurun;Cukup Menurun;Sedang;Cukup Meningkat;Meningkat">Kelompok 1 : Menurun, Cukup Menurun, Sedang, Cukup Meningkat, Meningkat</option>
                                    <option value="Meningkat;Cukup Meningkat;Sedang;Cukup Menurun;Menurun">Kelompok 2 : Meningkat, Cukup Meningkat, Sedang, Cukup Menurun, Menurun</option>
                                    <option value="Memburuk;Cukup Memburuk;Sedang;Cukup Membaik;Membaik">Kelompok 3 : Memburuk, Cukup Memburuk, Sedang, Cukup Membaik, Membaik</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <button type="submit" class="btn btn-primary mt-4" id="saveKriteria">Tambah</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="row">


                    <div class="col-12">

                        <table id="detailKriteria" class="table table-bordered  m-t-30" style="width: 100%">
                            <thead>
                                <tr>
                                    <th width="10%">No</th>
                                    <th>Nama</th>
                                    <th>Kelompok Kriteria</th>
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
