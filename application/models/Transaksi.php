<?php 

	class Transaksi extends CI_model{
        
        function savePemesanan(){
            //jika DP untuk insert sistem bayar
            if($this->input->post('DP')){
                $sistem_bayar = 'Cicilan';
            }else{
                $sistem_bayar = 'Kontan';
            }
    
            //jika dikirim untuk insert status transaksi
            if($this->input->post('KIRIM')){
                $status = 'Menunggu pengiriman';
            }else{
                if($this->input->post('DP')){
                    $status = 'Belum lunas';
                }else{
                    $status = 'Selesai';
                }
            }
    
            //insert data
            $data =	array(
                /* Nama Field    => Isi Data $_Post */
                'ID_PELANGGAN'		=> $this->input->post('pelanggan'),
                'ID_PEGAWAI'		=> $_SESSION['id_user'],
                'ID_KOTA'			=> $this->input->post('kota'),
                'NAMA_PENERIMA'		=> $this->input->post('nama'),
                'TELP_PENERIMA'		=> $this->input->post('telepon'),
                'ALAMAT_PENERIMA'	=> $this->input->post('alamat'),
                'KODEPOS_PENERIMA'	=> $this->input->post('kodepos'),
                'SISTEM_BAYAR'		=> $sistem_bayar,
                'ONGKOS_KIRIM'		=> $this->input->post('ongkir'),
                'TOTAL_BERAT'		=> array_sum($this->input->post('berat')),
                'TOTAL_DISKON'		=> array_sum($this->input->post('diskon')),
                'TOTAL_HARGA'		=> $this->input->post('total'),
                'STATUS_TRANSAKSI'	=> $status,
            );
            $this->Master->save_data('pemesanan' , $data);
        }
    
        function savePembayaran(){
            //lihat id_pemesanan yang baru dibuat
            $pesan = $this->Master->get_table_order_limit_1( 'pemesanan' , 'TGL_PESAN DESC', 1)->result();
            $id_pemesanan = $pesan[0]->ID_PEMESANAN;
    
            $id_pembayaran = str_replace('T', 'B', $id_pemesanan);
    
            //jika DP untuk insert harga bayar
            if ($this->input->post('DP') == 'on') {
                $id_pembayaran = $id_pembayaran."1";
                $harga_bayar = $this->input->post('DPval');
                $status_pembayaran = "Angsuran";
            }else{
                $harga_bayar = $this->input->post('total');
                $status_pembayaran = "Pelunasan";
            }
    
            //jika Transfer untuk insert jenis_pembayaran dan upload bukti
            if ($this->input->post('TF') == 'on') {
                $jenis_bayar = 'Transfer';
                $filename = $_FILES['userfile']['name'];
                $format =  pathinfo($filename, PATHINFO_EXTENSION);
                $foto =  $id_pembayaran.'.'.$format;
                $config['upload_path']          = './upload/pembayaran';
                $config['allowed_types']        = 'jpg|png';
                $config['file_name']            = $id_pembayaran;
                $config['overwrite']            = true;
                $config['max_size']             = 3048;
    
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('userfile')) {
                    $this->upload->data("file_name");
                }
            }else{
                $jenis_bayar = 'Tunai';
                $foto = "";
            }
    
            //insert data
            $data =	array(
                /* Nama Field    => Isi Data $_Post */
                'ID_PEMBAYARAN'		=> $id_pembayaran,
                'ID_PEGAWAI'		=> $_SESSION['id_user'],
                'ID_PEMESANAN'		=> $id_pemesanan,
                'JENIS_BAYAR'		=> $jenis_bayar,
                'TOTAL_PEMBAYARAN'	=> $harga_bayar,
                'NAMA_BANK'     	=> $this->input->post('NamaBANK'),
                'ATAS_NAMA'	        => $this->input->post('AtasNama'),
                'BUKTI_TRANSFER'	=> $foto,
                'STATUS_PEMBAYARAN'	=> $status_pembayaran,
            );
            $this->Master->save_data('pembayaran' , $data);
        }
    
        function saveDetailPemesanan(){
            //lihat id_pemesanan yang baru dibuat
            $pesan = $this->Master->get_table_order_limit_1( 'pemesanan' , 'TGL_PESAN DESC', 1)->result();
            $id_pemesanan = $pesan[0]->ID_PEMESANAN;
    
            for ($i=0; $i < count($this->input->post('domba')); $i++) { 
                //insert detailpemesanan
                $data 	=	array(
                    /* Nama Field    => Isi Data $_Post */
                    'ID_DOMBA'		=> $this->input->post('jk')[$i],
                    'ID_PEMESANAN'	=> $id_pemesanan,
                    'JUMLAH'		=> $this->input->post('jumlah')[$i],
                    'BERAT'			=> $this->input->post('berat')[$i],
                    'DISKON'		=> $this->input->post('diskon')[$i],
                    'SUBTOTAL'		=> $this->input->post('subtotal')[$i],
                ); 
                $this->Master->save_data('detail_pemesanan' , $data);
            }
        }
    }