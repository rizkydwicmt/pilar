
<!-- Breadcumbs -->
    
    <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Tambah Transaksi</h4> </div>
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
        <!-- Tab panes -->
    <div class="tab-content">
        <div class="col-sm-12">
            <div class="white-box">
                <form class="form-horizontal" method="post" enctype="multipart/form-data" accept-charset="utf-8" action='<?php 
                    if(isset($id)){
                        echo base_url('T_TambahTransaksi/Save/').$id;
                    }else{
                        echo base_url('T_TambahTransaksi/Save/');
                    }
                        
                ?>'>

                    <div id="formbarang">

                    <h3><p>Tambah Transaksi</p></h3>
                    <hr>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" width="200px">Jenis Domba</th>
                                <th scope="col" width="800px">Domba | Berat | Harga</th>
                                <th scope="col">Subjumlah</th>
                                <th scope="col">Subtotal</th>
                            </tr>
                        </thead>
                        
                            
                    <?php if (isset($id)) {//jika ada id ?>
                        <tbody>
                        <?php for ($i=0; $i < $id; $i++) { ?>
                            <tr>
                                <td>
                                    <select class="form-control" name="barang<?php echo "[".$i."]" ?>" id="barang<?php echo $i ?>" onClick="ganti_uk(<?php echo $i ?>)" style="height: calc(3rem); font-size: 12px" required>
                                        <option value="">-PILIH-</option>
                                        <?php
                                        foreach ($barang as $brg) {
                                            ?>
                                            <option  
                                                value="<?php echo $brg->ID_BAR ?>"><?php echo $brg->NAMA_BAR ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control" name="ukuran<?php echo "[".$i."]" ?>" id="ukuran<?php echo $i ?>"  onClick="ganti_kon(<?php echo $i ?>)" style="height: calc(3rem); font-size: 12px" required>
                                        <option value="">-PILIH-</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control" name="warna<?php echo "[".$i."]" ?>" id="warna<?php echo $i ?>" onClick="ganti_harga(<?php echo $i ?>)" style="height: calc(3rem); font-size: 12px" required>
                                        <option value="">-PILIH-</option>
                                    </select>
                                </td>
                                <td id="harga<?php echo $i ?>"></td>
                                <td>
                                    <input type="number" onChange="ganti_subtot(<?php echo $i ?>)" onKeyup="ganti_subtot(<?php echo $i ?>)" onClick="ganti_subtot(<?php echo $i ?>)" id="jumlah<?php echo $i ?>" class="input-text qty text" step="1" min="1" max="" name="jumlah<?php echo "[".$i."]" ?>" title="Qty" size="4" pattern="[0-9]*" inputmode="numeric" required style="width: 60px;text-align-last: center;">
                                </td>
                                <td id="subtotal<?php echo $i ?>"></td>
                            </tr>
                        <?php } ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td id="total"></td>
                            </tr>
                        </tbody>
                    </table>
                        <a class="btn btn-sm btn-circle btn-warning" data-toggle="tooltip" data-title="Tambah barang" href="javascript:void(0)" onclick="window.location.href='<?php echo base_url("admin/addTransaksi/".($id+1)) ?>'"><i class="fa fa-plus-circle" aria-hidden="true"></i>
                        <a class="btn btn-sm btn-circle btn-danger" data-toggle="tooltip" data-title="Kurang barang" href="javascript:void(0)" onclick="window.location.href='<?php if($id>2){
                            echo base_url("admin/addTransaksi/".($id-1));
                        }else{
                            echo base_url("admin/addTransaksi/");
                        }
                        ?>'"><i class="fa fa-minus-circle" aria-hidden="true"></i></a>
                    <?php }else{ //jika tidak ada id?>
                        <tbody>
                            <tr>
                                <td>
                                    <select class="form-control" name="jenisd" id="jenisd" style="height: calc(3rem); font-size: 12px" required>
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
                                    <select class="form-control selectpicker" name="domba[]" id="domba" style="height: calc(3rem); font-size: 12px" data-style="btn-default"    data-live-search="true" multiple required>
                                    </select>
                                </td>
                                <td>
                                </td>
                                <td id="subtotal"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td id="total"></td>
                            </tr>
                        </tbody>
                    </table>
                    <a class="btn btn-sm btn-circle btn-warning" data-toggle="tooltip" data-title="Tabah Barang" href="javascript:void(0)" onclick="window.location.href='<?php echo base_url("admin/addTransaksi/".'2') ?>'"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>

                    <?php } ?>
                    <h3><p></p></h3>
                    <br>
                </div>
                <div class="row" id="pengiriman">
                    <div class="col-12 mb-3">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" name="nama" id="nama"  minlength="5" maxlength="30"  >
                    </div>
                    <div class="col-12 mb-3">
                        <label for="street_address">Alamat <span>*</span></label>
                        <input type="text" class="form-control mb-3" name="alamat" id="alamat" minlength="5" maxlength="50"  >
                    </div>
                    <div class="col-12 mb-3">
                        <label for="Kodepos">Kodepos <span>*</span></label>
                        <input type="text" class="form-control" name="kodepos" id="kodepos"  pattern="[0-9]*" inputmode="numeric" minlength="5" maxlength="5"  >
                    </div>
                    <div class="col-12 mb-3">
                            <label for="Provinsi">Provinsi <span>*</span></label>
                            <select class="custom-select d-block w-100" name="provinsi" id="provinsi" >
                            <?php
                            foreach ($provinsi as $prov) {
                                ?>
                                <option 
                                    value="<?php echo $prov->ID_PROV ?>"><?php echo $prov->NAMA_PROV ?></option>
                                <?php
                            }
                            ?>
                        </select>
                        </div>
                    <div class="col-12 mb-3">
                            <label for="Kota">Kota <span>*</span></label>
                            <select class="custom-select d-block w-100" name="kota" id="kota" >
                                <?php
                            foreach ($kota as $kot) {
                                ?>
                                <option
                                    class="<?php echo $kot->ID_PROV ?>" value="<?php echo $kot->ID_KOTA ?>"><?php echo $kot->NAMA_KOTA ?></option>
                                <?php
                            }
                            ?>
                        </select>
                        </div>
                    <div class="col-12 mb-3">
                        <label for="Telepon">Telepon <span>*</span></label>
                        <input type="text" class="form-control" name="telepon" id="telepon" minlength="10" maxlength="13" pattern="[0-9]*" inputmode="numeric" >
                    </div>
                    <div class="col-12 mb-3">
                            <label for="Kota">jasa pengiriman <span>*</span></label>
                            <select class="custom-select d-block w-100" name="kurir" id="kurir" onclick="jasaFunction()">
                                <option value="tiki">TIKI</option>
                                <option value="pos">POS</option>
                        </select>
                    </div>
                    <div class="col-12 mb-3">
                        <select class="form-control" name="layanan" id="layanan"  onclick="layananFunction()">
                            <option value="">-PILIH-</option>
                        </select>
                    </div>
                    <div class="col-12 mb-3" id="ongkir">
                    </div>
                </div>
                <input type="checkbox" name="TF" id="TF" onclick="TFFunction()"><label for="customCheck1"> Transfer</label>
                <div class="form-group" id="formTF">  
                </div>
                <input type="checkbox" name="DP" id="DP" onclick="DPFunction()"><label for="customCheck1"> DP</label>
                <div class="form-group" id="formDP">  
                </div>
                <input type="checkbox" name="KIRIM" id="KIRIM" onchange="KIRIMFunction()"><label for="customCheck1"> Kirim</label>
                    <br><button type="submit" class="btn btn-success">Proses</button>
                </form>
            </div>
        </div>
        

                        
        
    </div>
    

                    </div>
