<!-- Breadcumbs -->
	
	<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 coal-sm-4 col-xs-12">
                        <h4 class="page-title">Kontrol Hak Akses</h4> </div>
                    <!-- Breadcumbs  -->
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> 
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url('Admin') ?>"> Beranda </a></li>
                            <li class="active">Hak Akses</li>
                        </ol>
                    </div>
                    <!-- /Breadcumbs  -->
                    <!-- /.col-lg-12 -->
                </div>

<!-- /Breadcumbs -->




                </div> 

<div class="col-lg-12 col-sm-6 col-xs-12">
                        <div class="white-box">
                            <h5 class="title m-b-0"><b align="center"> = Pengaturan Hak Akses =</h5></b>
                            <br>
                            <!-- <p class="text-muted m-b-40">Use default tab with class <code>nav-tabs</code></p> -->
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li style="display:none" role="presentation" class="nav-item" aria-expanded="false"><a id="bank1" href="#bank" class="nav-link active" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs"> List Data Role </span></a></li>
                                <li style="display:none" role="presentation" class="nav-item"><a id="form1" href="#form" class="nav-link" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs">Setting Acces Role</span></a></li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="bank" aria-expanded="true">
                                    <div class="white-box">
                                        <hr>

                                        <h2> Data Role Hak Akses</h2>
                                        
                                        <hr>
                                        <div style="display:none;" id="notif_sukses">
                                            <label class="alert alert-success"> Berhasil di rubah</label>
                                        </div>
                                        <table class="table table-bordered" id="tbl1">
                                            <thead>
                                                <th width="3%">No</th>
                                                <th>Role Name</th>
                                                <th width="50%">Config Acces</th>
                                            </thead>
                                            <tbody>
                                                <?php $no   =   1; ?>
                                                <?php foreach ($list_role as $v): ?>
                                                    <tr>
                                                        <td><?= $no++ ;?></td>
                                                        <td><?= $v->nama_role ?></td>
                                                        <td>
    <button onclick="change_acces_list(<?= $v->id_role ?> , '<?= $v->nama_role ?>' )" type="button" class="btn btn-success btn-sm"><i class="fa fa-cogs"></i> Edit Access</button>&nbsp;
                                                            <button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus Role ini</button>
                                                        </td>
                                                    </tr>
                                                <?php endforeach ?>
                                            </tbody>
                                        </table>
                                        <button data-toggle="modal" data-target=".bs-example-modal-lg"  class="btn btn-sm col-md-3 btn-success btn-block"><i class="fa fa-plus"></i> Buat Hak Akses Baru</button>

			                        </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="form" aria-expanded="false">      
			                        <div class="white-box row">
                                        <input type="hidden" id="i_id_role">

                                        <div class="col-md-5" style="height:400px;width:60%;overflow-x: auto;">
                                        <table class="table table-bordered table-hover" id="tbl_role">
                                            <thead>
                                                <th>Menu Name</th>
                                                <th>R (Baca Data)</th>
                                                <th>C (Bikin Data)</th>
                                                <th>U (Update Data)</th>
                                                <th>D (Hapus Data)</th>
                                            </thead>
                                            
                                            <tbody id="access_change">
                                               
                                            </tbody>

                                        </table>
                                        </div>

                                        <div class="col-md-2">
                                            
                                        </div>
                                        <div class="col-md-4">
                                            
                                            <div class="form-horizontal">

                                                <div class="form-group">
                                                    <small> Nama Role berikut </small>
                                                    <input readonly="" type="name" name="" id="i_nama_role" class="form-control">
                                                </div>

                                                <div class='form-group'>
                                                     <button type="button" onclick="reset_all()"class="btn btn-danger waves-effect text-left" >Reset</button>
                                                     <button type="button" onclick="centang_all()" class="btn btn-primary waves-effect text-left">Centang Semua</button>
                                                     <button type="button" onclick="sudah_disimpan()" class="btn btn-success waves-effect text-left">Simpan</button>
                                                     <!-- <button type="submit" class="btn btn-success waves-effect text-left"></button> -->
                                                </div>

                                                
                                           
                                            </div>

                                        </div>

			                        </div>
                                </div>
                               
                            </div>
                        </div>

                    </div>
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myLargeModalLabel">New Role</h4> </div>
                <div class="modal-body">
                    <form method="post" action="<?= base_url('S_Access/new_role/') ?>">
                        <label>Nama Role Baru</label>
                        <input class="form-control" type="text" name="new_role" value="" placeholder="ex : Admin / Superadmin / Pegawai / Sekertaris dll.">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success waves-effect text-left">Simpan</button>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
     <script type="text/javascript">
         $(document).ready(function(){
            $("#tbl1").DataTable();

         });

         function sudah_disimpan(){
            form_to_list();
            $("#notif_sukses").show(100).delay(1200).fadeOut(400);
         }

         function centang_all(){

            var id_role     =   $('#i_id_role').val();

             $.ajax({
                url: '<?= base_url("S_Access/allow_all_permit") ?>',
                dataType : 'json',
                method: 'post',
                data : 'id_role='+id_role,
                success: function(response){
                    if (response.success) {
                        // $("input[type='checkbox']").prop('checked' , false);
                        $("input[type='checkbox']").prop('checked' , true);
                    } else {
                        alert('something went wrong');
                        window.location.href="<?= base_url('AccesControlList') ?>";
                    }
                }

            });

         }

         function reset_all(){

            var id_role     =   $('#i_id_role').val();
            
            $.ajax({
                url: '<?= base_url("S_Access/reset_all_permit") ?>',
                dataType : 'json',
                method: 'post',
                data : 'id_role='+id_role,
                success: function(response){
                    if (response.success) {
                        $("input[type='checkbox']").prop('checked' , false);
                    } else {
                        alert('something went wrong');
                        window.location.href="<?= base_url('AccesControlList') ?>";
                    }
                }

            });


            
         }

         function change_acces_list(id,name){


            $("#i_nama_role").val(name);
            $("#i_id_role").val(id);
            list_to_form();

            $.ajax({
                url: '<?= base_url('S_Access/find_the_menu_based_role/') ?>'+id,
                method: 'post', 
                dataType: 'json',
                success : function(data){
                    var i ;
                    var html = '';
                    for (i = 0 ; i < data.length ; i++) {
                        

                        if (data[i].control_read == 1) {
                            var read    = '<input name="'+data[i].role_access_id+'" type="checkbox" value="r" checked class="form_control" onchange="ganti_status(this.name ,this.value)">';
                        } else {
                            var read    = '<input name="'+data[i].role_access_id+'" type="checkbox" value="r" class="form_control" onchange="ganti_status(this.name , this.value)">';
                        }

                        if (data[i].control_create == 1) {
                            var create    = '<input checked name="'+data[i].role_access_id+'" value="c" type="checkbox" value="1" checked class="form_control" onchange="ganti_status(this.name, this.value)">';
                        } else {
                            var create    = '<input name="'+data[i].role_access_id+'" value="c" type="checkbox" value="1" class="form_control" onchange="ganti_status(this.name , this.value)">';
                        }

                        if (data[i].control_update == 1) {
                            var update    = '<input name="'+data[i].role_access_id+'" value="u" type="checkbox" value="1" checked class="form_control" onchange="ganti_status(this.name  , this.value)">';
                        } else {
                            var update    = '<input name="'+data[i].role_access_id+'" value="u" type="checkbox" value="1" class="form_control" onchange="ganti_status(this.name ,this.value)">';
                        }

                        if (data[i].control_delete == 1) {
                            var deleted    = '<input name="'+data[i].role_access_id+'" value="d" type="checkbox" value="1" checked class="form_control" onchange="ganti_status(this.name  ,this.value)">';
                        } else {
                            var deleted    = '<input name="'+data[i].role_access_id+'" value="d" type="checkbox" value="1" class="form_control" onchange="ganti_status(this.name , this.value)">';
                        }

                        if (data[i].is_parent == 0) {
                            var style = 'text-right';
                        } else {
                            var style   = 'font-weight-bold';
                            var create  = ' - ';
                            var update  = ' - ';
                            var deleted = ' - ';
                        }

                        if (data[i].role_access_id > 22 && data[i].role_access_id < 33 || data[i].role_access_id == 19) {
                            var create =' - ';
                            var update = ' - ';
                            var deleted = ' - ';
                        }

                        if (data[i].role_access_id == 20) {
                            // var create =' - ';
                            var update = ' - ';
                            var deleted = ' - ';
                        }
                        html +=
                        '<tr>'+
                            '<td class="'+style+'">'+data[i].menu_name+'</td>'+
                            '<td>'+read+'</td>'+
                            '<td>'+create+'</td>'+
                            '<td>'+update+'</td>'+
                            '<td>'+deleted+'</td>'+
                        '</tr>';
                }
                    $("#access_change").html(html);
                }
            });

         }

         function ganti_status(id  , type){
            if (type == "r") {
        
                if ( $("input[name="+id+"][value="+type+"]").prop('checked') == true ) {
                  var val = '1';
                } else if ( $("input[name="+id+"][value="+type+"]").prop('checked') == false ) {
                  var val = '0';
                }
                    
 
            } else if(type == "c") {

                if ( $("input[name="+id+"][value="+type+"]").prop('checked') == true ) {
                    var val = '1';
                } else if ( $("input[name="+id+"][value="+type+"]").prop('checked') == false ) {
                    var val = '0';
                     
                }

            } else if(type == "u") {

                if ( $("input[name="+id+"][value="+type+"]").prop('checked') == true ) {
                    var val    =   '1';
                } else if ( $("input[name="+id+"][value="+type+"]").prop('checked') == false ) {
                    var val    =   '0';
                    
                }

            } else if(type == "d") {

               if ( $("input[name="+id+"][value="+type+"]").prop('checked') == true ) {
                    var val     =   '1';
               } else if ( $("input[name="+id+"][value="+type+"]").prop('checked') == false ) {
                    var val     =   '0';
                    
               }

            }

            $.ajax({
                url: "<?= base_url('S_Access/change_status/') ?>"+id,
                dataType:"json",
                method : "post",
                data : "type="+type+"&val="+val,
                success : function(response){
                    // alert('berhasil dirubah');
                }

            })


         }

         function list_to_form(){
            $("#form").addClass('active');
            $("#bank").removeClass('active');
            $("#form1").addClass('active');
            $("#bank1").removeClass('active');
         }
         function form_to_list(){
            $("#form").removeClass('active');
            $("#bank").addClass('active');
            $("#form1").removeClass('active');
            $("#bank1").addClass('active');
         }
     </script>
