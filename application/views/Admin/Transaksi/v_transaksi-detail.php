<!-- Breadcumbs -->
	
	<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Detail transaksi</h4> </div>
                    <!-- Breadcumbs  -->
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> 
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url('Admin') ?>"> Beranda </a></li>
                            <li><a href="<?php echo base_url('admin/Transaksi') ?>"> Data Transaksi</a></li>
                            <li class="active">Detail Transaksi</li>
                        </ol>
                    </div>
                    <!-- /Breadcumbs  -->
                    <!-- /.col-lg-12 -->
                </div>

<!-- /Breadcumbs -->




          </div> 



<div class="row">
    <div class="col-md-3"></div>
    <div class="col-lg-6 col-sm-6 col-xs-12">
        <div class="white-box">
            
            <!-- Nav tabs -->
            <ul class="nav customtab nav-tabs" role="tablist">
                <li role="presentation" class="nav-item"><a href="#pelanggan" class="nav-link pull-left active" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs">Pelanggan</span></a></li>
                <li role="presentation" class="nav-item"><a href="#pemesanan" class="nav-link pull-left" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs">Pemesanan</span></a></li>
                <?php if (isset($pembayaran)) { ?>
                <li role="presentation" class="nav-item"><a href="#pembayaran" class="nav-link pull-right" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs">pembayaran</span></a></li>
                <?php } ?>
                <?php if (isset($pengiriman)) { ?>
                <li role="presentation" class="nav-item"><a href="#pengiriman" class="nav-link pull-right" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs">pengiriman</span></a></li>
                <?php } ?>
        
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">

                <div role="tabpanel" class="tab-pane fade active in" id="pelanggan">
                            <hr>
                            <h4 align="center">Data Pemesan</h4>
                            <hr>
                            <div class="form-group">
                                <label class="col-md-6">Email</label>
                                <label class="col-md-6">
                                 <?php echo $pelanggan->EMAIL_CUS ?>
                                <label></div>
                            <div class="form-group">
                                <label class="col-md-6">Nama</label>
                                <label class="col-md-6"><?php 
                                    if(isset($pemesanan->NAMA_KTP)){
                                        echo $pemesanan->NAMA_KTP;
                                    }else{
                                        echo $pelanggan->NAMA_CUS;
                                    } 
                                ?></label></div>
                            
                            <div class="form-group">
                                <label class="col-md-6">telepon</label>
                                <label class="col-md-6">
                                 <?php echo $pelanggan->TELEPON_CUS ?>
                                <label></div>
                            <?php if (isset($pemesanan->NOMER_KTP)): ?>
                            <div class="form-group">
                                <label class="col-md-6">Nomer KTP</label>
                                <label class="col-md-6">
                                 <?php echo $pemesanan->NOMER_KTP ?>
                                <label></div>
                            <?php endif ?>

                             
                        <div class="clearfix"></div>
                            <hr>
                        <h4 align="center">Data Penerima</h4>
                            <hr>
                            <div class="form-group">
                                <label class="col-md-6">Nama</label>
                                <label class="col-md-6">
                                 <?php echo $pemesanan->NAMA_PEN; ?>
                                 <label></div>

                            <div class="form-group">
                                <label class="col-md-6">Alamat</label>
                                <label class="col-md-6">
                                <?php echo $pemesanan->ALAMAT_PEN.', '.$this->Master->get_tabel('kota',array('ID_KOTA' => $pemesanan->ID_KOTA),'NAMA_KOTA').', '.$this->Master->get_tabel('provinsi',array('ID_PROV' => $this->Master->get_tabel('kota',array('ID_KOTA' => $pemesanan->ID_KOTA),'ID_PROV')),'NAMA_PROV'); ?>   
                                </label></div>

                            
                            <div class="form-group">
                                <label class="col-md-6">Telepon</label>
                                <label class="col-md-6">
                                <?php echo $pemesanan->TELEPON_PEN; ?>                        
                                </label></div>

                            <div class="form-group">
                                <label class="col-md-6">Kodepos</label>
                                <label class="col-md-6">
                                <?php echo $pemesanan->KODEPOS_PEN; ?>
                                </label></div>

                            <?php if (isset($pemesanan->ID_JEN)): ?>
                            <div class="form-group">
                                <label class="col-md-6">Jasa pengiriman</label>
                                <label class="col-md-6">
                                <?php echo $this->Master->get_tabel('jenis_pengiriman',array('ID_JEN' => $pemesanan->ID_JEN),'NAMA_JEN'); ?>
                                </label></div>
                            <div class="form-group">
                                <label class="col-md-6">Layanan pesan</label>
                                <label class="col-md-6">
                                <?php echo $pemesanan->LAYANAN_PESAN; ?>
                                </label></div>    
                            <?php endif ?>
                            

                             
                        <div class="clearfix"></div>
                        
                </div>
                <div role="tabpanel" class="tab-pane fade 
                " id="pemesanan">

                            <h4 align="center">Data pemesanan</h4><br>

                        <div class="form-group">
                            <label class="col-md-6">Tanggal transaksi</label>
                            <label class="col-md-6" style="text-align: right">
                             <?php echo $pemesanan->TGL_TRANSAKSI ?>
                            <label></div>

                        <div class="form-group">
                            <label class="col-md-6">Status</label>
                            <label class="col-md-6"  style="text-align: right">
                            <?php echo $this->Master->get_tabel('status',array('ID_STAT' => $pemesanan->ID_STAT),'NAMA_STAT') ?>
                            <label></div>
                        <div class="clearfix"></div>

                            <table class="table table">
                            <thead>
                              <tr>
                                <th style="text-align: center;">Barang</th>
                                <th style="text-align: center;">Ukuran</th>
                                <th style="text-align: center;">Kain</th>
                                <th style="text-align: center;">Jumlah</th>
                                <th style="width: 140px; text-align: right;">Subtotal</th>
                              </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($detail as $det) { ?>
                                <tr>
                                    <td><?php
                                    echo $this->Master->get_tabel('barang',array('ID_BAR' => $det->ID_BAR),'NAMA_BAR');
                                    ?></td>
                                    <td><?php
                                    echo $this->Master->get_tabel('ukuran',array('ID_UK' => $det->ID_UK),'UKURAN');
                                    ?></td>
                                    <td><?php
                                    echo $this->Master->get_tabel('warna',array('ID_WAR' => $det->ID_WAR),'WARNA');
                                    ?></td>
                                    <td style="text-align: center;"><?php echo $det->JUMLAH?></td>
                                    <td style="text-align: right;"><?php echo $this->Master->rupiah($det->SUBTOTAL)?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                            </table>



                        <hr>
                        

                        <div class="form-group">
                            <label class="col-md-6">Subtotal</label>
                            <label class="col-md-6" style="text-align: right">
                             <?php echo $this->Master->rupiah($pemesanan->TOTAL_HARGA_PESAN-$pemesanan->ONGKIR_PESAN); ?>
                            <label></div>

                        <div class="form-group">
                            <label class="col-md-6">Ongkos kirim</label>
                            <label class="col-md-6" style="text-align: right">
                             <?php echo $this->Master->rupiah($pemesanan->ONGKIR_PESAN); ?>
                            <label></div>

                        <div class="form-group">
                            <label class="col-md-6">Total harga</label>
                            <label class="col-md-6" style="text-align: right">
                            <?php echo $this->Master->rupiah($pemesanan->TOTAL_HARGA_PESAN);
                             ?>
                            <label></div>  

                        <div class="clearfix"></div>



                        

                </div>
                
                <?php if (isset($pembayaran)) { ?>
                <div role="tabpanel" class="tab-pane fade" id="pembayaran">
                        
                        <h3 align="center">Data Pembayaran</h3>
                        <hr>
                        <?php 
                            foreach ($pembayaran as $bayar) {
                        ?>
                        <div class="form-group">
                            <label class="col-md-6">Nama Pegawai PJ</label>
                            <label class="col-md-6">
                             <?php echo $this->Master->get_tabel('pegawai',array('ID_PEG' => $bayar->ID_PEG),'NAMA_PEG'); ?>
                            <label></div>

                        <div class="form-group">
                            <label class="col-md-6">Tanggal bayar</label>
                            <label class="col-md-6">
                             <?php echo $bayar->TGL_BAYAR ?>
                            <label></div>

                        <div class="form-group">
                            <label class="col-md-6">Harga bayar</label>
                            <label class="col-md-6">
                             <?php echo $bayar->HARGA_BAYAR ?><br>
                            <label></div>
                        <?php if ($bayar->BUKTI_BAYAR): ?>                            
                        <div class="form-group">
                            <label class="col-md-6">Bukti bayar</label>
                            <label class="col-md-6">
                             <a href="<?php echo base_url('upload/pembayaran/'.$bayar->BUKTI_BAYAR) ?>" target="_blank"><?php echo $bayar->BUKTI_BAYAR ?></a>
                            <label></div>
                        <?php endif ?>
                        <?php } ?>


                    <div class="clearfix"></div>
                </div>
                <?php } 
                if ($pengiriman != null) { ?>
                <div role="tabpanel" class="tab-pane fade" id="pengiriman">
                        
                        <h3 align="center">Data Pengiriman</h3>
                        

                        <div class="form-group">
                            <label class="col-md-6">Nomer resi</label>
                            <label class="col-md-6">
                             <?php echo $pengiriman->NO_RESI ?>
                            <label></div>
                        
                        <div class="form-group">
                            <label class="col-md-6">Tanggal kirim</label>
                            <label class="col-md-6">
                            <?php echo $pengiriman->TGL_KIRIM ?>
                            <label></div>



                    <div class="clearfix"></div>
                </div>
                <?php } ?>
            </div>
            <hr>
            <button class="btn btn-primary" onclick="window.location.href='<?php echo base_url('admin/Transaksi')?>'">Kembali</button>
            <button class="btn btn-success" onclick="window.open('<?php 
            if ($pelanggan->ID_CUS == 'C00001') {
                echo base_url('admin/Transaksi/print/'.$pemesanan->NO_INVOICE);    
            }else{
                echo base_url('admin/Transaksi/print_invoice/'.$pemesanan->NO_INVOICE);
            } ?>','_blank')">Print</button>
        </div>
    </div>
 </div>