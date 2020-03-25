
<!-- Breadcumbs -->
    
    <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Informasi Transaksi</h4> </div>
                    <!-- Breadcumbs  -->
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> 
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url('Admin') ?>"> Beranda </a></li>
                            <li class="active">Data Transaksi</li>
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
            <li role="presentation" class="nav-item" aria-expanded="false"><a href="#bank" class="nav-link active" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs"> Data Transaksi</span></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="bank" aria-expanded="true">
                <div class="col-sm-12">
                    <div>
                        <h3 class="box-title m-b-0">Data Transaksi </h3>
                        <!-- <p class="text-muted m-b-30">Data dapat di Export menjadi Berikut ini:</p> -->
                        <div class="table-responsive">
                            <table id="myTable" class="display nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Invoice</th>
                                        <th>Nama pengirim</th>
                                        <th>Pembayaran</th>
                                        <th>Total harga</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    <?php 
                                    $number     =   1;
                                    foreach ($pemesanan as $data) { ?>
                                    <tr>
                                        <td><?php echo '#'.$data->NO_INVOICE ?></td>
                                        <td><?php $number++;
                                        if ($data->ID_CUS != 'C00001') {
                                            echo $this->Master->get_tabel('customer',array('ID_CUS' => $data->ID_CUS),'NAMA_CUS');
                                        }else{
                                            if(isset($data->NAMA_KTP)){
                                                echo $data->NAMA_KTP;
                                            }else{
                                                echo "Pelanggan langsung";
                                            }
                                        }
                                        ?> </td>
                                        <td><?php 
                                            echo $this->Master->get_tabel('pembayaran',array('NO_INVOICE' => $data->NO_INVOICE),'JENIS_BAYAR');
                                        ?></td>
                                        <td>
                                            <?php echo $this->Master->rupiah($data->TOTAL_HARGA_PESAN); ?>
                                        </td>
                                        <td><?php echo $this->Master->get_tabel('status',array('ID_STAT' => $data->ID_STAT),'NAMA_STAT') ?></td>
                                        <td>    
                                            <a class="btn btn-sm btn-circle btn-warning" data-toggle="tooltip" data-title="Detail Transaksi" href="javascript:void(0)" onclick="window.location.href='<?php echo base_url("admin/DetailTransaksi/".(substr($data->NO_INVOICE,1))) ?>'"><i class="fa fa-search"></i></a>
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
<?php if(isset($_SESSION['print'])){
  echo '<script>window.open("Transaksi/print","_blank");
  </script>';
  unset($_SESSION['print']);
} ?>
                    <script src="<?php echo base_url('asset/js/jquery.chained.min.js') ?>"></script>
<script>
            $("#kota").chained("#provinsi"); // disini kita hubungkan kota dengan provinsi
            <?php for($a=2;$a<=$number;$a++){ ?>
            $("#kota<?php echo $a?>").chained("#provinsi<?php echo $a?>");
            <?php } ?>
        </script>
     