<script src="<?php echo base_url('assets/js/jquery.chained.min.js') ?>"></script>
        <script>
            $("#kota").chained("#provinsi"); // disini kita hubungkan kota dengan provinsi
            //$("#ongkir").chained("#layanan");
        </script>
<script src="assets/js/jquery/jquery-2.2.4.min.js"></script>
<script type="text/javascript">
    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix){
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
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
<?php if(!isset($id)){?>
<script type="text/javascript">
    $(document).ready(function(){
        $('#jenisd').bind("keyup change click",function(){
            var iddomba=$(this).val();
            $.ajax({
                url : "<?php echo base_url('T_TambahTransaksi/domba/');?>",
                method : "POST",
                data : {id: iddomba},
                async : false,
                dataType : 'json',
                success: function(data){
                    var html = '';
                    var i;
                    for(i=0; i<data.length; i++){
                        html += '<option title='+data[i].ID_DOMBA+' value='+data[i].ID_DOMBA+'>'+data[i].ID_DOMBA+' | '+data[i].BERAT+' | '+formatRupiah(data[i].HARGA, 'Rp.')+'</option>';
                    }
                    $('#domba').selectpicker('refresh');
                    $('#domba').html(html);
                }
            });
        });

        $('#ukuran').bind("keyup change click",function(){
            var iduk = $(this).val();
            var idbar = $("#barang").val();
            $.ajax({
                url : "<?php echo base_url('T_TambahTransaksi/warna/');?>",
                method : "POST",
                data:"iduk="+iduk+'&idbar='+idbar,
                async : false,
                dataType : 'json',
                success: function(data){
                    var html = '';
                    var i;
                    for(i=0; i<data.length; i++){
                        html += '<option value='+data[i].ID_WAR+'>'+data[i].WARNA+'</option>';
                    }
                    $('#warna').html(html);
                     
                }
            });
        });

        $('#warna').bind("keyup change click",function(){
            var idbar = $("#barang").val();
            $.ajax({
                url : "<?php echo base_url('T_TambahTransaksi/harga/');?>",
                method : "POST",
                data:'&idbar='+idbar,
                async : false,
                dataType : 'json',
                success: function(data){
                    var html = '';
                    var i;
                    for(i=0; i<data.length; i++){
                        var reverse = data[i].HARGA_BAR.toString().split('').reverse().join(''),
                        ribuan  = reverse.match(/\d{1,3}/g);
                        ribuan  = ribuan.join('.').split('').reverse().join('');
                        ribuan  = "Rp " + ribuan + ",00";
                        html += ribuan+"<input type='hidden' name='hargabar' id='hargabar' value='"+data[i].HARGA_BAR+"' readonly>";
                    }
                    $('#harga').html(html);
                     
                }
            });
        });

        $('#jumlah').bind("keyup change click",function(){
            var html = '';
            var html2 = '';
            var jmlh = parseInt($("#jumlah").val());
            var hrg = parseInt($("#hargabar").val());
            var subtot = jmlh*hrg;
            var reverse = subtot.toString().split('').reverse().join(''),
            ribuan  = reverse.match(/\d{1,3}/g);
            ribuan  = ribuan.join('.').split('').reverse().join('');
            ribuan  = "Rp " + ribuan + ",00";
            html += ribuan+"<input type='hidden' name='subtotal' value='"+subtot+"' readonly>";    
            html2 += ribuan+"<input type='hidden' name='total' id='valtot' value='"+subtot+"' readonly>";
            $('#subtotal').html(html);
            $('#total').html(html2);
        });
    });
</script>
<?php } else{ ?>
    <script type="text/javascript">
        function ganti_uk(id){
            var idbar=$('#barang'+id).val();
            $.ajax({
                url : "<?php echo base_url('T_TambahTransaksi/ukuran/');?>",
                method : "POST",
                data : {id: idbar},
                async : false,
                dataType : 'json',
                success: function(data){
                    var html = '';
                    var i;
                    for(i=0; i<data.length; i++){
                        html += '<option value='+data[i].ID_UK+'>'+data[i].UKURAN+'</option>';
                    }
                    $('#ukuran'+id).html(html);
                     
                }
            });
        }

        function ganti_kon(id){
            var iduk = $("#ukuran"+id).val();
            var idbar = $("#barang"+id).val();
            $.ajax({
                url : "<?php echo base_url('T_TambahTransaksi/warna/');?>",
                method : "POST",
                data:"iduk="+iduk+'&idbar='+idbar,
                async : false,
                dataType : 'json',
                success: function(data){
                    var html = '';
                    var i;
                    for(i=0; i<data.length; i++){
                        html += '<option value='+data[i].ID_WAR+'>'+data[i].WARNA+'</option>';
                    }
                    $('#warna'+id).html(html);
                     
                }
            });
        }

        function ganti_harga(id){
            var idbar = $("#barang"+id).val();
            $.ajax({
                url : "<?php echo base_url('T_TambahTransaksi/harga/');?>",
                method : "POST",
                data:'idbar='+idbar,
                async : false,
                dataType : 'json',
                success: function(data){
                    var html = '';
                    var i;
                    for(i=0; i<data.length; i++){
                        var reverse = data[i].HARGA_BAR.toString().split('').reverse().join(''),
                        ribuan  = reverse.match(/\d{1,3}/g);
                        ribuan  = ribuan.join('.').split('').reverse().join('');
                        ribuan  = "Rp " + ribuan + ",00";
                        html += ribuan+"<input type='hidden' name='hargabar["+id+"]' id='hargabar"+id+"' value='"+data[i].HARGA_BAR+"' readonly>";
                    }
                    $('#harga'+id).html(html);
                     
                }
            });
        }

        function ganti_total(){
            var html = '';
            <?php for ($i = 0 ;$i < $id; $i++) { ?>
            var subtot<?php echo $i ?> = parseInt($("#subtot<?php echo $i?>").val());
            <?php } ?>
            var total = <?php for ($i = 0 ;$i < $id; $i++) {
                if ($id == $i+1) {
                    echo "subtot".$i.';';
                }else{
                    echo "subtot".$i.'+';
                }
            } ?>
            
            var reverse = total.toString().split('').reverse().join(''),
            ribuan  = reverse.match(/\d{1,3}/g);
            ribuan  = ribuan.join('.').split('').reverse().join('');
            ribuan  = "Rp " + ribuan + ",00";
            html += ribuan+"<input type='hidden' name='total' id='valtot' value='"+total+"' readonly>";
            $('#total').html(html);
        }

        function ganti_subtot(id){
            var html = '';
            var jmlh = parseInt($("#jumlah"+id).val());
            var hrg = parseInt($("#hargabar"+id).val());
            var subtot = jmlh*hrg;
            var reverse = subtot.toString().split('').reverse().join(''),
            ribuan  = reverse.match(/\d{1,3}/g);
            ribuan  = ribuan.join('.').split('').reverse().join('');
            ribuan  = "Rp " + ribuan + ",00";
            html += ribuan+"<input type='hidden' name='subtotal["+id+"]' id='subtot"+id+"' value='"+subtot+"' readonly>";
            $('#subtotal'+id).html(html);
            ganti_total();
        }

    </script>
<?php } ?>
<script type="text/javascript">
    document.getElementById("pengiriman").style.display = "none";

    function TFFunction() { 
        var checkBox = document.getElementById("TF");
        var html = '';
        var valtot = $("#valtot").val();
        if(valtot != null){
            if (checkBox.checked == true){
                var dp = parseInt(valtot/2);
                html += "<div class=\"col-md-12\">"
                html += "<input type=\"file\" class=\"form-control\" name=\"userfile\" id='fileInput' onchange=\"AlertFilesize(this.id,2048,'KB')\" required> </div>"
            }else{
                html = '';
            }
        }else{
            alert("Silahkan isi semua barang terlebih dahulu");
            checkBox.checked = false;
        }
        $('#formTF').html(html);
    }

    function DPFunction() { 
        var checkBox = document.getElementById("DP");
        var html = '';
        var valtot = $("#valtot").val();
        if(valtot != null){
            if (checkBox.checked == true){
                var dp = parseInt(valtot/2);
                html += "<div class=\"col-md-12\">"
                html += "<input type=\"text\" class=\"form-control\" placeholder=\"Nama KTP\" name=\"NamaKTP\" style=\"width:200px\" required> </div>"
                html += "<div class=\"col-md-12\">"
                html += "<input type=\"number\" class=\"form-control\" placeholder=\"Nomer KTP\" name=\"NoKTP\" style=\"width:200px\" required> </div>"
                html += "<div class=\"col-md-12\">"
                html += "<input type=\"number\" class=\"form-control\" placeholder=\"harga\" name=\"DPval\" min=\""+dp+"\" style=\"width: 200px\" required> </div>"
            }else{
                html = '';
            }
        }else{
            alert("Silahkan isi semua barang terlebih dahulu");
            checkBox.checked = false;
        }
        $('#formDP').html(html);
    };

    function KIRIMFunction() {
        var checkBox = document.getElementById("KIRIM");
        var x = document.getElementById("formbarang");
        var y = document.getElementById("pengiriman");
        var valtot = $("#valtot").val();
        if(valtot != null){
            if (checkBox.checked == true){
                y.style.display = "block";
                document.getElementById("nama").required = true; 
                document.getElementById("alamat").required = true; 
                document.getElementById("kodepos").required = true; 
                document.getElementById("provinsi").required = true; 
                document.getElementById("kota").required = true; 
                document.getElementById("telepon").required = true;
                document.getElementById("kurir").required = true;
                document.getElementById("layanan").required = true;   
            }else{
                y.style.display = "none";
                x.style.display = "block";
                document.getElementById("nama").required = false; 
                document.getElementById("alamat").required = false; 
                document.getElementById("kodepos").required = false; 
                document.getElementById("provinsi").required = false; 
                document.getElementById("kota").required = false; 
                document.getElementById("telepon").required = false;
                document.getElementById("kurir").required = false;
                document.getElementById("layanan").required = false;
                document.getElementById("ongkir").required = false;
            }
        }else{
            alert("Silahkan isi semua barang terlebih dahulu");
            checkBox.checked = false;
        }
    }

    function jasaFunction() { 
        //var html = $("#kota").val();
        //var html = $("#kurir").val();
        //$('#coba').html(html);
        var idkota = $("#kota").val();
        var kurir = $("#kurir").val();
        $.ajax({
            url : "<?php echo base_url('T_TambahTransaksi/layanan/');?>",
            method : "POST",
            data:"idkota="+idkota+'&kurir='+kurir,
            async : false,
            dataType : 'json',
            success: function(data){
                var html = '';
                var ongkir = '';
                var i;
                for(i=0; i<data.length; i++){
                    html += '<option value="'+data[i]+'">'+data[i]+'</option>';
                }
                $('#layanan').html(html);
            }
        });
    };

    function layananFunction() { 
        //var html = $("#kota").val();
        //var html = $("#kurir").val();
        //$('#coba').html(html);
        var idkota = $("#kota").val();
        var kurir = $("#kurir").val();
        var layanan = $("#layanan").val();
        $.ajax({
            url : "<?php echo base_url('T_TambahTransaksi/ongkir/');?>",
            method : "POST",
            data:"idkota="+idkota+'&kurir='+kurir+'&layanan='+layanan,
            async : false,
            dataType : 'json',
            success: function(data){
                html = '<label for="ongkir">ongkir</label><input type="text" class="form-control mb-3" name="ongkir" id="ongkirval" value="'+data+'" readonly required>'
                $('#ongkir').html(html);
            }
        });
    };

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

</script>