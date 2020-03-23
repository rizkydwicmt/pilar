
<!-- Breadcumbs -->
	
	<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Master Pelanggan</h4> </div>
                    <!-- Breadcumbs  -->
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> 
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url('Admin') ?>"> Beranda </a></li>
                            <li class="active">Data Pelanggan</li>
                        </ol>
                    </div>
                    <!-- /Breadcumbs  -->
                    <!-- /.col-lg-12 -->
                </div>

<!-- /Breadcumbs -->




                </div> 

<div class="col-lg-12 col-sm-6 col-xs-12">
    <div class="white-box">
        <h5 class="title m-b-0"><b align="center"> Pelanggan </h5></b>
        <br>
        <!-- <p class="text-muted m-b-40">Use default tab with class <code>nav-tabs</code></p> -->
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="nav-item" aria-expanded="false"><a href="#bank" class="nav-link active" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs"> Data Pelanggan</span></a></li>
            <li role="presentation" class="nav-item"><a href="#form" class="nav-link" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs">Input Data Pelanggan</span></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="bank" aria-expanded="true">
                <div class="col-sm-12">
                    <div>
                        <h3 class="box-title m-b-0">Data Pelanggan </h3>
                        <!-- <p class="text-muted m-b-30">Data dapat di Export menjadi Berikut ini:</p> -->
                        <div class="table-responsive">
                            <table id="example23" class="display nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Kota</th>
                                        <th>Nama</th>
                                        <th>Telepon</th>
                                        <th>Alamat</th>
                                        <th>kodepos</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    <?php 
                                    $number 	=	1;
                                    foreach ($pelanggan as $data) { 
                                        $number++;    
                                    ?>
                                    <tr>
                                        <td><?= $this->Master->get_tabel('kota',array('ID_KOTA' => $data->ID_KOTA),'NAMA_KOTA') ?></td>
                                        <td>
                                        	<?php echo $data->NAMA_PELANGGAN ?>
                                        </td>
                                        <td><?php echo $data->TELP_PELANGGAN ?></td>
                                        <td><?php echo $data->ALAMAT_PELANGGAN ?></td>
                                        <td><?php echo $data->KODEPOS_PELANGGAN ?></td>
                                        <td>	
                                        	<a class="btn btn-sm btn-circle btn-danger" data-toggle="tooltip" data-title="Hapus" href="javascript:void(0)" onclick="window.location.href='<?php echo base_url("Control_Pelanggan/Delete/".$data->ID_PELANGGAN) ?>'" ><i class="fa fa-trash"></i></a>
                                        	<a class="btn btn-sm btn-circle btn-primary" data-toggle="modal" href="#data_<?php echo $number ?>" ><i data-toggle="tooltip" data-title="Edit" class="fa fa-pencil"></i></a>
                                        	<a class="btn btn-sm btn-circle btn-warning" data-toggle="tooltip" data-title="Detail Pelanggan" href="javascript:void(0)" onclick="window.location.href='<?php echo base_url("admin/DetailPelanggan/".($number-1)) ?>'"><i class="fa fa-search"></i></a>
                                        </td>
<div class="modal fade bs-example-modal-lg" tabindex="-1" id="data_<?php echo $number ?>" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title" id="myLargeModalLabel">Update Pelanggan</h4> </div>
                        <div class="modal-body">
                            
        	<!-- Form  -->
          
          	<form class="form-horizontal" method="post" action='<?php echo base_url('Control_Pelanggan/Update/').$data->ID_PELANGGAN ?>' id="form1">

                <h3><p>INFORMASI DATA PELANGGAN</p></h3>
                <hr>
                <div class="form-group">
                    <label>Nama</label>
                    <div>
                        <input type="text" class="form-control" name="namacus"  minlength="5" maxlength="30" value="<?php echo($data->NAMA_PELANGGAN) ?>" required> </div>
                </div>
                <div class="form-group">
                    <label for="example-email">Alamat</label>
                    <div>
                       <input type="text" name="alamatcus" class="form-control"  minlength="5" maxlength="50" value="<?php echo($data->ALAMAT_PELANGGAN) ?>" required> </div>
                </div>

                <div class="form-group">
                <label for="provinsi">provinsi</label>
                <select class="form-control" name="provinsi" id="provinsi<?php echo $number?>" required>
                    <?php
                    foreach ($provinsi as $prov) {
                        ?>
                        <option <?php echo $this->Master->get_tabel('kota',array('ID_KOTA' => $data->ID_KOTA),'ID_PROV') == $prov->ID_PROV ? 'selected="selected"' : '' ?> 
                            value="<?php echo $prov->ID_PROV ?>"><?php echo $prov->NAMA_PROV ?></option>
                        <?php
                    }
                    ?>
                </select>
                </div>

                <div class="form-group">
                <label for="kota">kota</label>
                <select class="form-control" name="kota" id="kota<?php echo $number?>" required>
                    <?php
                    foreach ($kota as $kot) {
                        ?>
                        <option <?php echo $this->Master->get_tabel('kota',array('ID_KOTA' => $data->ID_KOTA),'ID_KOTA') == $kot->ID_KOTA ? 'selected="selected"' : '' ?> 
                            class="<?php echo $kot->ID_PROV ?>" value="<?php echo $kot->ID_KOTA ?>"><?php echo $kot->NAMA_KOTA ?></option>
                        <?php
                    }
                    ?>
                </select>
                </div>
               
                <div class="form-group">
                    <label>Telepon</label>
                    <div>
                        <input type="text" class="form-control" name="teleponcus" onkeypress='validate(event)' data-mask='999-999-999-999' value="<?php echo($data->TELP_PELANGGAN) ?>" required> </div>
                </div>
                <div class="form-group">
                    <label>Kodepos</label>
                    <div>
                        <input type="text" pattern="[0-9]*" inputmode="numeric" name="kodeposcus" class="form-control" min="5" max="5" onkeypress='validate(event)' data-mask='99999' value="<?php echo($data->KODEPOS_PELANGGAN) ?>" required> </div>
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

           
                                	

            <div role="tabpanel" class="tab-pane" id="form" aria-expanded="false">
               
               <div class="col-sm-12">
                   <div class="white-box">
                       
                            <h3><p>INFORMASI DATA PEGAWAI</p></h3>
                            <hr>

                            <form class="form-horizontal" method="post" action='<?php echo base_url('Control_Pelanggan/Save') ?>'>
                            <div class="form-group">
                                <label class="col-md-12">Nama</label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="namapel"  minlength="5" maxlength="30" required> </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12" for="example-email">Alamat</label>
                                <div class="col-md-12">
                                    <input type="text" name="alamatpel" class="form-control"  minlength="5" maxlength="50"  required> </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-12" for="provinsi">provinsi</label>
                                <div class="col-md-12">
                                    <select class="form-control" name="provinsi" id="provinsi" required>
                                        <?php
                                        foreach ($provinsi as $prov) {
                                            ?>
                                            <option <?php echo $provinsi_selected == $prov->ID_PROV ? 'selected="selected"' : '' ?> 
                                                value="<?php echo $prov->ID_PROV ?>"><?php echo $prov->NAMA_PROV ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-12" for="kota">kota</label>
                                <div class="col-md-12">
                                    <select class="form-control" name="kota" id="kota" required>
                                        <?php
                                        foreach ($kota as $kot) {
                                            ?>
                                            <option <?php echo $kota_selected == $kot->ID_PROV ? 'selected="selected"' : '' ?> 
                                                class="<?php echo $kot->ID_PROV ?>" value="<?php echo $kot->ID_KOTA ?>"><?php echo $kot->NAMA_KOTA ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-md-12">Telepon</label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="teleponpel" onkeypress='validate(event)' data-mask='999-999-999-999' required> </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Kodepos</label>
                                <div class="col-md-12">
                                    <input type="text" pattern="[0-9]*" inputmode="numeric" name="kodepospel" class="form-control" min="5" max="5" onkeypress='validate(event)' data-mask='99999' required> </div>
                            </div>



                           
                           <button type="submit" class="btn btn-success">Simpan</button>
                           <button type="reset" class="btn btn-info">Reset</button>
                       </form>
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
     
