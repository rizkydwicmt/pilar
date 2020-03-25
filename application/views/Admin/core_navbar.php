<div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse slimscrollsidebar">
                <ul class="nav" id="side-menu">
                    <li class="sidebar-search hidden-sm hidden-md hidden-lg">
                        input-group 
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Search..."> <span class="input-group-btn">
            <button class="btn btn-default" type="button"> <i class="fa fa-search"></i> </button>
            </span> </div>
                        /input-group 
                    </li>
                    <li class="user-pro">
                        <a href="#" class="waves-effect"><img src="<?php echo base_url('/') ?>plugins/images/users/d1.jpg" alt="user-img" class="img-circle"> <span class="hide-menu"><?php echo $this->Master->get_tabel('jabatan',array('ID_JABATAN' => $_SESSION['id_role']),'NAMA_JABATAN').'<br><br>'.$_SESSION['nama_user']; ?><span class="fa arrow"></span></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li><a href="javascript:void(0)" onclick="window.location.href='<?php echo base_url('Login/do_logout') ?>'"><i class="fa fa-power-off"></i> Logout</a></li>
                        </ul>
                    </li>
                    <li class="nav-small-cap m-t-10">--- Main Menu</li>
                    <li> 
                        <a  href="#" onclick="window.location.href='<?php echo base_url('admin/Beranda')?>'" class="waves-effect">
                            <i class="ti-dashboard p-r-10"></i> <span class="hide-menu">Dashboard</span>
                        </a>
                    </li>
                    
                    <li> 
                        <?php //if($_SESSION['id_role'] =='JB001' or $_SESSION['id_role'] =='JB002'){ ?>
                        <a href="javascript:void(0);" class="waves-effect"><i class="ti-calendar p-r-10"></i> <span class="hide-menu"> Master Data <span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level collapse">
                            <?php //if($_SESSION['id_role'] =='JB001'){ ?>
                            <li> <a href="<?= base_url('admin/Pegawai') ?>"><i class="fa fa-users" aria-hidden="true"></i> Data Pegawai</a></li>
                            <li> <a href="<?= base_url('admin/Pelanggan') ?>"><i class="fa fa-users" aria-hidden="true"></i> Data Pelanggan </a></li>
                            <?php //}?>
                            <li> <a href="<?= base_url('admin/Domba') ?>"><i class="fa fa-suitcase" aria-hidden="true"></i> Data Domba </a></li>
                            <!-- Fitur gakepake
                            <li> <a href="<?= base_url('admin/Ukuran') ?>"><i class="fa fa-suitcase" aria-hidden="true"></i> Data Ukuran </a></li>
                            <li> <a href="<?= base_url('admin/Warna') ?>"><i class="fa fa-suitcase" aria-hidden="true"></i> Data Kain </a></li>
                            <li> <a href="<?= base_url('admin/DetBarang') ?>"><i class="fa fa-suitcase" aria-hidden="true"></i> Data Detail Barang </a>
                            -->
                        </ul>
                        <?php //}?></li>
                    </li>
                    
                    
                    <li class="nav-small-cap m-t-10">--- Transaksi</li>
                    
                    <li> <a href="javascript:void(0);" class="waves-effect"><i class="ti-shopping-cart p-r-10"></i> <span class="hide-menu">Transaksi<span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="<?= base_url('admin/Transaksi') ?>"><i class="fa fa-tags"></i> Informasi Transaksi </a></li>
                            <?php //if($_SESSION['id_role'] =='JB002'){ ?>
                            <li><a href="<?= base_url('admin/addTransaksi') ?>"><i class="fa fa-tags"></i> Tambah Transaksi </a></li>
                            <li><a href="<?= base_url('admin/Pembayaran')?>"><i class="fa fa-tags"></i> Pembayaran </a></li>
                            <?php //}?>
                            <?php //if($_SESSION['id_role'] =='JB002'){ ?>
                            <li><a href="<?= base_url('admin/Pengiriman') ?>"><i class="fa fa-tags"></i> Pengiriman </a></li>
                            <?php //}?>
                            
                       </ul>
                    </li>
                    <?php //if($_SESSION['id_role'] =='JB001'){ ?>
                    <li> <a href="javascript:void(0);" class="waves-effect"><i class="ti-pencil-alt p-r-10"></i> <span class="hide-menu">Laporan<span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level collapse">
                           <li><a href="<?= base_url('admin/LapTransaksi') ?>"><i class="fa fa-file-text"></i> Laporan Transaksi </a></li>
                           
                       </ul>
                    </li>
                    <?php //}?>
                    
                </ul>
            </div>
        </div> 

        