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
            
            <!-- Tab panes -->
            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade 
                fade active in                " id="pemesanan">
                <h3 align="center">Batik Sekar Jati Star</h3><br>
                        <table width="100%">
                            <tr>
                                <td rowspan="2" style="color: #686868;" align="center">
                                    <p style="font-size: 12px;margin-bottom: unset;"> 
                                   Pemesanan dan Penjualan Batik<br>
                                   <br>
                                   Jalan Jatipelem-Diwek No.37 RT.01 RW.01, Jatipelem<br>
                                                         Kecamatan Diwek, Kabupaten Jombang<br>
                                                         0812-3334-1970<br></p>
                                </td>
                                <td align="right" style="color: #686868;">#<?php echo $pemesanan->NO_INVOICE ?></td>
                            </tr>
                            <tr>
                                <td align="right" valign="bottom" style="color: #686868;"><?php echo $pemesanan->TGL_TRANSAKSI ?></td>
                            </tr>
                        </table>

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
                                    <td style="color: #686868;font-size: 14px;"><?php
                                    echo $this->Master->get_tabel('barang',array('ID_BAR' => $det->ID_BAR),'NAMA_BAR');
                                    ?></td>
                                    <td style="color: #686868;font-size: 14px;"><?php
                                    echo $this->Master->get_tabel('ukuran',array('ID_UK' => $det->ID_UK),'UKURAN');
                                    ?></td>
                                    <td style="color: #686868;font-size: 14px;"><?php
                                    echo $this->Master->get_tabel('warna',array('ID_WAR' => $det->ID_WAR),'WARNA');
                                    ?></td>
                                    <td style="text-align: center; color: #686868;font-size: 14px;"><?php echo $det->JUMLAH?></td>
                                    <td style="text-align: right; color: #686868;font-size: 14px;"><?php echo $this->Master->rupiah($det->SUBTOTAL)?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <hr>
                        
                        <table width="100%">
                            <tr>
                                <td style="color: #686868;">Subtotal</td>
                                <td align="right" style="color: #686868;"><?php echo $this->Master->rupiah($pemesanan->TOTAL_HARGA_PESAN-$pemesanan->ONGKIR_PESAN); ?></td>
                            </tr>
                            <tr>
                                <td style="color: #686868;">Ongkos kirim</td>
                                <td align="right" style="color: #686868;">      <?php echo $this->Master->rupiah($pemesanan->ONGKIR_PESAN); ?></td>
                            </tr>
                            </tr>
                            <tr>
                                <td style="color: #686868;">Total harga</td>
                                <td align="right" style="color: #686868;"><?php 
                                    echo $this->Master->rupiah($pemesanan->TOTAL_HARGA_PESAN);
                             ?></td>
                            </tr>
                        </table>


                        <div class="clearfix"></div>



                        

                </div>
                
                            </div>
            <hr>
            
    </div>
 </div>                                            

        <!-- /#page-wrapper -->
    
    <!-- /#wrapper -->
    <!-- jQuery -->
    
    <!-- Bootstrap Core JavaScript -->
    <script src="http://127.0.0.1/penjualanTA/asset/select-bootstrap/dist/js/bootstrap-select.min.js"></script>
    <script src="http://127.0.0.1/penjualanTA/asset/numeral/numeral.js"></script>
    <script src="http://127.0.0.1/penjualanTA/asset/bootstrap/dist/js/tether.min.js"></script>
    <script src="http://127.0.0.1/penjualanTA/asset/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="http://127.0.0.1/penjualanTA/plugins/bower_components/bootstrap-extension/js/bootstrap-extension.min.js"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="http://127.0.0.1/penjualanTA/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
    <!--slimscroll JavaScript -->
    <script src="http://127.0.0.1/penjualanTA/asset/js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="http://127.0.0.1/penjualanTA/asset/js/waves.js"></script>
    <!--Morris JavaScript -->
    <script src="http://127.0.0.1/penjualanTA/plugins/bower_components/raphael/raphael-min.js"></script>
    <script src="http://127.0.0.1/penjualanTA/plugins/bower_components/morrisjs/morris.js"></script>
    <!-- Sparkline chart JavaScript -->
    <script src="http://127.0.0.1/penjualanTA/plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js"></script>
    <!-- jQuery peity -->
    <script src="http://127.0.0.1/penjualanTA/plugins/bower_components/peity/jquery.peity.min.js"></script>
    <script src="http://127.0.0.1/penjualanTA/plugins/bower_components/peity/jquery.peity.init.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="http://127.0.0.1/penjualanTA/asset/js/custom.min.js"></script>
    <script src="http://127.0.0.1/penjualanTA/asset/js/dashboard1.js"></script>
    <!-- DAtatable -->
    <script src="http://127.0.0.1/penjualanTA/plugins/bower_components/datatables/jquery.dataTables.min.js"></script>
    <!-- Mask Data  -->
    <script src="http://127.0.0.1/penjualanTA/asset/js/mask.js"></script>
    <script src="http://127.0.0.1/penjualanTA/asset/js/jquery.PrintArea.js" type="text/JavaScript"></script>
    <!-- Datatable -->
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <!-- Select -->
    <script src="http://127.0.0.1/penjualanTA/asset/bower_components/chosen/chosen.jquery.min.js"></script>
    <!-- Select2 -->
    <script src="http://127.0.0.1/penjualanTA/plugins/select2/select2.full.min.js"></script>
    <!-- Number Format -->
    <script src="http://127.0.0.1/penjualanTA/plugins/numberformat/jquery.number.min.js"></script>
    <script type="text/javascript">
         $(document).ready(function () {
            $('#myTable').DataTable();
            $("#hehe").DataTable();
            $(document).ready(function () {
                var table = $('#example').DataTable({
                    "columnDefs": [
                        {
                            "visible": false
                            , "targets": 2
                        }
          ]
                    , "order": [[2, 'asc']]
                    , "displayLength": 25
                    , "drawCallback": function (settings) {
                        var api = this.api();
                        var rows = api.rows({
                            page: 'current'
                        }).nodes();
                        var last = null;
                        api.column(2, {
                            page: 'current'
                        }).data().each(function (group, i) {
                            if (last !== group) {
                                $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
                                last = group;
                            }
                        });
                    }
                });
                // Order by the grouping
                $('#example tbody').on('click', 'tr.group', function () {
                    var currentOrder = table.order()[0];
                    if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
                        table.order([2, 'desc']).draw();
                    }
                    else {
                        table.order([2, 'asc']).draw();
                    }
                });
            });
        });
        $('#example23').DataTable({
            dom: 'Bfrtip'
            , buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
        });
/* END =============== DATA TABLES */

/* Start Notification Alert*/

        $('#notifications').slideDown('slow').delay(1500).slideUp('slow');
        $('#notificationsz').slideDown('slow').delay(1500).slideUp('slow');
        $('#notif_id').slideDown('fast').delay(2000).slideUp('slow');
        $('#notif_password').slideDown('fast').delay(2000).slideUp('slow');
/* End Norification Alert*/

/* Start Disabling not number key */
    function validate(evt) {
          var theEvent = evt || window.event;
          var key = theEvent.keyCode || theEvent.which;
          key = String.fromCharCode( key );
          var regex = /[0-9]|\./;
          if( !regex.test(key) ) {
            theEvent.returnValue = false;
            if(theEvent.preventDefault) theEvent.preventDefault();
          }
        }
/* End Disabling not number key */

//format money
    $('.money').number( true, 0, ',', '.' );
//Initialize Select2 Elements
    $(".select2").select2();
</script>

    


</body></html>
<script type="text/javascript">
 window.print();
 setTimeout(window.close, 0);

</script>