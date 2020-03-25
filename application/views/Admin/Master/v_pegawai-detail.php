<!-- Breadcumbs -->
	
	<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Master Pegawai</h4> </div>
                    <!-- Breadcumbs  -->
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> 
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url('Admin') ?>"> Beranda </a></li>
                            <li><a href="<?php echo base_url('admin/Pegawai') ?>"> Data Pegawai</a></li>
                            <li class="active">Detail Pegawai</li>
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
            <h3 class="box-title">Detail Pegawai</h3>
            
            <!-- Nav tabs -->
            <ul class="nav customtab nav-tabs" role="tablist">
                <li role="presentation" class="nav-item"><a href="#home1" class="nav-link pull-left active" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs">Data Pegawai</span></a></li>
                <li role="presentation" class="nav-item"><a href="#profile1" class="nav-link pull-right" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs">Data Diri Pegawai</span></a></li>
        
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade active in" id="home1">
                    
                    <?php foreach($pegawai as $data){ ?>
                        <hr>
                        <h3 align="center">Akun Pegawai</h3>
                        <hr>
                        <div class="form-group">
                            <label class="col-md-6">Email</label>
                            <label class="col-md-6">
                             <?php echo $data->EMAIL_PEGAWAI ?>
                            <label></div>

                        <div class="form-group">
                            <label class="col-md-6">Username</label>
                            <label class="col-md-6"><?php echo $data->USERNAME ?></label></div>

                        
                        <div class="form-group">
                            <label class="col-md-6">telepon</label>
                            <label class="col-md-6">
                             <?php echo $data->TELP_PEGAWAI ?>
                            <label></div>

                         
                    <div class="clearfix"></div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="profile1">
                        <hr>
                        <h3 align="center">Data Diri Pegawai</h3>
                        <hr>

                        <div class="form-group">
                            <label class="col-md-6">Nama Pegawai</label>
                            <label class="col-md-6">
                             <?php echo $data->NAMA_PEGAWAI ?>
                            <label></div>

                        <div class="form-group">
                            <label class="col-md-6">Alamat Pegawai</label>
                            <label class="col-md-6">
                             <?php echo $data->ALAMAT_PEGAWAI ?>
                            <label></div>

                        <div class="form-group">
                            <label class="col-md-6">Kodepos</label>
                            <label class="col-md-6">
                            <?php echo $data->KODEPOS_PEGAWAI ?>
                            <label></div>        

                        <div class="form-group">
                            <label class="col-md-6">Provinsi</label>
                            <label class="col-md-6">
                            <?php echo $this->Master->get_tabel('provinsi',array('ID_PROV' => $this->Master->get_tabel('kota',array('ID_KOTA' => $data->ID_KOTA),'ID_PROV')),'NAMA_PROV') ?>
                            <label></div>

                        <div class="form-group">
                            <label class="col-md-6">Kota</label>
                            <label class="col-md-6">
                            <?php echo $this->Master->get_tabel('kota',array('ID_KOTA' => $data->ID_KOTA),'NAMA_KOTA') ?>
                            <label></div>


                    <div class="clearfix"></div>
                    <?php } ?>
                </div>
                
                
            </div>
            <hr>
            <button class="btn btn-primary" onclick="window.location.href='<?php echo base_url('admin/Pegawai')?>'">Kembali</button>
        </div>
    </div>
 </div>