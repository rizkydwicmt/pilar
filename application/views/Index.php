<style>
.mySlides {display:none;}
</style>

<body class="" style="">

    <div id="wrapper">

        <!-- ****** Header Area Start ****** -->
        
        <!-- ****** Header Area End ****** -->
        <section class="shop_grid_area section_padding_100">
            <div class="container">
                <div class="row">
                    

                    <div class="col-12 col-md-8 col-lg-9">
                        <div class="shop_grid_product_area">
                            <div class="row" style="margin-left: 150px; margin-right: ">
                                <?php 
                                $num = 0;
                                foreach ($jenis_domba as $data) { 
                                    $num++;
                                ?>
                                <!-- Single gallery Item -->
                                <div class="col-12 col-sm-6 col-lg-4 single_gallery_item wow fadeInUpBig" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUpBig;">
                                    <!-- Product Image -->
                                    <div class="product-img">
                                        <img src="<?php 
                                        
                                        echo base_url("assets/img/product-img/".$this->Master->get_tabel('domba',array('ID_JENIS' => $data->ID_JENIS),'FOTO')) ?>" alt="" style="width: 550px; height: 300px;">
                                        <div class="product-quicview">
                                            <a href="#" data-toggle="modal" data-target="#quickview<?php echo $num ?>"><i class="ti-plus"></i></a>
                                        </div>
                                    </div>
                                    <!-- Product Description -->
                                    <div class="product-description">
                                        <p class="product-price"><i><?php
                                         $query_harga = "SELECT min(HARGA) as minimal_harga, max(HARGA) as maksimal_harga FROM `domba` where ID_JENIS = '$data->ID_JENIS'";
                                         $harga = $this->db->query($query_harga)->result();
                                         echo $this->Master->rupiah($harga[0]->minimal_harga).' - '.$this->Master->rupiah($harga[0]->maksimal_harga);
                                         ?></i></p>
                                        <p><b><?php echo $data->JENIS_DOMBA; ?></b></p>
                                        <!-- Add to Cart -->
                                        <a href="#" class="add-to-cart-btn" data-toggle="modal" data-target="#quickview<?php echo $num ?>" onclick="showDivs(1,<?php echo $num ?>);"><button>LIHAT DETAIL</button></a>
                                    </div>
                                </div>

        <!-- ****** Quick View Modal Area Start ****** -->
        <div class="modal fade" id="quickview<?php echo $num ?>" tabindex="-1" role="dialog" aria-labelledby="quickview" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                     
                    <div class="modal-body">
                        <div class="quickview_body">
                            <div class="container">
                                <div class="row">
                                    
                                    <div class="col-12 col-lg-5">
                                    <div class="w3-content w3-display-container">
                                        <?php 
                                            $where = array('ID_JENIS' => $data->ID_JENIS);
                                            $domba = $this->Master->get_orderby_desc('domba',$where)->result();
                                            foreach ($domba as $foto_domba) {
                                        ?>
                                            <img class="mySlides<?= $num ?>" src="<?php echo base_url("assets/img/product-img/".$foto_domba->FOTO) ?>" style="width:100%">
                                        <?php 
                                            
                                            }
                                        ?>

                                        <button class="w3-button w3-black w3-display-left" onclick="plusDivs(-1,<?= $num ?>)">&#10094;</button>
                                        <button class="w3-button w3-black w3-display-right" onclick="plusDivs(1,<?= $num ?>)">&#10095;</button>
                                    </div>
                                    </div>    

                                    <div class="col-12 col-lg-7">
                                        <div class="quickview_pro_des">
                                            <h4 class="title"><b><?php echo $data->JENIS_DOMBA; ?></b></h4>
                                            <h5 class="price"><i id='harga'><?php
                                                $query_hargadomba = "SELECT harga FROM `domba` where ID_JENIS = '$data->ID_JENIS' and JENIS_KELAMIN = 'jantan'";
                                                $hargadomba = $this->db->query($query_hargadomba)->result();
                                                echo $this->Master->rupiah($hargadomba[0]->harga);
                                            ?></i></h5>
                                        </div>
                                        <h4  class="widget-title">Jenis Kelamin</h4>
                                        <select class="form-control-lg" name="jk" id="jk" onClick="select_jk('<?=$data->ID_JENIS?>')">
                                                <option value="jantan" >Jantan</option>
                                                <option value="betina" >Betina</option>
                                        </select>
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
        <!-- ****** Quick View Modal Area End ****** -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
<script src="assets/js/jquery/jquery-2.2.4.min.js"></script>
<script type="text/javascript">
    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix){
        var number_string = angka.toString().replace(/[^,\d]/g, ''),
        split   		= number_string.split(','),
        sisa     		= split[0].length % 3,
        rupiah     		= split[0].substr(0, sisa),
        ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if(ribuan){
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp ' + rupiah : '') + ',00';
    }
</script>

<script>
var slideIndex = 1;

function plusDivs(n,id) {
  showDivs(slideIndex += n,id);
}

function showDivs(n,id) {
  var i;
  var x = document.getElementsByClassName("mySlides"+id);
  if (n > x.length) {slideIndex = 1}
  if (n < 1) {slideIndex = x.length}
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  x[slideIndex-1].style.display = "block";  
}

function select_jk(id_jenis){
        var jk = $("#jk").val();
        $.ajax({
            url : "<?php echo base_url('P_Home/select_jk/');?>",
            method : "POST",
            data: {id: id_jenis, jk: jk},
            async : false,
            dataType : 'json',
            success: function(data){
                var html = formatRupiah(data[0].harga, 'Rp ');
                $('#harga').html(html);
                console.log(html);
            }
        });
    }
</script>
</body>