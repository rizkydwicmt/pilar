<!-- Breadcumbs -->
	
	<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Laporan Transaksi</h4> </div>
                    <!-- Breadcumbs  -->
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> 
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url('Admin') ?>"> Beranda </a></li>
                            <li class="active">Laporan Transaksi</li>
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
                                <li role="presentation" class="nav-item" aria-expanded="false"><a href="#bank" class="nav-link active" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs"> Laporan Transaksi</span></a></li>
                                <!-- <li role="presentation" class="nav-item"><a href="#form" class="nav-link" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs">Input Data Bank</span></a></li> -->
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="bank" aria-expanded="true">
                                    <div class="white-box">

                                        <div class="form-horizontal">
                                            <form class="form-horizontal" target="_blank" method="post" action="<?php echo base_url('L_Transaksi/Laporan/') ?>">
                                                
                                            <div class="form-group">
                                                <div class="col-md-4">
                                                    <label for="tgl">Bulan</label>
                                                    <select class="form-control selectpicker" data-live-search="true" name="bulan" id="i_bulan" required>
                                                        <option value="" disabled selected>Pilih Bulan</option>
                                                        <option value="0">Semua Bulan</option>
                                                        <option value="01">Januari</option>
                                                        <option value="02">Februari</option>
                                                        <option value="03">Maret</option>
                                                        <option value="04">April</option>
                                                        <option value="05">Mei</option>
                                                        <option value="06">Juni</option>
                                                        <option value="07">Juli</option>
                                                        <option value="08">Agustus</option>
                                                        <option value="09">September</option>
                                                        <option value="10">Oktober</option>
                                                        <option value="11">November</option>
                                                        <option value="12">Desember</option>
                                                    </select>
                                                 </div>
                                            
                                                <div class="col-md-4">
                                                    <label for="tgl">Tahun</label>
                                                <?php 
                                                $already_selected_value = date('Y');
                                                $earliest_year = 2010;

                                                print '<select name="tahun" class="form-control selectpicker" id="i_tahun" required>';
                                                foreach (range(date('Y'), $earliest_year) as $x) {
                                                    print '<option value="'.$x.'"'.($x === $already_selected_value ? ' selected="selected"' : '').'>'.$x.'</option>';
                                                }
                                                print '</select>';
                                                ?>



                                                </div>
                                                <div class="col-md-4">
                                                    <label> Pilih Transaksi</label>
                                                    <select class="form-control selectpicker" data-live-search="true" name="trans" id="i_trans" required>
                                                        <option value="" disabled selected>Pilih Transaksi</option>
                                                        <option value="Semua">Semua Transaksi</option>
                                                        <option value="Cicilan">Cicilan</option>
                                                        <option value="Kontan">Kontan</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <button class="btn btn-default">Process</button>
                                            </form>
                                            
                                            &nbsp;
                                        </div>

			                        </div>
                                </div>
                                <!-- <div role="tabpanel" class="tab-pane" id="form" aria-expanded="false">      
			                        <div class="white-box">

			                        </div>
                                </div> -->
                               
                            </div>
                        </div>

                    </div>
     
