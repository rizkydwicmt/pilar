
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
                            <li class="active">Pengiriman</li>
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
                    <div>
                        <div class="table-responsive">
                            <table id="myTable" class="display nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Invoice</th>
                                        <th>Nama penerima</th>
                                        <th>Ongkos kirim</th>
                                        <th>Total berat</th>
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
                                        <td><?php echo '#'.$data->ID_PEMESANAN ?></td>
                                        <td><?php $number++; echo $data->NAMA_PENERIMA?> </td>
                                        <td> <?php echo $this->Master->rupiah($data->ONGKOS_KIRIM) ?></td>
                                        <td> <?php echo $data->TOTAL_BERAT.' Kg' ?></td>
                                        <td>
                                            <?php echo $this->Master->rupiah($data->TOTAL_HARGA); ?>
                                        </td>
                                        <td><?php echo $data->STATUS_TRANSAKSI ?></td>
                                        <td align="center">
                                            <?php
                                                if($data->STATUS_TRANSAKSI=='Menunggu pengiriman'){
                                            ?>
                                            <a class="btn btn-sm btn-circle btn-primary" data-toggle="modal" href="#data_<?php echo $number ?>" ><i data-toggle="tooltip" data-title="Tambah Pengiriman" class="fa fa-plus-circle"></i></a>
                                            <?php
                                                }else if($data->STATUS_TRANSAKSI=='Sedang dikirim'){
                                            ?>
                                            <a class="btn btn-sm btn-circle btn-success" href="javascript:void(0)" onclick="window.location.href='<?php echo base_url("T_Pengiriman/Update/$data->ID_PEMESANAN") ?>'" ><i data-toggle="tooltip" data-title="Pengiriman selesai" class="fa fa-chevron-circle-up"></i></a>
                                            <?php } ?>
                                            <a class="btn btn-sm btn-circle btn-info" data-toggle="tooltip" data-title="Detail Transaksi" href="javascript:void(0)" onclick="window.open('<?php echo base_url("admin/DetailTransaksi/".(substr($data->ID_PEMESANAN,1))) ?>','_blank')"><i class="fa fa-search"></i></a>
                                        </td>
<div class="modal fade bs-example-modal-lg" tabindex="-1" id="data_<?php echo $number ?>" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title" id="myLargeModalLabel">Tambah Pengiriman</h4>
                            <p><?php echo '#'.$data->ID_PEMESANAN ?></p>
                        </div>
                        <div class="modal-body">
                            
            <!-- Form  -->
          
            <!-- <form class="form-horizontal"> -->
            <form class="form-horizontal">
                <div class="form-group">
                    <label class="col-md-12">Nomer resi</label>
                    <div class="col-md-12">
                        <input type="text" class="form-control" name="noresi"  minlength="5" maxlength="12" required> </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12">Tanggal kirim</label>
                    <div class="col-md-12">
                       <input type="date" name="tglkirim" class="form-control" min="<?php echo date('Y-m-d'); ?>" max="<?php echo date("Y-m-d", strtotime("+ 7 day")); ?>" required> </div>
                       <input type="hidden" name="id_pemesanan" value="<?= $data->ID_PEMESANAN; ?>" />
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


     
<script type="text/javascript">
$( "form" ).on( "submit", function( e ) {
    e.preventDefault();
    var valid=true;
    //generalisasi form agar data file bisa masuk
    var form = $(this)[0];
    //mengambil semua data di dalam form
    var formData = new FormData(form);
    //mengambil semua data di dalam form
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
                url: "<?php echo base_url('T_Pengiriman/Save');?>",
                type: "POST",
                data: formData,
                dataType: "html",
                contentType: false,
                processData: false,
                //jika ajax sukses
                success: function(id){
                    var id_pemesanan = id.replace("\"", "").replace("\"", "");
                    setTimeout(function(){
                        swal({
                        title:"Data Berhasil Disimpan",
                        text: "Terimakasih",
                        type: "success"
                        }, function(){
                            window.open("<?php echo base_url('T_Pengiriman/print_suratjalan/');?>"+id_pemesanan, '_blank');
                            window.location="<?php echo base_url('admin/Pengiriman');?>";
                        });
                    }, 2000);
                },
                //jika ajax gagal
                error: function (xhr, ajaxOptions, thrownError) {
                    setTimeout(function(){
                        swal("Error", "Nomer resi telah dipakai untuk pengiriman lain, Silahkan ganti nomer resi", "error");
                    }, 2000);
                }
            });
        });
    }
});
</script>