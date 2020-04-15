
<!-- Breadcumbs -->
    
    <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Pengiriman</h4> </div>
                    <!-- Breadcumbs  -->
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> 
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url('Admin') ?>"> Beranda </a></li>
                            <li class="active">Data Pengiriman</li>
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
            <li role="presentation" class="nav-item" aria-expanded="false"><a href="#bank" class="nav-link active" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs"> Data Pengiriman</span></a></li>
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
                                        <th>Nama penerima</th>
                                        <th>Layanan</th>
                                        <th>Ongkos kirim</th>
                                        <th>Total harga</th>
                                        <th>Status</th>
                                        <th style="text-align:center;">Aksi</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    <?php 
                                    $number     =   1;
                                    foreach ($pemesanan as $data) { 

                                        ?>
                                    <tr>
                                        <td><?php echo '#'.$data->NO_INVOICE ?></td>
                                        <td><?php $number++; echo $data->NAMA_PEN?> </td>
                                        <td> <?php echo substr($this->Master->get_tabel('jenis_pengiriman',array('ID_JEN' => $data->ID_JEN),'NAMA_JEN').' - '.$data->LAYANAN_PESAN,0,15).'...' ?></td>
                                        <td> <?php echo $this->Master->rupiah($data->ONGKIR_PESAN) ?></td>
                                        <td>
                                            <?php echo $this->Master->rupiah($data->TOTAL_HARGA_PESAN); ?>
                                        </td>
                                        <td><?php echo substr($this->Master->get_tabel('status',array('ID_STAT' => $data->ID_STAT),'NAMA_STAT'),0,15).'...' ?></td>
                                        <td align="center">
                                        <?php if ($data->ID_STAT == 'SP4') { ?>
                                            <a class="btn btn-sm btn-circle btn-success" href="javascript:void(0)" onclick="window.location.href='<?php echo base_url("T_Pengiriman/Packing/$data->NO_INVOICE-SP5") ?>'" ><i data-toggle="tooltip" data-title="Packing barang" class="fa fa-chevron-circle-up"></i></a>
                                        <?php }elseif ($data->ID_STAT == 'SP6'){ ?>
                                            <a class="btn btn-sm btn-circle btn-success" href="javascript:void(0)" onclick="window.location.href='<?php echo base_url("T_Pengiriman/Packing/$data->NO_INVOICE-ST2") ?>'" ><i data-toggle="tooltip" data-title="Pengiriman selesai" class="fa fa-chevron-circle-up"></i></a>
                                        <?php }elseif ($data->ID_STAT == 'SP5' or $data->STATUS_DP == 2){ ?>
                                            <a class="btn btn-sm btn-circle btn-primary" data-toggle="modal" href="#data_<?php echo $number ?>" ><i data-toggle="tooltip" data-title="Edit" class="fa fa-pencil"></i></a>
                                        <?php } ?>
                                            <a class="btn btn-sm btn-circle btn-info" data-toggle="tooltip" data-title="Detail Transaksi" href="javascript:void(0)" onclick="window.open('<?php echo base_url("admin/DetailTransaksi/".(substr($data->NO_INVOICE,1))) ?>','_blank')"><i class="fa fa-search"></i></a>
                                        </td>
<div class="modal fade bs-example-modal-lg" tabindex="-1" id="data_<?php echo $number ?>" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title" id="myLargeModalLabel">Tambah Pengiriman</h4>
                            <p><?php echo '#'.$data->NO_INVOICE ?></p>
                        </div>
                        <div class="modal-body">
                            
            <!-- Form  -->
          
            <form class="form-horizontal" method="post" action='
            <?php
            if($data->STATUS_DP == 2){
                echo base_url('T_Pengiriman/Save2/').$data->NO_INVOICE; 
            }else{
                echo base_url('T_Pengiriman/Save/').$data->NO_INVOICE;
            }
            ?>
            ' id="form1">

                <div class="form-group">
                    <label class="col-md-12">Nomer resi</label>
                    <div class="col-md-12">
                        <input type="text" class="form-control" name="noresi"  minlength="5" maxlength="12" required> </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12">Tanggal kirim</label>
                    <div class="col-md-12">
                       <input type="date" name="tglkirim" class="form-control" min="<?php echo date('Y-m-d'); ?>" max="<?php echo date("Y-m-d", strtotime("+ 3 day")); ?>" required> </div>
                </div>
                    <!-- <input type="submit" value="asd" class="btn btn-default"> -->
                            
                            <!-- Form -->
                        </div>
                            <div class="modal-footer">
                            <button type="submit" class="btn btn-primary waves-effect text-right">Save</button> 

                            <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                    </form>
                <!-- </form> -->
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- :: Modals Edit :: -->

                                    </tr>
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
     
