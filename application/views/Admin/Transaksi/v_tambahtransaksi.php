
<!-- Breadcumbs -->
    
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Transaksi</h4> </div>
                    <!-- Breadcumbs  -->
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> 
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url('Admin') ?>"> Beranda </a></li>
                            <li class="active">Tambah Transaksi</li>
                        </ol>
                    </div>
                    <!-- /Breadcumbs  -->
                    <!-- /.col-lg-12 -->
                </div>

<!-- /Breadcumbs -->




                </div> 

<div class="col-lg-12 col-sm-6 col-xs-12">
    <div class="white-box">
        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="bank" aria-expanded="true">
                <div class="col-sm-12">
                        
                        <form class="form-horizontal" id="formInput">

                            <div>
                            <h3><p>Tambah Transaksi</p></h3>
                            <hr>
                            <table class="table" id='tabel'>
                                <thead>
                                    <tr>
                                        <th scope="col">Jenis Domba</th>
                                        <th scope="col">Jenis Kelamin</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col" style="width: 150px;">Jumlah</th>
                                        <th scope="col" style="width: 150px;">Berat (Kg)</th>
                                        <th scope="col" style="width: 150px;">Subtotal</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr id='tr_1'>
                                        <td>
                                            <select class="form-control" name="domba[]" id="domba_1" onClick="select_domba(1)" style="height: calc(3.5rem); font-size: 12px" required>
                                                <?php
                                                foreach ($jenisdomba as $jd) {
                                                    ?>
                                                    <option  
                                                        value="<?php echo $jd->ID_JENIS ?>"><?php echo $jd->JENIS_DOMBA ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control" name="jk[]" id="jk_1"  onClick="select_jk(1)" style="height: calc(3.5rem); font-size: 12px" required>
                                                <option value="">-PILIH-</option>
                                            </select>
                                        </td>
                                        <td id="harga_1"></td>
                                        <td>
                                            <input type="number" id="jumlah_1" class="input-text qty text" step="1" min="1" max="" name="jumlah[]" title="Jumlah" size="4" pattern="[0-9]*" inputmode="numeric" required style="width: 60px;text-align-last: center;">
                                        </td>
                                        <td>
                                            <input type="number" id="berat_1" class="input-text qty text" step="1" min="1" max="" name="berat[]" 
                                            onChange="ganti_subtot(1)" onKeyup="ganti_subtot(1)" onClick="ganti_subtot(1)"
                                            title="Berat" size="4" pattern="[0-9]*" inputmode="numeric" required style="width: 60px;text-align-last: center;">
                                        </td>
                                        <td id="subtotal_1"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"></td>
                                        <td><h3>TOTAL</h3></td>
                                        <td><h3 id="total"></h3></td>
                                    </tr>
                                </tbody>
                            </table>
                            
                            <table><tr>
                            <td><a class="btn btn-sm btn-circle btn-primary" data-toggle="tooltip" data-title="Tambah Domba" href="javascript:void(0)" onClick="TambahDomba()"><i class="fa fa-plus-circle" aria-hidden="true"></i></a></td>
                            <td style="width:10px;"></td>
                            <td><a id="hapusdomba" class="btn btn-sm btn-circle btn-danger" data-toggle="tooltip" data-title="Hapus Domba" href="javascript:void(0)" onClick="HapusDomba()" style="display: none;"><i class="fa fa-minus-circle" aria-hidden="true"></i></a></td>
                            </tr></table>

                            <h3><p></p></h3>
                            <br>
                        </div>
                        <div class="row">
                            <div class="col-12 mb-5">
                                <label for="nama">Pelanggan</label>
                                <select class="form-control" name="pelanggan" id="pelanggan" style="height: calc(3.5rem); font-size: 12px; width: 270px;" onchange="PELANGGANFunction()" required>
                                    <?php
                                    foreach ($pelanggan as $pel) {
                                        ?>
                                        <option  
                                            value="<?php echo $pel->ID_PELANGGAN ?>"><?php echo $pel->NAMA_PELANGGAN.' - '.$pel->TELP_PELANGGAN ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div id="pengiriman">
                                <div class="col-12 mb-3">
                                    <input type="checkbox" name="penerima" id="cek_penerima" onchange="PENERIMAFunction()"><label for="customCheck1"> Penerima beda dengan pengirim?</label>
                                </div>
                                <div>
                                    <div class="col-12 mb-3" id="penerima" style='display: none;'>
                                        <label for="Nama"><span>*</span>FORM PENERIMA</label>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="Nama">Nama <span>*</span></label>
                                        <input type="text" class="form-control" name="nama" id="nama"  minlength="5" maxlength="30" value="<?= $pelanggan[0]->NAMA_PELANGGAN;?>" readonly>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="Alamat">Alamat <span>*</span></label>
                                        <input type="text" class="form-control mb-3" name="alamat" id="alamat" minlength="5" maxlength="50" value="<?= $pelanggan[0]->ALAMAT_PELANGGAN;?>" readonly>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="Kodepos">Kodepos <span>*</span></label>
                                        <input type="text" class="form-control" name="kodepos" id="kodepos"  pattern="[0-9]*" inputmode="numeric" minlength="5" maxlength="5" value="<?= $pelanggan[0]->KODEPOS_PELANGGAN;?>" readonly>
                                    </div>
                                    <div class="col-12 mb-3">
                                            <label for="Provinsi">Provinsi <span>*</span></label>
                                            <select class="custom-select d-block w-100" name="provinsi" id="provinsi" disabled="true">
                                            <?php
                                            foreach ($provinsi as $prov) {
                                                ?>
                                                <option 
                                                    value="<?php echo $prov->ID_PROV ?>"
                                                    <?php if($prov->ID_PROV == $this->Master->get_tabel('kota' , array('ID_KOTA' => $pelanggan[0]->ID_KOTA), 'ID_PROV')){
                                                        echo "selected";
                                                    }?>><?php echo $prov->NAMA_PROV ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-12 mb-3">
                                            <label for="Kota">Kota <span>*</span></label>
                                            <select class="custom-select d-block w-100" name="kota" id="kota" disabled="true">
                                            <?php
                                            foreach ($kota as $kot) {
                                                ?>
                                                <option
                                                    class="<?php echo $kot->ID_PROV ?>" 
                                                    value="<?php echo $kot->ID_KOTA ?>" 
                                                    <?php if($kot->ID_KOTA == $pelanggan[0]->ID_KOTA){
                                                        echo "selected";
                                                    }?>
                                                    ><?php echo $kot->NAMA_KOTA ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                        </div>
                                    <div class="col-12 mb-3">
                                        <label for="Telepon">Telepon <span>*</span></label>
                                        <input type="text" class="form-control" name="telepon" id="telepon" minlength="10" maxlength="13" pattern="[0-9]*" inputmode="numeric" value="<?= $pelanggan[0]->TELP_PELANGGAN;?>" readonly>
                                    </div>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="Ongkir">Ongkir <span>*</span></label>
                                    <input type="number" class="form-control" name="ongkir" id="ongkir"  min="0" pattern="[0-9]*" inputmode="numeric" value='0' onChange="ganti_total()" onKeyup="ganti_total()" onClick="ganti_total()" >
                                </div>
                            </div>
                        </div>
                        <input type="checkbox" name="TF" id="TF" onclick="TFFunction()"><label for="customCheck1"> Transfer</label>
                        <div class="form-group" id="formTF">  
                        </div>
                        <input type="checkbox" name="DP" id="DP" onclick="DPFunction()" ><label for="customCheck1"> DP</label>
                        <div class="form-group" id="formDP">  
                        </div>
                        <input type="checkbox" name="KIRIM" id="KIRIM" onchange="KIRIMFunction()"><label for="customCheck1"> Kirim</label>
                            <br><button type="submit" class="btn btn-success">Proses</button>
                        </form> 
                </div>
            </div>    
        </div>
    </div>
</div>
<script src="<?php echo base_url('assets/js/jquery.chained.min.js') ?>"></script>
        <script>
            $("#kota").chained("#provinsi");
        </script>
<script src="assets/js/jquery/jquery-2.2.4.min.js"></script>

<script type="text/javascript">
    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix){
        var number_string = angka.toString().replace(/[^,\d]/g, ''),
        split   		= number_string.split(','),
        sisa     		= split[0].length % 3,
        rupiah     		= split[0].substr(0, sisa),
        ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if(ribuan){
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp.' + rupiah : '');
    }
</script>

<script type="text/javascript">
    /* Fungsi insert transfer, DP, Kirim */

    //untuk awal agar form pengiriman tidak terlihat (display=none)
    document.getElementById("pengiriman").style.display = "none";

    //menambahkan barang yang akan dibeli (domba) saat menekan tombol (+)
    function TambahDomba(){
        //mencari panjang rows pada tabel
        var rows = $('#tabel tbody tr').length; 
        //insert form barang yang akan dibeli (domba) ke variabel html
        var html = "";
        html += "<tr id='tr_"+rows+"'>";
        html += "<td><select class='form-control' name='domba[]' id='domba_"+rows+"' onClick='select_domba("+rows+")' style='height: calc(3.5rem); font-size: 12px' required>";
    <?php foreach ($jenisdomba as $jd) { ?>
        html += "<option value='<?php echo $jd->ID_JENIS ?>'><?php echo $jd->JENIS_DOMBA ?></option>";
    <?php } ?>
        html += "</select></td>";
        html += "<td><select class='form-control' name='jk[]' id='jk_"+rows+"'  onClick='select_jk("+rows+")' style='height: calc(3.5rem); font-size: 12px' required><option value=''>-PILIH-</option></select></td>";
        html += "<td id='harga_"+rows+"'></td>";
        html += "<td><input type='number' id='jumlah_"+rows+"' class='input-text qty text' step='1' min='1' max='' name='jumlah[]' title='Jumlah' size='4' pattern='[0-9]*' inputmode='numeric' required style='width: 60px;text-align-last: center;'></td>";
        html += "<td><input type='number' id='berat_"+rows+"' class='input-text qty text' step='1' min='1' max='' name='berat[]' onChange='ganti_subtot("+rows+")' onKeyup='ganti_subtot("+rows+")' onClick='ganti_subtot("+rows+")' title='Berat' size='4' pattern='[0-9]*' inputmode='numeric' required style='width: 60px;text-align-last: center;'> </td>";
        html += "<td id='subtotal_"+rows+"'></td>";
        html += "</tr>";
        //insert data html ke tabel
        $("#tr_"+(rows-1)).after(html); //mencari nilai baris (tr) ke rows-1 (karena baris yang terakhir untuk total) kemudian melakukan insert data variabel html setelah baris
        //memunculkan tombol hapus domba karena data baris lebih dari satu
        document.getElementById("hapusdomba").style.display = "block";
        //menghapus nilai total agar tidak terjadi bug
        $("#total").empty();
    }

    //menghapus barang yang akan dibeli (domba) saat menekan tombol (-)
    function HapusDomba(){
        //mencari panjang rows pada tabel
        var rows = $('#tabel tbody tr').length;
        //menghapus barisan ke rows -1
        $("#tr_"+(rows-1)).remove(); //mencari nilai baris (tr) ke rows-1 (karena baris yang terakhir untuk total) kemudian melakukan remove data setelah baris
        //menghapus nilai total agar tidak terjadi bug
        $("#total").empty();
        //jika baris == 2 menghapus tombol hapus domba
        if(rows-1 == 2){
            document.getElementById("hapusdomba").style.display = "none";
        }
    }

    //menambahkan harga DP saat checkbock DP di centang
    function DPFunction() { 
        var checkBox = document.getElementById("DP");
        var html = '';
        var valtot = $("#valtot").val();
        //jika barang belum terisi maka keluar alert (untuk menghindari bug)
        if(valtot != null){
            //jika checkbox DP tercentang maka muncul input harga dan dp tidak boleh kurang dari setengah harga barang 
            if (checkBox.checked == true){
                var dp = parseInt(valtot/2);
                html += "<input type=\"number\" class=\"form-control\" placeholder=\"harga\" name=\"DPval\" min=\""+dp+"\" max=\""+valtot+"\" style=\"width: 200px\" required> </div>"
            }else{
                html = '';
            }
        }else{
            alert("Silahkan isi semua barang terlebih dahulu");
            checkBox.checked = false;
        }
        //insert form DP
        $('#formDP').html(html);
    };

    //menambahkan upload bukti TF saat checkbock Transfer di centang
    function TFFunction() { 
        var checkBox = document.getElementById("TF");
        var html = '';
        var valtot = $("#valtot").val();
        //jika barang belum terisi maka keluar alert (untuk menghindari bug)
        if(valtot != null){
            //jika checkbox DP tercentang maka muncul form
            if (checkBox.checked == true){
                html += "<div class=\"col-md-12\">"
                html += "<input type=\"file\" class=\"form-control\" name=\"userfile\" id='fileInput' onchange=\"AlertFilesize(this.id,2048,'KB')\" required> </div>"
            }else{
                html = '';
            }
        }else{
            alert("Silahkan isi semua barang terlebih dahulu");
            checkBox.checked = false;
        }
        //insert form TF
        $('#formTF').html(html);
    }

    //menambahkan detail penerima dan ongkir saat checkbox Kirim di centang
    function KIRIMFunction() {
        var checkBox = document.getElementById("KIRIM");
        var pengiriman = document.getElementById("pengiriman");
        var valtot = $("#valtot").val();
        if(valtot != null){
            if (checkBox.checked == true){
                //jika checkbox Kirim dicentang maka form pengiriman moncul (display=block)
                pengiriman.style.display = "block";
                //menambahkan element/property 'required' pada form kirim
                $("#nama").prop('required', true);
                $("#alamat").prop('required', true);
                $("#kodepos").prop('required', true);
                $("#provinsi").prop('required', true);
                $("#kota").prop('required', true);
                $("#telepon").prop('required', true);
                $("#ongkir").prop('required', true);
            }else{
                //jika checkbox Kirim tidak dicentang maka form pengiriman tidak muncul (display=none)
                pengiriman.style.display = "none";
                //menghapus element/property 'required' pada form kirim
                $("#nama").prop('required', false);
                $("#alamat").prop('required', false);
                $("#kodepos").prop('required', false);
                $("#provinsi").prop('required', false);
                $("#kota").prop('required', false);
                $("#telepon").prop('required', false);
                $("#ongkir").prop('required', false);
            }
        }else{
            alert("Silahkan isi semua barang terlebih dahulu");
            checkBox.checked = false;
        }
    }

    //mengganti detail pelanggan dalam fitur Kirim menggunakan ajax
    function PELANGGANFunction(){
        var checkBox = document.getElementById("cek_penerima");
        var idpel=$('#pelanggan').val();
        //jika penerima tidak di centang
        if (checkBox.checked == false){
            $.ajax({
                url : "<?php echo base_url('T_TambahTransaksi/pelanggan/');?>",
                method : "POST",
                data : {id: idpel},
                async : false,
                dataType : 'json',
                success: function(data){
                    //mengisi element readonly atau disabled dan menambahkan attribut value sesuai data pelanggan
                    $('option:selected', "#provinsi").removeAttr('selected');
                    $('option:selected', "#kota").removeAttr('selected');
                    $("#nama").prop('readonly', true).attr('value', data[0].NAMA_PELANGGAN);
                    $("#alamat").prop('readonly', true).attr('value', data[0].ALAMAT_PELANGGAN);
                    $("#kodepos").prop('readonly', true).attr('value', data[0].KODEPOS_PELANGGAN);
                    $("#provinsi").prop('disabled', true).attr('value', data[0].ID_PROV);
                    $("#kota").prop('disabled', true).attr('value', data[0].ID_KOTA);
                    $("#telepon").prop('readonly', true).attr('value', data[0].TELP_PELANGGAN);
                    $("#provinsi option[value="+data[0].ID_PROV+"]").attr('selected', 'selected');
                    $("#kota option[value="+data[0].ID_KOTA+"]").attr('selected', 'selected');
                }
            });
        }
    }

    //mengosongkan form detail pelanggan dalam fitur Kirim jika checkbox 'penerima berbeda' dicentang
    function PENERIMAFunction(){
        var checkBox = document.getElementById("cek_penerima");
        var penerima = document.getElementById("penerima");
        //jika penerima dicentang
        if (checkBox.checked == true){
            penerima.style.display = "block";
            //mengosongkan element readonly atau disabled dan attribut value
            $("#nama").prop('readonly', false).attr('value', '');
            $("#alamat").prop('readonly', false).attr('value', '');
            $("#kodepos").prop('readonly', false).attr('value', '');
            $("#provinsi").prop('disabled', false).attr('value', '');
            $("#kota").prop('disabled', false).attr('value', '');
            $("#telepon").prop('readonly', false).attr('value', '');
            $("#ongkir").prop('readonly', false).attr('value', '');
        }else{
            penerima.style.display = "none";
            PELANGGANFunction();
        }
    }

    //fitur javascript untuk validasi file foto pada fitur Transfer
    function AlertFilesize(cid,sz,a){
        var controllerID = cid;
        var fileSize = sz;
        var extation = a;
        if(window.ActiveXObject){
            var fso = new ActiveXObject("Scripting.FileSystemObject");
            var filepath = document.getElementById('fileInput').value;
            var thefile = fso.getFile(filepath);
            var sizeinbytes = thefile.size;
        }else{
            var sizeinbytes = document.getElementById('fileInput').files[0].size;
        }
        var fSExt = new Array('Bytes', 'KB', 'MB', 'GB');
        fSize = sizeinbytes; i=0;while(fSize>900){fSize/=1024;i++;}
        var fup = document.getElementById('fileInput');
        var fileName = fup.value;
        var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
        if(ext == "png" || ext == "PNG" || ext == "jpg" || ext == "JPG")
        {   
            var fs = Math.round(fSize);
            if(fs < fileSize && fSExt[i] == extation)
            {
                return true;
            }else{
                alert("Please enter the image size less then "+fileSize+extation);
                document.getElementById('fileInput').value='';
                return false;
            }
        }else{
        alert("Must be jpg and png images ONLY");
        document.getElementById('fileInput').value='';
        return false;
        }
    }

    //Insert ke database menggunakan ajax ketika form di submit (menekan tombol proses)
    $('#formInput').submit(function(e){
            e.preventDefault();
            var valid=true;
            //agar variable provinsi dan kota dapat masuk ke form (mengatasi bug)
            $("#provinsi").prop('disabled', false);
            $("#kota").prop('disabled', false);
            //generalisasi form agar data file bisa masuk
            var form = $('form')[0];
            //mengambil semua data di dalam form
            var formData = new FormData(form);
            //fitur swal
            $(this).find('.textbox').each(function(){
                if (! $(this).val()){
                    get_error_text(this);
                    valid = false;
                    $('html,body').animate({scrollTop: 0},"slow");
                } 
                if ($(this).hasClass('no-valid')){
                    valid = false;
                    $('html,body').animate({scrollTop: 0},"slow");
                }
            });
            if (valid){
                swal({
                    title: "Konfirmasi Simpan Data",
                    text: "Data Akan di Simpan Ke Database",
                    type: "info",
                    showCancelButton: true,
                    confirmButtonColor: "#1da1f2",
                    confirmButtonText: "Yakin, dong!",
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                }, function () { //apabila sweet alert d confirm maka akan mengirim data ke T_TambahTransaksi/Save/ melalui proses ajax
                    $.ajax({
                        url: "<?php echo base_url('T_TambahTransaksi/Save/');?>",
                        type: "POST",
                        data: formData,
                        dataType: "html",
                        contentType: false,
                        processData: false,
                        //jika ajax sukses
                        success: function(data){    
                            var id = data.replace("\"", "").replace("\"", "");
                            setTimeout(function(){
                                swal({
                                title:"Data Berhasil Disimpan",
                                text: "Terimakasih",
                                type: "success"
                                }, function(){
                                    window.open("<?php echo base_url('admin/Transaksi/print/');?>"+id, '_blank');
                                    window.location="<?php echo base_url('admin/Transaksi');?>";
                                });
                            }, 2000);
                        },
                        //jika ajax gagal
                        error: function (xhr, ajaxOptions, thrownError) {
                            setTimeout(function(){
                                swal("Error", "Tolong cek data dan ulangi lagi", "error");
                            }, 2000);
                            $("#provinsi").prop('disabled', true);
                            $("#kota").prop('disabled', true);
                        }
                    });
                });
            }
        });
    
</script>

<script type="text/javascript">
    //untuk memperbaiki bug
    function resetSelect(id){
        $("#jumlah_"+id).empty();
        $("#berat_"+id).empty();
        $("#subtotal_"+id).empty();
        $("#total").empty();
    }

    //select domba untuk ketika jenis domba di klik memunculkan option jenis kelamin
    function select_domba(id){
        var iddom=$('#domba_'+id).val();
        $.ajax({
            url : "<?php echo base_url('T_TambahTransaksi/domba/');?>",
            method : "POST",
            data : {id: iddom},
            async : false,
            dataType : 'json',
            success: function(data){
                var html = '';
                var valharga;
                var i;
                for(i=0; i<data.length; i++){
                    html += '<option value='+data[i].ID_DOMBA+'>'+data[i].JENIS_KELAMIN+'</option>';
                }
                valharga = formatRupiah(data[0].HARGA, 'Rp.')+"<input type='hidden' name='hargadom[]' id='hargadom_"+id+"' value='"+data[0].HARGA+"' readonly>";

                $('#jk_'+id).html(html);
                $('#harga_'+id).html(valharga);
                resetSelect(id);
            }
        });
    }

    //select jenis kelamin ketika jk di klik untuk memunculkan harga
    function select_jk(id){
        var iddom = $("#jk_"+id).val();
        if(iddom!= ""){
            $.ajax({
                url : "<?php echo base_url('T_TambahTransaksi/domba_jk/');?>",
                method : "POST",
                data: {id: iddom},
                async : false,
                dataType : 'json',
                success: function(data){
                    var html = formatRupiah(data.HARGA, 'Rp.')+"<input type='hidden' name='hargadom[]' id='hargadom_"+id+"' value='"+data.HARGA+"' readonly>";
                    $('#harga_'+id).html(html);
                    resetSelect(id);
                }
            });
        }else{
            //mengatasi bug option jenis kelamin tidak muncul
            alert("Silahkan isi jenis domba terlebih dahulu");
        }
    }

    //ganti subtotal ketika berat diganti
    function ganti_subtot(id){
        if ($("#jumlah_"+id).val() == 0) {
            $("#jumlah_"+id).val(1);
        }
        var berat = parseInt($("#berat_"+id).val());
        var harga = parseInt($("#hargadom_"+id).val());
        var subtot = berat*harga;
        var subtotal = formatRupiah(subtot, 'Rp.')+"<input type='hidden' name='subtotal[]' id='subtot_"+id+"' value='"+subtot+"' readonly>";
        $('#subtotal_'+id).html(subtotal);
        ganti_total();
    }

    //ganti total ketika input ongkir di klik
    function ganti_total(){
        var total = 0;
        var ongkir = parseInt($("#ongkir").val());
        for (let i = 1; i <= ($('#tabel tbody tr').length-1); i++) {
            total += parseInt($("#subtot_"+i).val());
        }
        total = total+ongkir;
        var html = formatRupiah(total, 'Rp.')+"<input type='hidden' name='total' id='valtot' value='"+total+"' readonly>";
        $('#total').html(html);
    }
</script>