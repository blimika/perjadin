<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kuitansi;
use App\SuratTugas;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Pegawai;
use App\Spd;
use App\Transaksi;
use PDF;
use App\Unitkerja;
use App\MatrikPerjalanan;
use App\Anggaran;
use App\TurunanAnggaran;
use App\Helpers\Tanggal;

class KuitansiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (request('flag_kuitansi') == NULL)
        {
            $flag_kuitansi = '';
        }
        else {
            $flag_kuitansi = request('flag_kuitansi');
        }
        if (Auth::user()->user_level == 2)
        {
            if (request('unitkerja') == NULL)
            {
                $flag_unitkerja = Auth::user()->user_unitkerja;
            }
            else {
                $flag_unitkerja = request('unitkerja');
            }
        }
        else
        {
            if (request('unitkerja') == NULL)
            {
                $flag_unitkerja = '';
            }
            else {
                $flag_unitkerja = request('unitkerja');
            }
        }
        $FlagTrx = config('globalvar.FlagTransaksi');
        $FlagKonfirmasi = config('globalvar.FlagKonfirmasi');
        $MatrikFlag = config('globalvar.FlagMatrik');
        $FlagSrt = config('globalvar.FlagSurat');
        $FlagTTD = config('globalvar.FlagTTD');
        $FlagKendaraan = config('globalvar.Kendaraan');
        $JenisPerjadin = config('globalvar.JenisPerjadin');
        $TipePerjadin=config('globalvar.TipePerjadin');
        $DataPPK = Pegawai::where([['jabatan','=','2'],['flag','=','1']])->orderBy('unitkerja')->get();
        $DataBidang = Unitkerja::where('eselon', '<', '4')->orderBy('kode', 'asc')->get();


        if ($flag_kuitansi=='')
        {

            $DataKuitansi = Kuitansi::with('Transaksi')
                        ->leftJoin('transaksi','transaksi.trx_id','=','kuitansi.trx_id')
                        ->leftJoin(DB::raw("(select id, unit_pelaksana from matrik) as matrik"),'transaksi.matrik_id','=','matrik.id')
                        ->where('tahun_kuitansi','=',Session::get('tahun_anggaran'))
                        ->when($flag_unitkerja,function($query) use ($flag_unitkerja) {
                            return $query->where('unit_pelaksana',$flag_unitkerja);
                        })
                        ->orderBy('flag_kuitansi','asc')
                        ->orderBy('tgl_brkt','desc')
                        ->get();

                        /*
            $DataKuitansi = Kuitansi::with('Transaksi')->where('tahun_kuitansi','=',Session::get('tahun_anggaran'))

            ->where('flag_kuitansi',request('flag_kuitansi'))
            ->orderBy('flag_kuitansi','asc')

            ->get(); */
        }
        else
        {

            $DataKuitansi = Kuitansi::with('Transaksi')
                            ->leftJoin('transaksi','transaksi.trx_id','=','kuitansi.trx_id')
                            ->leftJoin(DB::raw("(select id, unit_pelaksana from matrik) as matrik"),'transaksi.matrik_id','=','matrik.id')
                            ->where('tahun_kuitansi','=',Session::get('tahun_anggaran'))
                            ->when($flag_unitkerja,function($query) use ($flag_unitkerja) {
                                return $query->where('unit_pelaksana',$flag_unitkerja);
                            })
                            ->where('flag_kuitansi',request('flag_kuitansi'))
                            ->orderBy('flag_kuitansi','asc')
                            ->orderBy('tgl_brkt','desc')
                            ->get();

            /*
            $DataKuitansi = Kuitansi::with('Transaksi')->where('tahun_kuitansi','=',Session::get('tahun_anggaran'))

                            ->where('flag_kuitansi',request('flag_kuitansi'))
                            ->orderBy('flag_kuitansi','asc')

                            ->get();
            */
        }

        /*
        $DataKuitansi = Kuitansi::where('tahun_kuitansi','=',Session::get('tahun_anggaran'))
        ->orderBy('flag_kuitansi','asc')
        ->get();
        */
        //dd($DataKuitansi);
        return view('kuitansi.index',compact('DataKuitansi','FlagTrx','FlagKonfirmasi','FlagSrt','MatrikFlag','FlagTTD','DataPPK','FlagKendaraan','DataBidang','JenisPerjadin','flag_unitkerja','TipePerjadin'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $FlagTrx = config('globalvar.FlagTransaksi');
        $FlagKonfirmasi = config('globalvar.FlagKonfirmasi');
        $MatrikFlag = config('globalvar.FlagMatrik');
        $FlagSrt = config('globalvar.FlagSurat');
        $FlagTTD = config('globalvar.FlagTTD');
        $Bilangan = config('globalvar.Bilangan');
        $JenisPerjadin = config('globalvar.JenisPerjadin');
        $Bulan = config('globalvar.Bulan');
        $FlagKendaraan = config('globalvar.Kendaraan');
        $DataBendahara = Pegawai::where([['flag_pengelola','=','3'],['flag','=','1']])->get();
        $Bendahara = Pegawai::where([['flag_pengelola','=','3'],['flag','=','1']])->first();
        $dataTransaksi = \App\Transaksi::with('Matrik','SuratTugas','Spd','Kuitansi')->where('trx_id','=',$id)->first();
        //dd($dataTransaksi);
        return view('kuitansi.edit',compact('dataTransaksi','FlagTrx','FlagKonfirmasi','MatrikFlag','FlagTTD','FlagSrt','Bilangan','Bulan','FlagKendaraan','DataBendahara','JenisPerjadin','Bendahara'));
        //dd($dataTransaksi);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        //dd($request->all());
        if ($request->aksi == "update") {
            //dd($request->all());
            $count = Kuitansi::where('kuitansi_id','=',$request->kuitansi_id)->count();
            if ($count > 0) {
                $rill_total = 0;

                //kuitansi ada
                //cek dulu flag_jenisperjadin

                //ambil data bendahara
                $Bendahara = Pegawai::where([['flag','=','1'],['nip_baru','=',$request->bendahara_nip]])->first();
                $NamaBendahara = $Bendahara->nama;

                if ($request->jenis_perjadin == 2)
                {
                    //jenis perjadin meeting
                    $totalhotel = $request->nilaihotel * $request->hotelhari;
                    $flagHotel = 1;
                    $txt_jenisperjadin = ucwords(strtolower($request->txt_jenisperjadin));
                }
                else
                {
                    //jenis perjadin biasa
                    if (!$request->hotel_cek) {
                        //hotel_cek tidak ada ato tidak ada bukti
                        $totalhotel = ($request->nilaihotel * $request->hotelhari) * 0.3;
                        $flagHotel = 0;
                        $rill_total = $rill_total + $totalhotel;
                    }
                    else {
                        $totalhotel = $request->nilaihotel * $request->hotelhari;
                        $flagHotel = 1;
                    }
                    $txt_jenisperjadin=NULL;
                }



                $flagTransport = $request->transport_cek ? '1' : '0';

                if ($flagTransport==0) {
                    $rill_total = $rill_total + $request->nilaiTransport;
                }

                if (!$request->rill_cek1) {
                    //rill 1 tidak ada
                    $rill1_ket = NULL;
                    $rill1_rupiah = NULL;
                    $rill1_flag = 0;
                }
                else {
                    $rill1_ket = $request->rill_ket1;
                    $rill1_rupiah = $request->rill1;
                    $rill1_flag = 1;
                    $rill_total = $rill_total + $request->rill1;
                }
                if (!$request->rill_cek2) {
                    //rill 2 tidak ada
                    $rill2_ket = NULL;
                    $rill2_rupiah = NULL;
                    $rill2_flag = 0;
                }
                else {
                    $rill2_ket = $request->rill_ket2;
                    $rill2_rupiah = $request->rill2;
                    $rill2_flag = 1;
                    $rill_total = $rill_total + $request->rill2;
                }
                if (!$request->rill_cek3) {
                    //rill 3 tidak ada
                    $rill3_ket = NULL;
                    $rill3_rupiah = NULL;
                    $rill3_flag = 0;
                }
                else {
                    $rill3_ket = $request->rill_ket3;
                    $rill3_rupiah = $request->rill3;
                    $rill3_flag = 1;
                    $rill_total = $rill_total + $request->rill3;
                }
                //cek dulu sisa pagu turunan anggaran
                //kalo tidak ada sisa pagu tidak bisa di update tampilkan error
                //kalo flag_kuitansi = 0 (belum diinput di pagu_realiasi)
                //selain itu kurangi dulu pagu_realisasi dan tambah dgn realisasi baru
               //hitung manual lagi yg telah di input

                //cek dulu dengan pagu turunan anggaran
                $dataTurunanAnggaran = \App\TurunanAnggaran::where('t_id','=',$request->dana_tid)->first();
                $real_baru = $dataTurunanAnggaran->pagu_realisasi - $request->totalbiaya_sblm;
                //dd($real_baru);
                $pagu_sisa = $dataTurunanAnggaran->pagu_awal - $real_baru;

                if ($pagu_sisa >= $request->totalbiaya)
                {
                    //boleh di update kuitansinya
                    $dataKuitansi = Kuitansi::where('kuitansi_id','=',$request->kuitansi_id)->first();
                    $dataKuitansi->tgl_kuitansi = $request->tgl_kuitansi;
                    $dataKuitansi->harian_rupiah = $request->uangharian;
                    $dataKuitansi->harian_lama = $request->harian;
                    $dataKuitansi->harian_total = $request->totalharian;
                    $dataKuitansi->hotel_rupiah = $request->nilaihotel;
                    $dataKuitansi->hotel_lama = $request->hotelhari;
                    $dataKuitansi->hotel_total = $totalhotel;
                    $dataKuitansi->hotel_flag = $flagHotel;
                    $dataKuitansi->transport_rupiah = $request->nilaiTransport;
                    $dataKuitansi->transport_ket = $request->transport_ket;
                    $dataKuitansi->transport_flag = $flagTransport;
                    $dataKuitansi->bendahara_nip = $request->bendahara_nip;
                    $dataKuitansi->bendahara_nama = $NamaBendahara;
                    $dataKuitansi->flag_kuitansi = 1;
                    $dataKuitansi->total_biaya = $request->totalbiaya;
                    $dataKuitansi->rill1_ket = $rill1_ket;
                    $dataKuitansi->rill1_rupiah = $rill1_rupiah;
                    $dataKuitansi->rill1_flag = $rill1_flag;
                    $dataKuitansi->rill2_ket = $rill2_ket;
                    $dataKuitansi->rill2_rupiah = $rill2_rupiah;
                    $dataKuitansi->rill2_flag = $rill2_flag;
                    $dataKuitansi->rill3_ket = $rill3_ket;
                    $dataKuitansi->rill3_rupiah = $rill3_rupiah;
                    $dataKuitansi->rill3_flag = $rill3_flag;
                    $dataKuitansi->rill_total = $rill_total;
                    $dataKuitansi->flag_jenisperjadin = $request->jenis_perjadin;
                    $dataKuitansi->txt_jenisperjadin = $txt_jenisperjadin;
                    $dataKuitansi->flag_jeniskendaraan = $request->flag_jeniskendaraan;
                    $dataKuitansi->update();

                    //transaksi update
                    $dataTrx = \App\Transaksi::where('trx_id','=',$request->trx_id)->first();
                    $dataTrx -> flag_trx = 7;
                    $dataTrx -> update();

                    //surat tugas dan spd update status ke terlaksana
                    $dataSuratTugas = SuratTugas::where('trx_id','=',$request->trx_id)->first();
                    $dataSuratTugas->flag_surattugas = 2;
                    $dataSuratTugas->update();

                    $dataSpd = Spd::where('trx_id','=',$request->trx_id)->first();
                    $dataSpd->flag_spd = 2;
                    $dataSpd->kendaraan = $request->flag_jeniskendaraan;
                    $dataSpd->update();

                    //push realisasi ke matrik rencana
                    $matrik_id = $dataTrx->matrik_id;
                    $count_matrik = MatrikPerjalanan::where('id','=',$matrik_id)->count();
                    if ($count_matrik > 0)
                    {
                        /*
                        $dataKuitansi->tgl_kuitansi = $request->tgl_kuitansi;
                        $dataKuitansi->harian_rupiah = $request->uangharian;
                        $dataKuitansi->harian_lama = $request->harian;
                        $dataKuitansi->harian_total = $request->totalharian;
                        $dataKuitansi->hotel_rupiah = $request->nilaihotel;
                        $dataKuitansi->hotel_lama = $request->hotelhari;
                        $dataKuitansi->hotel_total = $totalhotel;
                        $dataKuitansi->hotel_flag = $flagHotel;
                        $dataKuitansi->transport_rupiah = $request->nilaiTransport;
                        $dataKuitansi->transport_ket = $request->transport_ket;
                        $dataKuitansi->transport_flag = $flagTransport;
                        $dataKuitansi->bendahara_nip = $request->bendahara_nip;
                        $dataKuitansi->bendahara_nama = $NamaBendahara;
                        $dataKuitansi->flag_kuitansi = 1;
                        $dataKuitansi->total_biaya = $request->totalbiaya;
                        $dataKuitansi->rill1_ket = $rill1_ket;
                        $dataKuitansi->rill1_rupiah = $rill1_rupiah;
                        $dataKuitansi->rill1_flag = $rill1_flag;
                        $dataKuitansi->rill2_ket = $rill2_ket;
                        $dataKuitansi->rill2_rupiah = $rill2_rupiah;
                        $dataKuitansi->rill2_flag = $rill2_flag;
                        $dataKuitansi->rill3_ket = $rill3_ket;
                        $dataKuitansi->rill3_rupiah = $rill3_rupiah;
                        $dataKuitansi->rill3_flag = $rill3_flag;
                        $dataKuitansi->rill_total = $rill_total;
                        */
                        if ($flagHotel==0 and $request->hotelhari > 0)
                        {
                            //$totalhotel = ($request->nilaihotel * $request->hotelhari) * 0.3;
                            $matrik_hotel_rupiah = $totalhotel / $request->hotelhari;
                            $matrik_rill = $rill_total - $totalhotel;
                        }
                        else
                        {
                            $matrik_hotel_rupiah = $request->nilaihotel;
                            $matrik_rill = $rill_total;
                        }
                        $dataMatrik = MatrikPerjalanan::where('id','=',$matrik_id)->first();
                        $dataMatrik->lama_harian = $request->harian;
                        $dataMatrik->dana_harian = $request->uangharian;
                        $dataMatrik->total_harian = $request->totalharian;
                        $dataMatrik->dana_transport = $request->nilaiTransport;
                        $dataMatrik->lama_hotel = $request->hotelhari;
                        $dataMatrik->dana_hotel = $matrik_hotel_rupiah;
                        $dataMatrik->total_hotel = $totalhotel;
                        $dataMatrik->pengeluaran_rill = $matrik_rill;
                        $dataMatrik->total_biaya = $request->totalbiaya;
                        $dataMatrik->flag_kendaraan = $request->flag_jeniskendaraan;
                        $dataMatrik->update();

                    }
                    //batas push realisasi ke matrik rencana

                    //update turunan anggaran
                    //update data turunan anggaran dan anggaran
                    if ($request->flag_kuitansi > 0)
                    {
                        //sudah pernah di edit
                        $dataTurunanAnggaran = \App\TurunanAnggaran::where('t_id','=',$request->dana_tid)->first();
                        $realisasi_baru = $dataTurunanAnggaran->pagu_realisasi - $request->totalbiaya_sblm;
                        $dataTurunanAnggaran->pagu_realisasi = $realisasi_baru + $request->totalbiaya;
                        $dataTurunanAnggaran->update();

                        $dataAnggaran = \App\Anggaran::where('id','=',$request->mak_id)->first();
                        $real_anggaran_baru  = $dataAnggaran->realisasi_pagu - $request->totalbiaya_sblm;
                        $dataAnggaran->realisasi_pagu = $real_anggaran_baru + $request->totalbiaya;
                        $dataAnggaran->update();
                    }
                    else
                    {
                        //baru pertama di edit
                        $dataTurunanAnggaran = \App\TurunanAnggaran::where('t_id','=',$request->dana_tid)->first();
                        $dataTurunanAnggaran->pagu_realisasi = $dataTurunanAnggaran->pagu_realisasi + $request->totalbiaya;
                        $dataTurunanAnggaran->update();

                        $dataAnggaran = \App\Anggaran::where('id','=',$request->mak_id)->first();
                        $dataAnggaran->realisasi_pagu = $dataAnggaran->realisasi_pagu + $request->totalbiaya;
                        $dataAnggaran->update();
                    }
                    //sinkronisasi turunan anggaran setelah matrik di push
                    $data_bid = DB::table('matrik')
                    ->select(DB::Raw('matrik.mak_id,matrik.dana_tid,COALESCE(sum(matrik.total_biaya)) as biaya_rencana, COALESCE(sum(kuitansi.total_biaya)) as biaya_rill'))
                    ->leftJoin('transaksi','matrik.id','=','transaksi.matrik_id')
                    ->leftJoin('kuitansi','transaksi.trx_id','=','kuitansi.trx_id')
                    ->where([
                        ['mak_id','=',$request->mak_id],
                        ['dana_tid','=',$request->dana_tid],
                        ['flag_matrik','<>','2']
                        ])->groupBy('dana_tid')->first();
                    //dd($data_bid);
                    $data_anggaran = DB::table('matrik')
                        ->select(DB::Raw('matrik.mak_id,matrik.dana_tid,COALESCE(sum(kuitansi.total_biaya)) as totalbiaya'))
                        ->leftJoin('transaksi','matrik.id','=','transaksi.matrik_id')
                        ->leftJoin('kuitansi','transaksi.trx_id','=','kuitansi.trx_id')
                        ->where([
                            ['mak_id','=',$request->mak_id],
                            ['flag_matrik','<>','2']
                            ])->groupBy('mak_id')->first();
                    //dd($data_anggaran);
                    //update pagu_realisasi turunan anggaran
                    if ($data_bid)
                    {
                        $data = TurunanAnggaran::where('t_id','=',$request->dana_tid)->first();
                        $data->pagu_rencana = $data_bid->biaya_rencana;
                        $data->pagu_realisasi = $data_bid->biaya_rill;
                        $data->update();
                    }

                    //update pagu_realisasi di anggaran
                    if ($data_anggaran)
                    {
                        $dataAnggaran = Anggaran::where('id','=', $request->mak_id)->first();
                        $dataAnggaran->realisasi_pagu = $data_anggaran->totalbiaya;
                        $dataAnggaran->update();
                    }
                    //batas sinkronisasi
                    Session::flash('message', '['.$request->kode_trx.'] Kuitansi an. <strong>'.$request->nama.'</strong> tujuan ke <strong>'.$dataMatrik->Tujuan->nama_kabkota.'</strong> tanggal berangkat <strong><i>'.Tanggal::Panjang($dataTrx->tgl_brkt).'</i></strong> sudah diupdate');
                    Session::flash('message_type', 'success');
                    Session::flash('flash_kodetrx', $request->kode_trx);
                    Session::flash('flash_nama', $request->nama);
                    return redirect()->to('kuitansi');
                }
                else
                {
                    //sisa dana pagu tidak cukup
                    //Session::flash('message', '['.$request->kode_trx.'] Kuitansi an. '.$request->nama.' tujuan ke '. $request->nama_tujuan .' sisa pagu tidak mencukupi');
                    Session::flash('message', '['.$request->kode_trx.'] Kuitansi an. <strong>'.$request->nama.'</strong> tujuan ke <strong>'.$dataMatrik->Tujuan->nama_kabkota.'</strong> tanggal berangkat <strong><i>'.Tanggal::Panjang($dataTrx->tgl_brkt).'</i></strong> sisa pagu tidak mencukupi');
                    Session::flash('message_type', 'danger');
                    return back();
                }

            }
            else {
                //kuitansi tidak ada
                Session::flash('message', 'Kuitansi tidak ditemukan');
                Session::flash('message_type', 'danger');
                return redirect()->to('kuitansi');
            }
        }
        elseif ($request->aksi == "selesai") {
            //cek kuitansi dulu
            $count = Kuitansi::where('kuitansi_id','=',$request->kuitansi_id)->count();
            if ($count>0) {
                //kalo ada update flag kuitansi jadi selesai
                $dataKuitansi = Kuitansi::where('kuitansi_id','=',$request->kuitansi_id)->first();
                $dataKuitansi -> flag_kuitansi = 2;
                $dataKuitansi -> update();
                //update data turunan anggaran dan anggaran

                $dataTurunanAnggaran = \App\TurunanAnggaran::where('t_id','=',$request->dana_tid)->first();
                $dataTurunanAnggaran -> pagu_realisasi = $dataTurunanAnggaran->pagu_realisasi+$request->pagu_realisasi;
                $dataTurunanAnggaran -> update();

                $dataAnggaran = \App\Anggaran::where('id','=',$request->mak_id)->first();
                $dataAnggaran -> realisasi_pagu = $dataAnggaran->realisasi_pagu+$request->pagu_realisasi;
                $dataAnggaran -> update();

                Session::flash('message', 'Kuitansi an. '.$request->nama.' tujuan ke '. $request->nama_tujuan .' sudah selesai');
                Session::flash('message_type', 'success');
                return redirect()->to('kuitansi');
            }
            else {
                 //kuitansi tidak ada
                 Session::flash('message', 'Kuitansi tidak ditemukan');
                 Session::flash('message_type', 'danger');
                 return redirect()->to('kuitansi');
            }
        }
        elseif ($request->aksi == "flag") {
            //cek kuitansi dulu hanya admin yang bisa
            $count = Kuitansi::where('kuitansi_id','=',$request->kuitansi_id)->count();
            if ($count>0) {
                //kalo ada update flag kuitansi jadi selesai
                $dataKuitansi = Kuitansi::where('kuitansi_id','=',$request->kuitansi_id)->first();
                $dataKuitansi -> flag_kuitansi = 0;
                $dataKuitansi -> update();

                Session::flash('message', 'Kuitansi an. '.$request->nama.' tujuan ke '. $request->nama_tujuan .' sudah diupdate');
                Session::flash('message_type', 'success');
                return redirect()->to('kuitansi');
            }
            else {
                 //kuitansi tidak ada
                 Session::flash('message', 'Kuitansi tidak ditemukan');
                 Session::flash('message_type', 'danger');
                 return redirect()->to('kuitansi');
            }
        }
        else {
            dd($request->all());
        }
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function view($kodetrx)
    {
        $FlagTrx = config('globalvar.FlagTransaksi');
        $FlagKonfirmasi = config('globalvar.FlagKonfirmasi');
        $MatrikFlag = config('globalvar.FlagMatrik');
        $FlagSrt = config('globalvar.FlagSurat');
        $FlagTTD = config('globalvar.FlagTTD');
        $Bilangan = config('globalvar.Bilangan');
        $Bulan = config('globalvar.Bulan');
        $FlagKendaraan = config('globalvar.Kendaraan');

        $dataTransaksi = \App\Transaksi::with('Matrik','SuratTugas','Spd','Kuitansi')->where('kode_trx','=',$kodetrx)->get();
        return view('kuitansi.view',compact('dataTransaksi','FlagTrx','FlagKonfirmasi','MatrikFlag','FlagTTD','FlagSrt','Bilangan','Bulan','FlagKendaraan'));

    }
    public function print($kodetrx)
    {
        $FlagTrx = config('globalvar.FlagTransaksi');
        $FlagKonfirmasi = config('globalvar.FlagKonfirmasi');
        $MatrikFlag = config('globalvar.FlagMatrik');
        $FlagSrt = config('globalvar.FlagSurat');
        $FlagTTD = config('globalvar.FlagTTD');
        $Bilangan = config('globalvar.Bilangan');
        $FlagKendaraan = config('globalvar.Kendaraan');
        $count = Transaksi::where('kode_trx','=',$kodetrx)->where('flag_trx','>','3')->count();
        if ($count > 0)
        {
            $data = Transaksi::where('kode_trx','=',$kodetrx)->where('flag_trx','>','3')->first();
            //dd($data);
            PDF::setOptions(['dpi' => 150, 'defaultFont' => 'Helvetica','isHtml5ParserEnabled'=>true]);
            $pdf = PDF::loadView('kuitansi.print',compact('data','FlagTrx','FlagKonfirmasi','MatrikFlag','FlagTTD','FlagSrt','Bilangan','FlagKendaraan'))->setPaper('A4');
            $nama=strtoupper($data->peg_nama);
            return $pdf->stream('KUITANSI_'.$nama.'_TRX_ID_'.$kodetrx.'.pdf');
            //return view('kuitansi.print',compact('data','FlagTrx','FlagKonfirmasi','MatrikFlag','FlagTTD','FlagSrt','Bilangan','FlagKendaraan'));
        }
    }
    public function unduh($kodetrx)
    {
        $FlagTrx = config('globalvar.FlagTransaksi');
        $FlagKonfirmasi = config('globalvar.FlagKonfirmasi');
        $MatrikFlag = config('globalvar.FlagMatrik');
        $FlagSrt = config('globalvar.FlagSurat');
        $FlagTTD = config('globalvar.FlagTTD');
        $Bilangan = config('globalvar.Bilangan');
        $FlagKendaraan = config('globalvar.Kendaraan');
        $count = Transaksi::where('kode_trx','=',$kodetrx)->where('flag_trx','>','3')->count();
        if ($count > 0)
        {
            $data = Transaksi::where('kode_trx','=',$kodetrx)->where('flag_trx','>','3')->first();
            //dd($data);
            PDF::setOptions(['dpi' => 150, 'defaultFont' => 'Helvetica','isHtml5ParserEnabled'=>true]);
            $pdf = PDF::loadView('kuitansi.print',compact('data','FlagTrx','FlagKonfirmasi','MatrikFlag','FlagTTD','FlagSrt','Bilangan','FlagKendaraan'))->setPaper('A4');
            $nama=strtoupper($data->peg_nama);
            return $pdf->download('KUITANSI_'.$nama.'_TRX_ID_'.$kodetrx.'.pdf');
            //return view('kuitansi.print',compact('data','FlagTrx','FlagKonfirmasi','MatrikFlag','FlagTTD','FlagSrt','Bilangan','FlagKendaraan'));
        }
    }
    public function selesai(Request $request)
    {
        //dd($request->all());
        //cek kuitansi dulu
        $count = Kuitansi::where('kuitansi_id','=',$request->kuitansi_id)->count();
        if ($count>0) {
            //kalo ada update flag kuitansi jadi selesai
            $dataKuitansi = Kuitansi::where('kuitansi_id','=',$request->kuitansi_id)->first();
            $dataKuitansi -> flag_kuitansi = 2;
            $dataKuitansi -> update();

            $data = \App\MatrikPerjalanan::where('id','=',$request->m_id)->first();

            Session::flash('message', '('.$request->kodetrx.') Kuitansi an. '.$data->Transaksi->peg_nama.' tujuan ke '. $data->Tujuan->nama_kabkota .' sudah selesai');
            Session::flash('message_type', 'success');
            return redirect()->to('kuitansi');
        }
        else {
             //kuitansi tidak ada
             Session::flash('message', 'Kuitansi tidak ditemukan');
             Session::flash('message_type', 'danger');
             return redirect()->to('kuitansi');
        }
    }
}
