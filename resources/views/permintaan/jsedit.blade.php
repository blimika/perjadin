<script>
    $("#semuamatrik").click(function () {
        $('input:checkbox').not(this).prop('checked', this.checked);
    });
    $("#tanggal_surat").datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd',
        toggleActive: true,
        todayHighlight: true,
        daysOfWeekHighlighted: "0,6",
      });
      $('#unitkerja').on('click change', function(e) {
        var Tanggal = new Date();
        var unit = $("#unitkerja").val();
        var srtjln = 'B-xxx/BPS/'+ unit +'/'+ (Tanggal.getMonth()+1) + '/' + Tanggal.getFullYear();
        $('#nomor_surat').val(srtjln);
      });

      $(document).on('click', '.pilihSumberDana', function (e) {
        //var sumberdana = $(this).attr('data-mak') + " " + $(this).attr('data-uraian');
        document.getElementById("dana_makid").value = $(this).attr('data-makid');
        document.getElementById("dana_tid").value = $(this).attr('data-tid');
        document.getElementById("dana_mak").value = $(this).attr('data-mak');
        document.getElementById("dana_program").value = $(this).attr('data-program');
        document.getElementById("dana_kegiatan").value = $(this).attr('data-kegiatan');
        document.getElementById("dana_kro").value = $(this).attr('data-kro');
        document.getElementById("dana_output").value = $(this).attr('data-output');
        document.getElementById("dana_komponen").value = $(this).attr('data-komponen');
        document.getElementById("dana_subkomponen").value = $(this).attr('data-subkomponen');
        document.getElementById("dana_uraian").value = $(this).attr('data-uraian');
        document.getElementById("dana_pagu").value = $(this).attr('data-pagu');
        document.getElementById("dana_kodeunit").value = $(this).attr('data-unitkerja');
        document.getElementById("dana_unitkerja").value = $(this).attr('data-namaunitkerja');
        document.getElementById("dana_pagusisa").value = $(this).attr('data-sisapagu');
        $('#SumberDana').modal('hide');
    });
    //batas tujuan dan sumber dana //
    $(function () {
        $("#TabelSumberDana").dataTable();
    });
    $('#SumberDana').on('show.bs.modal', function (event) {
        $('#formJLNTambah #tabelmatrik tbody').html("");
        $('#formJLNTambah #tabelmatrik tfoot').html("");
    });
    $('#SumberDana').on('hidden.bs.modal', function (event) {
        var aid = $("#dana_makid").val();
        var tid = $("#dana_tid").val();
        var tglstart = $("#tanggal_surat").val();
        var id_permintaan = $("#id_permintaan").val();
        function addDP($els) {
            $els.datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd',
                toggleActive: true,
                todayHighlight: true,
                daysOfWeekHighlighted: "0,6",
                startDate: tglstart,
            });
        }
        function addSelect2($sel)
        {
            $sel.select2();
        }
        if (aid && tid)
        {
            $.ajax({
            url : '{{route("matrik.viewbyanggaran",["",""])}}/'+aid+'/'+tid,
            method : 'get',
            cache: false,
            dataType: 'json',
            success: function(data){

                if (data.status == false) {
                    $('#formJLNTambah #tabelmatrik tbody').html("<tr><td colspan='8' align='center'>Belum ada Matrik menggunakan anggaran ini</td></tr>")
                    $('#formJLNTambah #tabelmatrik tfoot').html("")
                }
                else {
                    var i;
                    var text;
                    var tujuannama;
                    var peg_nama
                    for (i = 0; i < data.jumlah_matrik; i++) {
                        if (data.hasil[i].tipe_perjadin == '1')
                        {
                            var tujuannama = data.hasil[i].tujuan.namakabkota_tujuan;
                        }
                        else
                        {
                            //tipe multi
                            var tujuannama = 'Multi';
                        }
                        if (data.hasil[i].tgl_brkt)
                        {
                            //var tgl_brkt = data.hasil[i].tgl_brkt_nama;
                            //beda di readonly
                            var tgl_brkt = '<input type="text" name="tgl_brkt_nama" id="tgl_brkt_nama" class="form-control" placeholder="Tanggal Brkt" autocomplete="off" value="'+data.hasil[i].tgl_brkt_nama+'" disabled="" /><input type="hidden" name="tgl_brkt[]" id="tgl_brkt" class="form-control" value="'+data.hasil[i].tgl_brkt+'" readonly="" />';
                        }
                        else
                        {
                            var tgl_brkt = '<input type="text" name="tgl_brkt[]" id="tgl_brkt" data-tglawal="'+data.hasil[i].tgl_awal+'" data-tglakhir="'+data.hasil[i].tgl_akhir+'" class="tgl_brkt form-control" placeholder="Tanggal Brkt" autocomplete="off" required="" />';
                        }
                        if (data.hasil[i].peg_nama)
                        {
                            //var peg_nama = data.hasil[i].peg_nama;
                            var peg_nama = '<input type="text" name="peg_nama" id="peg_nama" class="form-control" placeholder="Pegawai yang berangkat" autocomplete="off" value="'+data.hasil[i].peg_nama+'" disabled="" /> <input type="hidden" name="pegid[]" id="pegid" value="'+data.hasil[i].peg_id+'" readonly="" />';
                        }
                        else
                        {
                           //peg_nama ditransaksi masih kosong

                            peg_nama ='<select name="pegid[]" id="pegid" class="form-control pilihan" required>'+
                                        '<option value="">Pilih Pegawai</option>';
                            @foreach ($dataPegawai as $item)
                                peg_nama += '<option value="{{$item->id}}">{{$item->nama}}</option>';
                            @endforeach
                            peg_nama +='</select>';
                        }
                        if (data.hasil[i].flag_sudah_permintaan == 0)
                        {

                            var flag_minta = "<input type=\"checkbox\" name=\"matrikid[]\" id=\"matrikid\" value=\""+data.hasil[i].matrik_id+"\" />";

                        }
                        else
                        {
                            if (data.hasil[i].id_permintaan == id_permintaan)
                            {
                                var flag_minta = "<input type=\"checkbox\" name=\"matrikid[]\" id=\"matrikid\" value=\""+data.hasil[i].matrik_id+"\" checked />";

                            }
                            else
                            {
                                var flag_minta = '';
                            }

                        }
                        text += "<tr><td>"+flag_minta+"</td><td>"+(i+1)+"</td><td>"+peg_nama+"</td><td>"+tgl_brkt+"</td><td>"+tujuannama+"</td><td>"+data.hasil[i].lamanya+"</td><td>Menggunakan "+data.hasil[i].flag_kendaraan_nama+"</td><td><span class=\"label label-success\">"+data.hasil[i].flag_trx_nama+"</span></td></tr>";
                    }

                    $('#formJLNTambah #tabelmatrik tbody').html(text);
                    $('#formJLNTambah #tabelmatrik tfoot').html("");
                    addDP($('#formJLNTambah #tabelmatrik tbody').find('input.tgl_brkt'));
                    addSelect2($('#formJLNTambah #tabelmatrik tbody').find('select.pilihan'));
                }
            },
            error: function(){
                alert("error");
            }
        });
        }
    });
    </script>
