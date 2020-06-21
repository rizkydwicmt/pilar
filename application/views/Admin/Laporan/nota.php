<html lang="en"><head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url('asset/') ?>/plugins/images/favicon.png">
    <title>System Information Expedition</title>
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url('asset/') ?>bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Datatable -->
    <link href="<?php echo base_url('/')?>plugins/bower_components/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />

    <link href="<?php echo base_url('/') ?>plugins/bower_components/bootstrap-extension/css/bootstrap-extension.css" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="<?php echo base_url('/') ?>plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <!-- morris CSS -->
    <link href="<?php echo base_url('/') ?>plugins/bower_components/morrisjs/morris.css" rel="stylesheet">
    <!-- animation CSS -->
    <link href="<?php echo base_url('asset/') ?>css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo base_url('asset/') ?>css/style.min.css" rel="stylesheet">
    <script type="text/javascript" src="<?php echo base_url() ?>asset/ckeditor/ckeditor.js" ></script>
    <script src="//cdn.ckeditor.com/4.8.0/standard/ckeditor.js"></script>
    <link rel="stylesheet" href="<?php echo base_url('/') ?>plugins/select2/select2.min.css">
    
                              
    <!-- color CSS -->
    <link href="<?php echo base_url('asset/') ?>css/colors/blue.css" id="theme" rel="stylesheet">
    <!-- Link -->
    <link rel="stylesheet" href="<?php echo base_url('asset/') ?>select-bootstrap/dist/css/bootstrap-select.min.css">
    <!-- Script -->
    
    <script src="<?php echo base_url('/') ?>plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <style type="text/css">
     #notifications {
        cursor: pointer;
        position: fixed;
        right: 0px;
        z-index: 9999;
        bottom: 0px;
        margin-bottom: 22px;
        margin-right: 15px;
        min-width: 300px; 
        max-width: 800px;  
    }
    .error_hehe  {
        border-color: red;
    }
    </style>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<style type="text/css">.jqstooltip { position: absolute;left: 0px;top: 0px;visibility: hidden;background: rgb(0, 0, 0) transparent;background-color: rgba(0,0,0,0.6);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000);-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";color: white;font: 10px arial, san serif;text-align: left;white-space: nowrap;padding: 5px;border: 1px solid white;z-index: 10000;}.jqsfield { color: white;font: 10px arial, san serif;text-align: left;}</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.3.0/paper.css">
<style>
@media print{
    @page {
        size: C5;
        margin: 100%;
        align-content: center;
    }
}
</style>
</head>
<body class="C5">
    <div class="row">
    
        <div class="white-box">
            
            <!-- Nav tabs -->
            <?php
                //mencari status pembayaran dan pegawai
                $pembayaran = $this->Master->get_tabel('pembayaran',array('ID_PEMESANAN' => $pemesanan->ID_PEMESANAN),'', 'ID_PEMBAYARAN DESC');
                $status_bayar = $pembayaran->STATUS_PEMBAYARAN;
                $pegawai = $this->Master->get_tabel('pegawai',array('ID_PEGAWAI' => $pembayaran->ID_PEGAWAI),'NAMA_PEGAWAI');
            ?>
            <!-- Tab panes -->
            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade 
                fade active in                " id="pemesanan">
                <h3 align="center">PT.PILAR PUTRA</h3>
                <p align="center">Dsn. Tambang, Kec. Jatirejo<br>Mojokerto</p>
                        <table width="100%">
                            <tr>
                                <td style="color: #686868;">
                                    <p style="font-size: 12px;margin-bottom: unset;"> 
                                        <?php echo 'No.Nota: '.$pemesanan->ID_PEMESANAN ?><br>
                                        <?php echo 'Pegawai: '.$pegawai ?>
                                    </p>
                                </td>
                                <td align="right" style="color: #686868;">
                                <?php echo 'Status Bayar: ';
                                                if($pemesanan->SISTEM_BAYAR=='Kontan'){
                                                    echo 'Lunas';
                                                }else{
                                                    echo $status_bayar;
                                                }
                                        ?><br>
                                <?php echo $pemesanan->TGL_PESAN ?>
                                </td>
                            </tr>
                        </table>

                        <div class="clearfix"></div>

                        <table class="table table">
                            <thead>
                              <tr>
                              <th style="text-align: center;">Jenis domba</th>
                                <th style="text-align: center;">Jenis Kelamin</th>
                                <th style="text-align: center;">Jumlah</th>
                                <th style="text-align: center;">Berat</th>
                                <th style="text-align: center;">Diskon</th>
                                <th style="width: 140px; text-align: right;">Subtotal</th>
                              </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($detail as $det) { ?>
                                <tr>
                                    <td style="color: #686868;font-size: 14px;"><?php
                                        //cari jenis domba
                                        $id_jenis = $this->Master->get_tabel('domba',array('ID_DOMBA' => $det->ID_DOMBA),'ID_JENIS');
                                        $jenis_domba = $this->Master->get_tabel('jenis_domba',array('ID_JENIS' => $id_jenis),'JENIS_DOMBA');
                                        echo $jenis_domba;
                                    ?></td>
                                    <td style="color: #686868;font-size: 14px;"><?php
                                        echo $this->Master->get_tabel('domba',array('ID_DOMBA' => $det->ID_DOMBA),'JENIS_KELAMIN');
                                    ?></td>
                                    <td style="color: #686868;font-size: 14px;"><?php echo $det->JUMLAH ?></td>
                                    <td style="text-align: center; color: #686868;font-size: 14px;"><?php echo $det->BERAT ?></td>
                                    <td style="text-align: center; color: #686868;font-size: 14px;"><?php echo $this->Master->rupiah(-$det->DISKON) ?></td>
                                    <td style="text-align: right; color: #686868;font-size: 14px;"><?php echo $this->Master->rupiah($det->SUBTOTAL)?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <hr>
                        
                        <table width="100%">
                            <tr>
                                <td style="color: #686868;">Subtotal</td>
                                <td align="right" style="color: #686868;">
                                    <?= $this->Master->rupiah($pemesanan->TOTAL_HARGA-$pemesanan->ONGKOS_KIRIM); ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="color: #686868;">Ongkos kirim</td>
                                <td align="right" style="color: #686868;">
                                    <?= $this->Master->rupiah($pemesanan->ONGKOS_KIRIM); ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="color: #686868;">Total harga</td>
                                <td align="right" style="color: #686868;">
                                    <?= $this->Master->rupiah($pemesanan->TOTAL_HARGA);?>
                                </td>
                            </tr>
                        </table>
                        
                        <hr>

                        <table width="100%">
                            <tr>
                                <td style="color: #686868;">Telah Bayar</td>
                                <td align="right" style="color: #686868;"><?php echo $this->Master->rupiah($pembayaran->TOTAL_PEMBAYARAN) ?></td>
                            </tr>
                            <tr>
                                <td style="color: #686868;">Kurang</td>
                                <td align="right" style="color: #686868;">      <?php echo $this->Master->rupiah($pemesanan->TOTAL_HARGA-$pembayaran->TOTAL_PEMBAYARAN); ?></td>
                            </tr>
                            </tr>
                        </table>

                        <?php
                        
                        ?>

                        <div class="clearfix"></div>
                        



                        

                </div>
                
                            </div>
            <hr>
            
    </div>
 </div>                                            

        <!-- /#page-wrapper -->
    
    <!-- /#wrapper -->
    <!-- jQuery -->
    
    

    


</body></html>
<script type="text/javascript">
    window.print();
    // setTimeout(window.close, 0);

</script>