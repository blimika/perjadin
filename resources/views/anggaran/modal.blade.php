<!---modal edit-->
<div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="EditModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel1">Edit Data Anggaran</h4> </div>
            <div class="modal-body">
                    <form method="POST" action="{{route('anggaran.simpanupdate')}}">
                            @csrf
                            <input type="hidden" name="anggaran_id" id="anggaranid" value="">
                            <div class="form-group">
                                <label for="tahun_anggaran">Tahun Anggaran</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="ti-lock"></i></div>
                                    <input type="text" class="form-control" name="tahun_anggaran" id="tahun_anggaran" value="" readonly="" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="mak">MAK</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="ti-user"></i></div>
                                    <input type="text" class="form-control" id="mak" name="mak" placeholder="Mata Anggaran Kegiatan" readonly=""> </div>
                                    <span class="font-13 text-muted">cth : 054.01.06.2895.004.100.524111</span>
                            </div>
                            <div class="form-group">
                                <label for="prog_kode"><span class="text-info">Kode Program</span></label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="ti-user"></i></div>
                                    <input type="text" class="form-control" id="prog_kode" name="prog_kode" placeholder="Kode Program" required=""> </div>
                                    <span class="font-13 text-muted">cth : 054.01.01</span>
                            </div>
                            <div class="form-group">
                                <label for="mak"><span class="text-info">Nama Program</span></label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="ti-user"></i></div>
                                    <input type="text" class="form-control" id="prog_nama" name="prog_nama" placeholder="Nama Program" required=""> </div>
                                    <span class="font-13 text-muted">cth : Program Penyediaan dan Pelayanan Informasi Statistik</span>
                            </div>
                            <div class="form-group">
                                <label for="mak"><span class="text-warning">Kode Kegiatan</span></label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="ti-user"></i></div>
                                    <input type="text" class="form-control" id="keg_kode" name="keg_kode" placeholder="Kode Kegiatan" required=""> </div>
                                    <span class="font-13 text-muted">cth : 2896</span>
                            </div>
                            <div class="form-group">
                                <label for="mak"><span class="text-warning">Nama Kegiatan</span></label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="ti-user"></i></div>
                                    <input type="text" class="form-control" id="keg_nama" name="keg_nama" placeholder="Nama Kegiatan" required=""> </div>
                                    <span class="font-13 text-muted">cth : Pengembangan dan Analisis Statistik</span>
                            </div>
                            <div class="form-group">
                                <label for="mak">Kode KRO</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="ti-user"></i></div>
                                    <input type="text" class="form-control" id="kro_kode" name="kro_kode" placeholder="Kode KRO"> </div>
                                    <span class="font-13 text-muted">cth : 100</span>
                            </div>
                            <div class="form-group">
                                <label for="mak">Nama KRO</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="ti-user"></i></div>
                                    <input type="text" class="form-control" id="kro_nama" name="kro_nama" placeholder="Nama KRO"> </div>
                                    <span class="font-13 text-muted">cth : Data dan Informasi Publik</span>
                            </div>
                            <div class="form-group">
                                <label for="mak"><span class="text-danger">Kode Output</span></label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="ti-user"></i></div>
                                    <input type="text" class="form-control" id="output_kode" name="output_kode" placeholder="Kode Output Kegiatan" required=""> </div>
                                    <span class="font-13 text-muted">cth : 004</span>
                            </div>
                            <div class="form-group">
                                <label for="mak"><span class="text-danger">Nama Output</span></label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="ti-user"></i></div>
                                    <input type="text" class="form-control" id="output_nama" name="output_nama" placeholder="Nama Output Kegiatan" required=""> </div>
                                    <span class="font-13 text-muted">cth : PUBLIKASI/LAPORAN ANALISIS DAN PENGEMBANGAN STATISTIK</span>
                            </div>
                            <div class="form-group">
                                <label for="mak"><span class="text-success">Kode Komponen</span></label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="ti-user"></i></div>
                                    <input type="text" class="form-control" id="komponen_kode" name="komponen_kode" placeholder="Kode Komponen Kegiatan" required=""> </div>
                                    <span class="font-13 text-muted">cth : 100</span>
                            </div>
                            <div class="form-group">
                                <label for="mak"><span class="text-success">Nama Komponen</span></label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="ti-user"></i></div>
                                    <input type="text" class="form-control" id="komponen_nama" name="komponen_nama" placeholder="Nama Komponen Kegiatan" required=""> </div>
                                    <span class="font-13 text-muted">cth : SURVEI ANGKATAN KERJA NASIONAL (SAKERNAS) SEMESTERAN</span>
                            </div>
                            <div class="form-group">
                                <label for="mak">Kode Sub Komponen</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="ti-user"></i></div>
                                    <input type="text" class="form-control" id="subkomponen_kode" name="subkomponen_kode" placeholder="Kode Sub Komponen Kegiatan"> </div>
                                    <span class="font-13 text-muted">cth : A</span>
                            </div>
                            <div class="form-group">
                                <label for="mak">Nama Sub Komponen</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="ti-user"></i></div>
                                    <input type="text" class="form-control" id="subkomponen_nama" name="subkomponen_nama" placeholder="Nama Sub Komponen Kegiatan"> </div>
                                    <span class="font-13 text-muted">cth : PELATIHAN INNAS, INDA, PETUGAS</span>
                            </div>
                            <div class="form-group">
                                <label for="mak">Kode Akun</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="ti-user"></i></div>
                                    <input type="text" class="form-control" id="akun_kode" name="akun_kode" placeholder="Kode Akun Kegiatan" required=""> </div>
                                    <span class="font-13 text-muted">cth : 521211</span>
                            </div>
                            <div class="form-group">
                                <label for="mak">Nama Akun</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="ti-user"></i></div>
                                    <input type="text" class="form-control" id="akun_nama" name="akun_nama" placeholder="Nama Akun Kegiatan" required=""> </div>
                                    <span class="font-13 text-muted">cth : Belanja Perjalanan Dinas Biasa</span>
                            </div>
                            <div class="form-group">
                                <label for="uraian">Uraian</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="ti-medall"></i></div>
                                    <input type="text" class="form-control" id="uraian" name="uraian" placeholder="Uraian Anggaran" required=""> </div>
                            </div>
                            <div class="form-group">
                                <label for="pagu">Pagu Awal</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="ti-medall-alt"></i></div>
                                    <input type="text" class="form-control" id="pagu_utama" name="pagu_utama" placeholder="Pagu Anggaran" required=""> </div>
                            </div>
                            <div class="form-group">
                                <label for="pagu">Pagu Rencana</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="ti-medall-alt"></i></div>
                                    <input type="text" class="form-control" id="pagu_rencana" name="pagu_rencana" placeholder="Pagu Rencana"> </div>
                            </div>

                            <div class="form-group">
                                <label for="unitkerja">Unitkerja</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="ti-medall-alt"></i></div>
                                    <select class="form-control select2" name="unitkerja" id="unitkerja" required="">
                                        <option>Select</option>
                                        @foreach ($DataUnitkerja as $Unit)
                                            <option value="{{ $Unit -> kode }}">[{{ $Unit -> kode }}] {{ $Unit -> nama }}</option>
                                        @endforeach
                                    </select>

                                    </div>
                            </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-inverse waves-effect waves-light" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Update Data</button>
            </div>
        </form>
        </div>
    </div>
