<!--modal edit-->
<div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="EditModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel1">Edit Kelengkapan</h4> </div>
            <div class="modal-body">
                    <form method="POST" name="EditKelengkapan" id="EditKelengkapan" action="{{ route('kelengkapan.simpan') }}">
                       @csrf
                    <dl class="row">
                        <dt class="col-sm-4">Tahun</dt>
                        <dd class="col-sm-8">@if (Session::has('tahun_anggaran')) {{Session::get('tahun_anggaran')}} @endif</dd>
                        <dt class="col-sm-4">Kode Trx</dt>
                        <dd class="col-sm-8"><span id="kode_trx"></span></dd>
                        <dt class="col-sm-4">Nama Pegawai</dt>
                        <dd class="col-sm-8"><span id="peg_nama"></span></dd>
                        <dt class="col-sm-4">Tujuan</dt>
                        <dd class="col-sm-8"><span id="tujuan"></span></dd>
                        <dt class="col-sm-4">Tugas</dt>
                        <dd class="col-sm-8"><span id="tugas"></span></dd>
                        <dt class="col-sm-4">Berangkat</dt>
                        <dd class="col-sm-8"><span id="brkt"></span></dd>
                        <dt class="col-sm-4">Kembali</dt>
                        <dd class="col-sm-8"><span id="kembali"></span></dd>
                    </dl>
                    <input type="hidden" id="kodetrx" name="kodetrx" value="" />
                    <input type="hidden" id="trx_id" name="trx_id" value="" />
                    <input type="hidden" id="srt_id" name="srt_id" value="">
                    <input type="hidden" id="spd_id" name="spd_id" value="">
                    <input type="hidden" id="ttd_nama" name="ttd_nama" value="">
                    <input type="hidden" id="ttd_jabatan" name="ttd_jabatan" value="">
                    <input type="hidden" id="ppk_nama" name="ppk_nama" value="">
                    @include('kelengkapan.form')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-inverse waves-effect waves-light" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger waves-effect waves-light m-r-10">Save Data</button>
            </div>
        </form>
        </div>
    </div>
</div>
<!--end modal edit-->

<!--modal batal-->
<div class="modal fade" id="BatalModal" tabindex="-1" role="dialog" aria-labelledby="BatalModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel1">Pembatalan Perjalanan Dinas</h4> </div>
            <div class="modal-body">
                    <form method="POST" action="{{ route('kelengkapan.batal','') }}">
                        @csrf
                        <dl class="row">
                            <dt class="col-sm-4">Tahun</dt>
                            <dd class="col-sm-8">@if (Session::has('tahun_anggaran')) {{Session::get('tahun_anggaran')}} @endif</dd>
                            <dt class="col-sm-4">Kode Trx</dt>
                            <dd class="col-sm-8"><span id="kode_trx"></span></dd>
                            <dt class="col-sm-4">Nomor Surat Tugas</dt>
                            <dd class="col-sm-8"><span id="nomor_surat"></span></dd>
                            <dt class="col-sm-4">Nomor SPD</dt>
                            <dd class="col-sm-8"><span id="nomor_spd"></span></dd>
                            <dt class="col-sm-4">Nama Pegawai</dt>
                            <dd class="col-sm-8"><span id="peg_nama"></span></dd>
                            <dt class="col-sm-4">Tujuan</dt>
                            <dd class="col-sm-8"><span id="tujuan"></span></dd>
                            <dt class="col-sm-4">Tugas</dt>
                            <dd class="col-sm-8"><span id="tugas"></span></dd>
                            <dt class="col-sm-4">Berangkat</dt>
                            <dd class="col-sm-8"><span id="brkt"></span></dd>
                            <dt class="col-sm-4">Kembali</dt>
                            <dd class="col-sm-8"><span id="kembali"></span></dd>
                            <dt class="col-sm-4">Total Biaya</dt>
                            <dd class="col-sm-8"><span id="totalbiaya"></span></dd>
                        </dl>
                        <input type="hidden" id="kodetrx" name="kodetrx" value="" />
                        <input type="hidden" id="trx_id" name="trx_id" value="" />
                        <input type="hidden" id="srt_id" name="srt_id" value="">
                        <input type="hidden" id="spd_id" name="spd_id" value="">
                        <input type="hidden" id="t_id" name="t_id" value="">
                        <input type="hidden" id="a_id" name="a_id" value="">
                        <input type="hidden" id="m_id" name="m_id" value="">
                        <input type="hidden" id="pagu_rencana" name="pagu_rencana" value="">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-inverse waves-effect waves-light" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger waves-effect waves-light m-r-10">Batalkan</button>
            </div>
        </form>
        </div>
    </div>
