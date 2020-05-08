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
                                <label class="col-md-6">Nama</label>
                                <label class="col-md-6"><?php 
                                        echo $pelanggan->NAMA_PELANGGAN;
                                ?></label></div>
                            
                            <div class="form-group">
                                <label class="col-md-6">telepon</label>
                                <label class="col-md-6">
                                 <?php echo $pelanggan->TELP_PELANGGAN ?>
                                <label></div>

                        <div class="clearfix"></div>
                            <hr>
                        <h4 align="center">Data Penerima</h4>
                            <hr>
                            <div class="form-group">
                                <label class="col-md-6">Nama</label>
                                <label class="col-md-6">
                                 <?php echo $pemesanan->NAMA_PENERIMA; ?>
                                 <label></div>

                            <div class="form-group">
                                <label class="col-md-6">Alamat</label>
                                <label class="col-md-6">
                                <?php echo $pemesanan->ALAMAT_PENERIMA.', '.$this->Master->get_tabel('kota',array('ID_KOTA' => $pemesanan->ID_KOTA),'NAMA_KOTA').', '.$this->Master->get_tabel('provinsi',array('ID_PROV' => $this->Master->get_tabel('kota',array('ID_KOTA' => $pemesanan->ID_KOTA),'ID_PROV')),'NAMA_PROV'); ?>   
                                </label></div>
                            
                            <div class="form-group">
                                <label class="col-md-6">Telepon</label>
                                <label class="col-md-6">
                                <?php echo $pemesanan->TELP_PENERIMA; ?>                        
                                </label></div>

                            <div class="form-group">
                                <label class="col-md-6">Kodepos</label>
                                <label class="col-md-6">
                                <?php echo $pemesanan->KODEPOS_PENERIMA; ?>
                                </label></div>

                        <div class="clearfix"></div>
                        
                </div>
                <div role="tabpanel" class="tab-pane fade 
                " id="pemesanan">

                            <h4 align="center">Data pemesanan</h4><br>

                        <div class="form-group">
                            <label class="col-md-6">Tanggal transaksi</label>
                            <label class="col-md-6" style="text-align: right">
                             <?php echo $pemesanan->TGL_PESAN ?>
                            <label></div>

                        <div class="form-group">
                            <label class="col-md-6">Status</label>
                            <label class="col-md-6"  style="text-align: right">
                            <?php echo $pemesanan->STATUS_TRANSAKSI ?>
                            <label></div>
                        <div class="clearfix"></div>

                            <table class="table table">
                            <thead>
                              <tr>
                                <th style="text-align: center;">Jenis domba</th>
                                <th style="text-align: center;">Jenis Kelamin</th>
                                <th style="text-align: center;">Jumlah</th>
                                <th style="text-align: center;">Berat</th>
                                <th style="width: 140px; text-align: right;">Subtotal</th>
                              </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($detail_pemesanan as $det) { ?>
                                <tr>
                                    <td><?php
                                        //cari jenis domba
                                        $id_jenis = $this->Master->get_tabel('domba',array('ID_DOMBA' => $det->ID_DOMBA),'ID_JENIS');
                                        $jenis_domba = $this->Master->get_tabel('jenis_domba',array('ID_JENIS' => $id_jenis),'JENIS_DOMBA');
                                        echo $jenis_domba;
                                    ?></td>
                                    <td><?php
                                        echo $this->Master->get_tabel('domba',array('ID_DOMBA' => $det->ID_DOMBA),'JENIS_KELAMIN');
                                    ?></td>
                                    <td style="text-align: center;"><?php echo $det->JUMLAH?></td>
                                    <td style="text-align: center;"><?php echo $det->BERAT?></td>
                                    <td style="text-align: right;"><?php echo $this->Master->rupiah($det->SUBTOTAL)?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                            </table>



                        <hr>
                        

                        <div class="form-group">
                            <label class="col-md-6">Subtotal</label>
                            <label class="col-md-6" style="text-align: right">
                             <?php echo $this->Master->rupiah($pemesanan->TOTAL_HARGA-$pemesanan->ONGKOS_KIRIM); ?>
                            <label></div>

                        <div class="form-group">
                            <label class="col-md-6">Ongkos kirim</label>
                            <label class="col-md-6" style="text-align: right">
                             <?php echo $this->Master->rupiah($pemesanan->ONGKOS_KIRIM); ?>
                            <label></div>

                        <div class="form-group">
                            <label class="col-md-6">Total harga</label>
                            <label class="col-md-6" style="text-align: right">
                            <?php echo $this->Master->rupiah($pemesanan->TOTAL_HARGA);
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
                             <?php echo $this->Master->get_tabel('pegawai',array('ID_PEGAWAI' => $bayar->ID_PEGAWAI),'NAMA_PEGAWAI'); ?>
                            </label></div>

                        <div class="form-group">
                            <label class="col-md-6">Tanggal bayar</label>
                            <label class="col-md-6">
                             <?php echo $bayar->TGL_PEMBAYARAN ?>
                            </label></div>

                        <div class="form-group">
                            <label class="col-md-6">Harga bayar</label>
                            <label class="col-md-6">
                             <?php echo $bayar->TOTAL_PEMBAYARAN ?><br>
                            </label></div>
                        <?php if ($bayar->BUKTI_TRANSFER): ?>                            
                        <div class="form-group">
                            <label class="col-md-6">Bukti bayar</label>
                            <label class="col-md-6">
                             <a href="<?php echo base_url('upload/pembayaran/'.$bayar->BUKTI_TRANSFER) ?>" target="_blank"><?php echo $bayar->BUKTI_TRANSFER ?></a>
                            </label></div>
                        <?php endif ?>
                        <div> <label> .</label>
                        </div>
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
                            <?php echo $pengiriman->TGL_PENGIRIMAN ?>
                            <label></div>



                    <div class="clearfix"></div>
                </div>
                <?php } ?>
            </div>
            <hr>
            <button class="btn btn-primary" onclick="window.location.href='<?php echo base_url('admin/Transaksi')?>'">Kembali</button>
            <button class="btn btn-success" onclick="window.open('<?php 
                echo base_url('admin/Transaksi/print/'.$pemesanan->ID_PEMESANAN);
            ?>','_blank')">Print Nota</button>
            <?php 
                if ($pengiriman != null) { 
            ?>
                <button class="btn btn-success" onclick="window.open('<?php 
                echo base_url('T_Pengiriman/print_suratjalan/'.$pemesanan->ID_PEMESANAN);
                ?>','_blank')">Print Surat Jalan</button>
            <?php 
                } 
            ?>
        </div>
    </div>
 </div>