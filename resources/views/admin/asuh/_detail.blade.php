<div class="modal fade " id="modalDetail" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl " role="document">
        <div class="modal-content p-3">
            <div class="modal-header">
                <h4 class="modal-title" id="modalFormTitle">Detail Data</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-6">
                        <div>Penanggung Jawab</div>
                        <h4 id="penjaw" class="text-bold"></h4>
                        <div>Diagnosis Keperawatan</div>
                        <h4 class="diagnosis" class="text-bold"></h4>
                        <div>Tanggal dan Jam</div>
                        <h4 id="time" class="text-bold"></h4>
                    </div>
                    <div class="col-6">
                        <div>Nama Ruangan</div>
                        <h4 id="room" class="text-bold"></h4>
                        <div>PPJA</div>
                        <h4 id="ppja" class="text-bold"></h4>
                    </div>
                </div>
                <hr>
                <h3>Diagnosis Keperawatan</h3>

                <div class="row">
                    <div class="col-6">
                        <h6 class="diagnosis"></h6>
                        <p>Berhubungan dengan : </p>
                        <ul class="ml-2 penyebab">

                        </ul>

                    </div>
                    <div class="col-6">
                        <p>Dibuktikan dengan : </p>
                        <h6>Data Subjektif</h6>
                        <ul class="ml-2 subjek">

                        </ul>
                        <h6>Data Objektif</h6>
                        <ul class="ml-2 objek">

                        </ul>
                    </div>
                </div>
                <hr>

                <div class="text-center">
                    <h2>Perencanaan</h2>
                </div>
                <hr>
                <h3>Luaran dan Kriteria Hasil</h3>

                <span> Setelah dilakukan intervensi selama</span>
                <span class="lamaIntervensi"></span> x 24 jam, <span class="luaran"></span> <span>meningkat dengan kriteria hasil:</span>
                <ul class="ml-2 kriteriaHasil">

                </ul>
                <hr>
                <h3 class="mb-4">Intervensi Keperawatan</h3>
                <div class="data">

                </div>



            </div>
            <div class="modal-footer">

                <button type="button" id="print" class="btn  waves-effect btn-primary"></button>
                <button type="button" id="download" class="btn  waves-effect btn-info"></button>
                <button type="button" class="btn  waves-effect btn-danger" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