</div>
<!--end modal Batal-->

<!--modal batal-->
<div class="modal fade" id="ViewModal" tabindex="-1" role="dialog" aria-labelledby="ViewModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel1">Detil Perjalanan Dinas</h4> </div>
            <div class="modal-body">
                    <form method="POST" action="{{ route('kelengkapan.batal','') }}">
                        @csrf
                        <dl class="row">
                            <dt class="col-sm-4">Tahun</dt>
                            <dd class="col-sm-8">@if (Session::has('tahun_anggaran')) {{Session::get('tahun_anggaran')}} @endif</dd>
                            <dt class="col-sm-4">Kode Trx</dt>
                            <dd class="col-sm-8"><span id="kode_trx"></span></dd>
                            <dt class="col-sm-4">Nomor Surat Tugas</dt>
                            <dd class="col-sm-8"><span id="nomor_surat"></span></dd>
                            <dt class="col-sm-4">Nomor SPD</dt>
                            <dd class="col-sm-8"><span id="nomor_spd"></span></dd>
                            <dt class="col-sm-4">Nama Pegawai</dt>
                            <dd class="col-sm-8"><span id="peg_nama"></span></dd>
                            <dt class="col-sm-4">Tujuan</dt>
                            <dd class="col-sm-8"><span id="tujuan"></span></dd>
                            <dt class="col-sm-4">Tugas</dt>
                            <dd class="col-sm-8"><span id="tugas"></span></dd>
                            <dt class="col-sm-4">Berangkat</dt>
                            <dd class="col-sm-8"><span id="brkt"></span></dd>
                            <dt class="col-sm-4">Kembali</dt>
                            <dd class="col-sm-8"><span id="kembali"></span></dd>
                            <dt class="col-sm-4">Sumber Dana</dt>
                            <dd class="col-sm-8"><span id="sumber_dana"></span></dd>
                            <dt class="col-sm-4">Komponen</dt>
                            <dd class="col-sm-8"><span id="komponen"></span></dd>
                            <dt class="col-sm-4">Total Biaya</dt>
                            <dd class="col-sm-8"><span id="totalbiaya"></span></dd>
                            <dt class="col-sm-4">Penandatangan</dt>
                            <dd class="col-sm-8"><span id="penandatangan"></span></dd>
                            <dt class="col-sm-4">PPK</dt>
                            <dd class="col-sm-8"><span id="ppk"></span></dd>
                            <dt class="col-sm-4">Angkutan</dt>
                            <dd class="col-sm-8"><span id="kendaraan"></span></dd>
                            <dt class="col-sm-4">Cetak Tujuan SPD</dt>
                            <dd class="col-sm-8"><span class="label label-success" id="cetak_tujuan"></span></dd>
                            <dt class="col-sm-4">Status</dt>
                            <dd class="col-sm-8"><span class="label label-warning" id="status"></span></dd>
                            <dt class="col-sm-4">Status Kuitansi</dt>
                            <dd class="col-sm-8"><span class="label label-warning" id="status_kuitansi"></span></dd>
                            <dt class="col-sm-4">Status Transaksi</dt>
                            <dd class="col-sm-8"><span class="label label-info" id="status_trx"></span></dd>
                            <dt class="col-sm-4">Status Matrik</dt>
                            <dd class="col-sm-8"><span class="label label-info" id="status_matrik"></span></dd>
                        </dl>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-inverse waves-effect waves-light" data-dismiss="modal">Close</button>
            </div>
        </form>
        </div>
    </div>
</div>
<!--end modal Batal-->
