<!-- Breadcumbs -->


    <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Selamat Datang</h4> </div>
                    <!-- Breadcumbs  -->
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> 
                        <ol class="breadcrumb">
                            <li class="active"> Beranda</li>
                            <!-- <li class="active">Data Bank</li> -->
                        </ol>
                    </div>
                    <!-- /Breadcumbs  -->
                    <!-- /.col-lg-12 -->
                </div>

<!-- /Breadcumbs -->
<div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="white-box">
                            <div class="r-icon-stats"> 
                                <div class="row">
                                    <div class="col-sm-3">
                                        <a href="<?= base_url('admin/Transaksi') ?>"><i class="ti-shopping-cart" style="background: blue;"></i></a>
                                        <div class="bodystate">
                                            <h4><?php echo $total; ?></h4> <span class="text-muted">Total Transaksi</span> 
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <a href="
                                        <?php 
                                            if($_SESSION['id_role'] =='JB002'){ 
                                                echo base_url('admin/Pembayaran');
                                            } 
                                        ?>
                                        "><i class="ti-shopping-cart" style="background: red;"></i></a>
                                        <div class="bodystate">
                                            <h4><?php echo $sukses; ?></h4> <span class="text-muted">Belum lunas</span> 
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <a href="
                                        <?php 
                                            if($_SESSION['id_role'] =='JB002'){ 
                                                echo base_url('admin/Pengiriman');
                                            } 
                                        ?>
                                        "><i class="ti-shopping-cart" style="background: orange;"></i></a>
                                        <div class="bodystate">
                                            <h4><?php echo $dikirim; ?></h4> <span class="text-muted">Sedang dikirim</span> 
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <a href="<?= base_url('admin/Transaksi') ?>"><i class="ti-shopping-cart" style="background: green;"></i></a>
                                        <div class="bodystate">
                                            <h4><?php echo $sukses; ?></h4> <span class="text-muted">Transaksi Sukses</span> 
                                        </div>
                                    </div>    
                                </div>
                            </div>
                        </div>
                    </div>
                   
                </div>
  </div>

<script src="assets/js/jquery/jquery-2.2.4.min.js"></script>
<script type="text/javascript">
    // if(typeof(EventSource) !== "undefined") {
    //   var source = new EventSource("<?php //echo base_url('SSE/updateAdminDashboard/'); ?>");
    //   source.onmessage = function(event) {
    //     var obj = JSON.parse(event.data);
    //     $('#total').html(obj.total);
    //     $('#menunggu').html(obj.menunggu);
    //     $('#sukses').html(obj.sukses);
    //     $('#gagal').html(obj.gagal);
    //   };
    // }
</script>