</div>
<!--end modal edit-->
<!--modal tambah anggaran-->
<div class="modal fade" id="TambahModal" tabindex="-1" role="dialog" aria-labelledby="EditModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel1">Tambah Data Anggaran</h4> </div>
            <div class="modal-body">
                    <form method="POST" action="{{ route('anggaran.store') }}">
                    @csrf
                    @include('anggaran.formdata')

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-inverse waves-effect waves-light" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Save Data</button>
            </div>
        </form>
        </div>
    </div>
</div>
<!--end modal tambah anggaran-->
<!--modal delete anggaran-->
<div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="DeleteModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel1">Delete Data Anggaran</h4> </div>
            <div class="modal-body">
                    <form method="POST" class="form" action="{{ route('anggaran.destroy','delete') }}">
                    @csrf
                    @method('delete')
                    <input type="hidden" name="anggaran_id" id="anggaranid" value="">
                    @include('anggaran.deleteform')

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-inverse waves-effect waves-light" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Delete Data</button>
            </div>
        </form>
        </div>
    </div>
</div>
<!--end modal delete anggaran-->
<!--modal view transaksi-->
<div class="modal fade" id="ViewModal" tabindex="-1" role="dialog" aria-labelledby="ViewModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-white" id="exampleModalLabel1">Anggaran Keterpaduan</h4> </div>
            <div class="modal-body">
                <dl class="row">
                        <dt class="col-sm-3">Tahun</dt>
                        <dd class="col-sm-9"><span id="tahun_anggaran"></span></dd>
                        <dt class="col-sm-3">MAK</dt>
                        <dd class="col-sm-9"><span id="mak_anggaran"></span></dd>
                        <dt class="col-sm-3">Komponen</dt>
                        <dd class="col-sm-9"><span id="komponen"></span></dd>
                        <dt class="col-sm-3">Uraian</dt>
                        <dd class="col-sm-9"><span id="uraian_anggaran"></span></dd>
                        <dt class="col-sm-3">Subject Matter</dt>
                        <dd class="col-sm-9"><span id="sm_anggaran"></span></dd>
                        <dt class="col-sm-3">Pagu Utama</dt>
                        <dd class="col-sm-9"><span id="pagu_utama"></span></dd>
                        <dt class="col-sm-3">Pagu sudah teralokasi</dt>
                        <dd class="col-sm-9"><span id="pagu_rencana"></span></dd>
                        <dt class="col-sm-3">Sisa Pagu Utama</dt>
                        <dd class="col-sm-9"><span id="pagu_sisa"></span></dd>
                </dl>

                <table class="table" id="tabelturunan">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Bidang/Bagian</th>
                        <th>%</th>
                        <th>Pagu Alokasi</th>
                        <th>Pagu Rencana</th>
                        <th>Pagu Realisasi</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                            
                    </tfoot>
                </table>
            </div>
            <div class="modal-footer">
                <a href="" class="btn btn-success waves-effect waves-light" id="ViewAlokasi">Alokasi</a>
                <button type="button" class="btn btn-inverse waves-effect waves-light" data-dismiss="modal">Close</button>
                {{-- <button type="submit" class="btn btn-success waves-effect waves-light" id="EditView">Edit Data</button>
                <button type="button" class="btn btn-danger waves-effect waves-light" id="DeleteView">Delete Data</button> --}}
            </div>

        </div>
    </div>
</div>
<!--end modal view transaksi-->
<!--modal kunci anggaran-->
<div class="modal fade" id="KunciModal" tabindex="-1" role="dialog" aria-labelledby="KunciModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="KunciModal">Lock/Unlock Anggaran</h4> </div>
            <div class="modal-body">
                    <form method="POST" class="form" action="{{route('anggaran.kunci')}}">
                    @csrf
                    <input type="hidden" name="anggaran_id" id="anggaranid" value="">
                    <input type="hidden" name="flag_kunci" id="flag_kunci" value="">
                    @include('anggaran.kunciform')

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-inverse waves-effect waves-light" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success waves-effect waves-light m-r-10" name="btn_tulisan" id="btn_tulisan">Update</button>
            </div>
        </form>
        </div>
    </div>
</div>
<!--end modal kunci anggaran-->