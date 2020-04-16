
<!-- Breadcumbs -->
    
    <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Pembayaran</h4> </div>
                    <!-- Breadcumbs  -->
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> 
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url('Admin') ?>"> Beranda </a></li>
                            <li class="active">Data Pembayaran</li>
                        </ol>
                    </div>
                    <!-- /Breadcumbs  -->
                    <!-- /.col-lg-12 -->
                </div>

<!-- /Breadcumbs -->




                </div> 

<div class="col-lg-12 col-sm-6 col-xs-12">
    <div class="white-box">
        <br>
        <!-- <p class="text-muted m-b-40">Use default tab with class <code>nav-tabs</code></p> -->
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="nav-item" aria-expanded="false"><a href="#bank" class="nav-link active" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs"> Data Pembayaran</span></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="bank" aria-expanded="true">
                <div class="col-sm-12">
                    <div>
                        <h3 class="box-title m-b-0">Data Pembayaran </h3>
                        <!-- <p class="text-muted m-b-30">Data dapat di Export menjadi Berikut ini:</p> -->
                        <div class="table-responsive">
                            <table id="myTable" class="display nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Invoice</th>
                                        <th>Nama pengirim</th>
                                        <th>Total harga</th>
                                        <th>Sudah bayar</th>
                                        <th>Kurang</th>
                                        <th>Status Transaksi</th>
                                        <th style="text-align:center;">Aksi</th>
                                        <th>Dokumen</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    <?php 
                                    $number     =   1;
                                    foreach ($transaksi as $data) { 
                                        ?>
                                    <tr>
                                        <td><?php echo '#'.$data->ID_PEMESANAN ?></td>
                                        <td>
                                            <?php $number++; 
                                            echo $this->Master->get_tabel('pelanggan',array('ID_PELANGGAN' => $data->ID_PELANGGAN),'NAMA_PELANGGAN');
                                        ?>
                                        </td>
                                        <td><?php echo $this->Master->rupiah($data->TOTAL_HARGA); ?></td>
                                        <td>
                                            <?= $this->Master->rupiah($this->Master->get_tabel('pembayaran',array('ID_PEMESANAN' => $data->ID_PEMESANAN),'TOTAL_PEMBAYARAN')) ?>
                                        </td>
                                        <td>
                                            <?= $this->Master->rupiah($data->TOTAL_HARGA-$this->Master->get_tabel('pembayaran',array('ID_PEMESANAN' => $data->ID_PEMESANAN),'TOTAL_PEMBAYARAN')) ?>
                                        </td>
                                        <td><?= $data->STATUS_TRANSAKSI ?></td>
                                        <td align="right">
                                                <form id="form" action="<?php echo base_url("T_Pembayaran/Approve2/$data->ID_PEMESANAN") ?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                                                <a class="btn btn-sm btn-circle btn-success" href="javascript:void(0)" onclick="window.location.href='<?php echo base_url("T_Pembayaran/Tunai/$data->ID_PEMESANAN") ?>'" ><i data-toggle="tooltip" data-title="Tunai" class="fa fa-chevron-circle-up"></i></a>
                                                <label class="btn btn-sm btn-circle btn-success"><i data-toggle="tooltip" data-title="Transfer" class="fa fa-upload" style="color: black"></i>
                                                    <input type="file" style="display: none;" name="userfile" id='fileInput' onchange="AlertFilesize(this.id,2048,'KB','<?php echo($data->ID_PEMESANAN); ?>')" required>
                                                </label>
                                            <a class="btn btn-sm btn-circle btn-info" data-toggle="tooltip" data-title="Detail Transaksi" href="javascript:void(0)" onclick="window.open('<?php echo base_url("admin/DetailTransaksi/".(substr($data->ID_PEMESANAN,1))) ?>','_blank')"><i class="fa fa-search"></i></a>
                                            </form>
                                        </td>
                                        <td align="center">
                                            <a class="btn btn-sm btn-circle btn-secondary" data-toggle="tooltip" data-title="Bukti bayar" href="javascript:void(0)" onclick="window.open('<?php 
                                            echo base_url('upload/pembayaran/'.$this->Master->get_tabel('pembayaran',array('ID_PEMESANAN' => $data->ID_PEMESANAN),'BUKTI_TRANSFER'))
                                            ?>','_blank')" ><i class="fa fa-file-text-o" aria-hidden="true"></i></a>
                                        </td>

                                    <?php } ?>
                                </tbody>
                            </table>
                                   

                                    <!-- :: Modal Detail :: -->
                                    <!-- :: Modals Detail :: -->
                                   
                        </div>
                    </div>     
                </div>
            </div>

           
                                    


           
        </div>
    </div>

                    </div>
                    <script src="<?php echo base_url('asset/js/jquery.chained.min.js') ?>"></script>
        <script>
            $("#kota").chained("#provinsi"); // disini kita hubungkan kota dengan provinsi
            <?php for($a=2;$a<=$number;$a++){ ?>
            $("#kota<?php echo $a?>").chained("#provinsi<?php echo $a?>");
            <?php } ?>
        </script>
<script src="assets/js/jquery/jquery-2.2.4.min.js"></script>
<script type="text/javascript">
    function AlertFilesize(cid,sz,a,b){
        var invoice = b;
        var controllerID = cid;
        var fileSize = sz;
        var extation = a;
        var form = $('form')[0]; // You need to use standard javascript object here
        var formData = new FormData(form);
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
                $.ajax({
                    type: 'post',
                    url: '<?php echo base_url('T_Pembayaran/Transfer/') ?>'+invoice,
                    data: formData,
                    async: false,
                    contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                    processData: false, // NEEDED, DON'T OMIT THIS
                    success: function () {
                      alert('Image Successfully Uploaded');
                      location.reload();
                    }
                });
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
