<!-- Breadcumbs -->
	
	<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Login Users List</h4> </div>
                    <!-- Breadcumbs  -->
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> 
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url('Admin') ?>"> Beranda </a></li>
                            <li class="active">List Data User</li>
                        </ol>
                    </div>
                    <!-- /Breadcumbs  -->
                    <!-- /.col-lg-12 -->
                </div>

<!-- /Breadcumbs -->




                </div> 

<div class="col-lg-12 col-sm-6 col-xs-12">
                        <div class="white-box">
                            <h5 class="title m-b-0"><b align="center"> = Daftarkan Pengguna Aplikasi =</h5></b>
                            <br>
                            <!-- <p class="text-muted m-b-40">Use default tab with class <code>nav-tabs</code></p> -->
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="nav-item" aria-expanded="false"><a id="bank1" href="#bank" class="nav-link active" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs"> Data Users LDS </span></a></li>
                                <li role="presentation"  class="nav-item"><a id="form1" href="#form" class="nav-link" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs"> Register User </span></a></li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="bank" aria-expanded="true">
                                    <div class="white-box">

                                        <div class="alert alert-success" id="alert_success" style="display:none;">
                                            <i class="fa fa-check"></i>
                                            Berhasil Disimpan
                                        </div>

                                        <div class="alert alert-primary" id="alert_edit" style="display:none;">
                                            <i class="fa fa-check"></i>
                                            Berhasil Dirubah
                                        </div>

                                 


                                        <table class="table table-hover" id="table1" >
                                            <thead>
                                                <th>Login Users</th>
                                                <th>Nama Karyawan</th>
                                                <th>Status Active</th>
                                                <th>Pengaturan</th>
                                            </thead>

                                        </table>


			                        </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="form" aria-expanded="false">      
			                        <div class="white-box">
                                        <div class="alert alert-danger" id="alert_fail" style="display:none;">
                                            <i class="fa fa-check"></i>
                                            <p id="fail_text"></p>
                                        </div>
                                        
                                        <h2><p class="text-muted m-b-30 font-13 box-title"> Isilah Formulir Pendaftaran Akses User.</p></h2>
                                        <form id="this_input" class="form-horizontal" method="post">
                                            <div class="form-group">
                                                <label class="col-md-12">User Untuk Login</label>
                                                <div class="col-md-8">
                                                    <input type="text" onchange="checking_user()" id="i_user_login" name="user_login" class="form-control" required> </div>
                                                <div class="col-md-4" id="correct_user" style="display:none">
                                                    <label class="label label-success"><i class="fa fa-check"></i> User Tersedia</label>
                                                </div>
                                                <div class="col-md-4" id="wrong_user" style="display:none">
                                                    <label id="huhu" class="label label-danger"><i class="fa fa-times"></i> User udah dipakai</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-12">Kata Sandi</label>
                                                <div class="col-md-8">
                                                    <input type="password" id="pass1" name="password_real" class="form-control" required> </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-12">Ulangi Kata Sandi</label>
                                                <div class="col-md-8">
                                                    <input onchange="checking_password()" type="password" name="password_real" class="form-control" id="pass2" required> </div>
                                                <div class="col-md-4" id="wrong_password" style="display:none">
                                                    <label class="label label-danger"><i class="fa fa-times"></i> Password Tidak sama</label>
                                                </div>
                                                <div class="col-md-4" id="correct_password" style="display:none">
                                                    <label class="label label-success"><i class="fa fa-check"></i></label>
                                                </div>
                                            </div> 
                                            <input type="hidden" id="i_id_user" name="id_user">

                                            <div class="form-group">
                                                <label class="col-md-6">Login Sebagai (Role) :</label>
                                                <label class="col-md-6">Karyawan :</label>
                                                <div class="col-md-6">
                                                    <select id="i_id_role" class="selectpicker form-control" data-live-search="true" name="id_role">
                                                        <option selected disabled value="0">Pilih Role</option>
                                                        <?php foreach ($role as $v): ?>
                                                            <option value="<?= $v->id_role ?>"><?= $v->nama_role ?></option>
                                                        <?php endforeach ?>
                                                    </select> 
                                                </div>
                                                <div class="col-md-6">
                                                    <select id="i_id_kar" class="selectpicker form-control" data-live-search="true" name="id_karyawan">
                                                        <option selected value="0">Tidak ada Karyawan</option>
                                                        <?php foreach ($kar as $z): ?>
                                                            <?php if($z->karyawan_id == null) : ?>
                                                            <option value="<?= $z->id_karyawan ?>"><?= $z->nama_karyawan ?></option>
                                                            <?php endif ?>
                                                        <?php endforeach ?>
                                                    </select> 
                                                </div>
                                            </div>
                                            
                                            <input type="hidden" id="res_user" value="" name="">
                                            <input type="hidden" id="res_pass" value="" name="">
                                            <input type="hidden" id="name_only" value="">
                                           
                                            
                                            <button id="button_or_edit" type="button" onclick="input_data()" class="btn btn-success">Kirim</button>
                                            <button id="edited" style="display:none;" type="button" onclick="update_data()" class="btn btn-success">Update</button>
                                            <button type="reset" class="btn btn-info">Reset</button>
                                        </form>

			                        </div>
                                </div>
                               
                            </div>
                        </div>

                    </div>

     
