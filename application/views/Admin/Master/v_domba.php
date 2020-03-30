
<!-- Breadcumbs -->
	
	<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Master Domba</h4> </div>
                    <!-- Breadcumbs  -->
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> 
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url('Admin') ?>"> Beranda </a></li>
                            <li class="active">Data Domba</li>
                        </ol>
                    </div>
                    <!-- /Breadcumbs  -->
                    <!-- /.col-lg-12 -->
                </div>

<!-- /Breadcumbs -->




                </div> 

<div class="col-lg-12 col-sm-6 col-xs-12">
    <div class="white-box">
        <h5 class="title m-b-0"><b align="center"> Domba </h5></b>
        <br>
        <!-- <p class="text-muted m-b-40">Use default tab with class <code>nav-tabs</code></p> -->
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="nav-item" aria-expanded="false"><a href="#bank" class="nav-link active" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs"> Data Domba</span></a></li>
            <li role="presentation" class="nav-item"><a href="#form" class="nav-link" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs">Input Data Domba</span></a></li>
            <li role="presentation" class="nav-item"><a href="#form2" class="nav-link" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs">Input Jenis Domba</span></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="bank" aria-expanded="true">
                <div class="col-sm-12">
                    <div>
                        <h3 class="box-title m-b-0">Data Domba </h3>
                        <!-- <p class="text-muted m-b-30">Data dapat di Export menjadi Berikut ini:</p> -->
                        <div class="table-responsive">
                            <table id="example23" class="display nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Foto Jenis Domba</th>
                                        <th>Jenis</th>
                                    	<th>ID Domba</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Harga</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    <?php 
                                    $number 	=	1;
                                    foreach ($domba as $data) { ?>
                                    <tr>
                                        <td>
                                            <img src="<?php echo base_url('assets/img/product-img/').$this->Master->get_tabel('jenis_domba',array('ID_JENIS' => $data->ID_JENIS),'FOTO');
                                             ?>" class="img-responsive" alt="" style="width: 100px; height: 100px;">
                                        </td>
                                        <td>
                                        	<?php echo $this->Master->get_tabel('jenis_domba',array('ID_JENIS' => $data->ID_JENIS),'JENIS_DOMBA') ?>
                                        </td>
                                    	<td><?php $number++; echo $data->ID_DOMBA; ?> </td>
                                        <td>
                                        	<?php echo $data->JENIS_KELAMIN ?>
                                        </td>
                                        <td>
                                            <?php echo $data->HARGA ?>
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-circle btn-danger" data-toggle="tooltip" data-title="Hapus Stok Domba" href="javascript:void(0)" onclick="window.location.href='<?php echo base_url("Control_Domba/Delete/".$data->ID_DOMBA) ?>'" ><i class="fa fa-chevron-circle-down"></i></a>
                                        	<a class="btn btn-sm btn-circle btn-primary" data-toggle="modal" href="#data_<?php echo $number ?>" ><i data-toggle="tooltip" data-title="Edit" class="fa fa-pencil"></i></a>
                                        </td>
<div class="modal fade bs-example-modal-lg" tabindex="-1" id="data_<?php echo $number ?>" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title" id="myLargeModalLabel">Update Domba</h4> </div>
                        <div class="modal-body">
                            
        	<!-- Form  -->
          
          	<form class="form-horizontal" method="post" enctype="multipart/form-data" accept-charset="utf-8" action='<?php echo base_url('Control_Domba/Update/').$data->ID_DOMBA ?>' id="form1">
                <h3><p><?php echo $this->Master->get_tabel('jenis_domba',array('ID_JENIS' => $data->ID_JENIS),'JENIS_DOMBA').' - '.$data->ID_DOMBA ?></p></h3>
                <hr>
                <div class="form-group">
                    <label>Berat</label>
                    <input type="number" name="berdom" class="form-control" min="1" value="<?php echo($data->BERAT) ?>" required>
                </div>
                <div class="form-group">
                    <label>Harga</label>
                    <input type="number" name="hardom" class="form-control" min="1" value="<?php echo($data->HARGA) ?>" required>
                </div>
                <div class="form-group">
                    <label>Foto</label>
                    <input type="hidden" name="namafile" value="<?php echo $data->FOTO; ?>">
                    <input type="file" name="userfile" size="20" style="font-size: 11px;">
                </div>
					<!-- <input type="submit" value="asd" class="btn btn-default"> -->
							
                        <!-- Form -->
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
                        
                        <h3><p>INFORMASI DOMBA</p></h3>
                        <hr>
                        <form class="form-horizontal" method="post" enctype="multipart/form-data" accept-charset="utf-8" action='<?php echo base_url('Control_Domba/Save') ?>'>
                            <div class="form-group">
                                <label class="col-md-12">Jenis Domba</label>
                                <div class="col-md-12">
                                    <select class="form-control" name="jd" required>
                                    <?php foreach ($jenisdomba as $jd) { ?>
                                        <option value="<?= $jd->ID_JENIS?>"><?= $jd->JENIS_DOMBA?></option>
                                    <?php } ?> 
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Jenis Kelamin</label>
                                <div class="col-md-12">
                                    <select class="form-control" name="jk" required>
                                        <option value="jantan">Jantan</option>
                                        <option value="betina">Betina</option>
                                    </select> 
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Harga ( /Kg )</label>
                                <div class="col-md-12">
                                    <input type="text" name="harbar" class="form-control" min="1" required>
                                </div>
                            </div>

                           



                            
                            <button type="submit" class="btn btn-success">Simpan</button>
                            <button type="reset" class="btn btn-info">Reset</button>
                        </form>
                    </div>
                </div>

            </div>
            
            <div role="tabpanel" class="tab-pane" id="form2" aria-expanded="false">
               
                <div class="col-sm-12">
                    <div class="white-box">
                        
                        <h3><p>Jenis Domba</p></h3>
                        <hr>
                        <form class="form-horizontal" method="post" enctype="multipart/form-data" accept-charset="utf-8" action='<?php echo base_url('Control_Domba/SaveJenis') ?>'>
                                        
                            <div class="form-group">
                                <label class="col-md-12">Nama Jenis</label>
                                <div class="col-md-12">
                                    <input type="text" name="jenis" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Foto</label>
                                <div class="col-md-12">
                                   <input type="file" name="userfile" size="20" style="font-size: 11px;" required> </div>
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
     