<script type="text/javascript">
    $(document).ready(function(){

        load_data_table1();

    });


    function load_data_table1(){
        $('#table1').DataTable({
            destroy: true,
            "processing": true,
            "serverSide": true,
            ajax: {
              url: '<?php echo base_url("S_Control_User/load_data/"); ?>'
            },
            "columns": [
              {"name": "nama_user"},
              {"name": "nama_karyawan"},
              {"name": "status_active","className": "text-center"},
              {"name": "config" , "orderable": false,"searchable": false,"className": "text-center" },
            ],
            "order": [
              [0, 'asc']
            ],
            "iDisplayLength": 10
        });
    }

    function checking_user(edited){
        var value = $("#i_user_login").val();
        if (edited != null) {

            var edit_name   =   $("#name_only").val();

            if (edit_name == value) {

                $("#huhu").html('Notif : User nama tetap sama ');
                $("#wrong_user").fadeIn(200);
                $("#correct_user").hide();
                $("#res_user").val('');

            } else {
                $("#huhu").html('User udah dipakai');       
            }

        } else {
                 $("#huhu").html('User udah dipakai');   
                 $("#huhu").removeClass('label-danger');   
                 $("#huhu").addClass('label-warmning');   
        }


        $.ajax({
            url:    "<?= base_url('S_Control_User/check_available_user/') ?>",
            method: "post",
            dataType : "json",
            data: "user="+value,
            success: function(response){
                if (response.success) {
                    $("#correct_user").fadeIn(200);
                    $("#wrong_user").hide();
                    $("#res_user").val('1');
                } else {
                    $("#wrong_user").fadeIn(200);
                    $("#correct_user").hide();
                    $("#res_user").val('');
                }
            }
        });
    }

    function checking_password(){
        var pass1   =   $("#pass1").val();   
        var pass2   =   $("#pass2").val();

        if (pass1 == pass2) {
            $("#correct_password").fadeIn(200);
            $("#wrong_password").hide();
            $("#res_pass").val('1');
        } else {
            $("#huhu").addClass('label-danger');   
            $("#huhu").removeClass('label-warmning');   
            $("#wrong_password").fadeIn(200);
            $("#correct_password").hide();
            $("#res_pass").val('');
        }

    }

    function input_data(){

        var validate_pass   =   $("#res_pass").val();
        var validate_user   =   $("#res_user").val();
        var form            =   $("#this_input").serialize();

        if (validate_pass == '') {
            alert('Harap membenarkan password anda');
        } else if(validate_user == '') {
            alert('Harap membenarkan user anda');
        } else {

            $.ajax({
                url:    "<?= base_url('S_Control_User/input_new_user/') ?>",
                method: "post",
                dataType : "json",
                data: form,
                success: function(response){
                    if (response.success) {
                        load_data_table1();
                        form_to_list();
                        $('#this_input')[0].reset();
                        $("#alert_success").show().delay(1000).fadeOut(200);
                    } else {
                        $("#fail_text").html('Silahkan memilih Karyawan terlebih dahulu');
                        $("#alert_fail").show().delay(1000).fadeOut(200);
                    }
                }
            });

        }

    }

    function permission_user(id , type){

        $.ajax({
            url:    "<?= base_url('S_Control_User/change_activate/') ?>",
            method: "post",
            dataType : "json",
            data: 'id_user='+id+'&permit='+type,
            success: function(response){
                if (response.success) {
                    load_data_table1();
                    $("#alert_edit").show().delay(1000).fadeOut("fast");
                }     
            }
        });

    }

    function edit_user(id){
        $.ajax({
            url:    "<?= base_url('S_Control_User/edit_user/') ?>"+id,
            method: "post",
            dataType : "json",
            success: function(data){
                list_to_form();
                $("#i_user_login").val(data[0].nama_user);
                $("#name_only").val(data[0].nama_user);
                $("input[type='password']").attr('readonly' , true);
                $("#button_or_edit").attr('onclick' , 'update_data()');
                $("#button_or_edit").html('Update');
                $("#i_id_user").val(id);
                $("#i_user_login").attr('onchange' , 'checking_user("edited")');
                $("#i_id_role").selectpicker('val' , data[0].id_role , 'render');
                blabla(data[0].id_karyawan);
            }
        });
    }

    

    function update_data(){

        var id   =   $("#i_id_user").val();
        var validate_user   =   $("#res_user").val();
        var form            =   $("#this_input").serialize();

            $.ajax({
                url:    "<?= base_url('S_Control_User/update_user/') ?>"+id,
                method: "post",
                dataType : "json",
                data: form,
                success: function(response){
                    if (response.success) {
                        load_data_table1();
                        form_to_list();
                        $('#this_input')[0].reset();
                        $("#alert_success").html('Berhasil di update').show().delay(1000).fadeOut(200);
                        $("input[type='password']").attr('readonly' , true);
                        $("#button_or_edit").attr('onclick' , 'input_data()');
                        $("#button_or_edit").html('Kirim');
                        $("#i_id_user").val('');
                        $("#i_user_login").attr('onchange' , 'checking_user()');
                        // $("#i_id_role").selectpicker('val' , data[0].id_role , 'render');
                    }
                }
            });

        

    }

    function blabla(id_kar){
        $.ajax({
            url:    "<?= base_url('S_Control_User/find_karyawan_edit/') ?>"+id_kar,
            method: "post",
            success: function(response){
                $("#i_id_kar").html(response).selectpicker('refresh');
            }
        });
    }

    function form_to_list(){
        $("#bank").addClass('active');
        $("#bank1").addClass('active');
        $("#form1").removeClass('active');
        $("#form").removeClass('active');

    }

    function list_to_form(){
        $("#form").addClass('active');
        $("#form1").addClass('active');
        $("#bank").removeClass('active');
        $("#bank1").removeClass('active');
    }
</script>