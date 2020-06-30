<!DOCTYPE html>
<html>
<head>
	
<style type="text/css">
	tr.border_bottom th {
  		border-bottom:1pt solid black;
	}

	tr.border_top td {
  		border-top:1pt solid black;
	}
  tr td {
    padding: 10px 10px 10px 10px ;
  }
</style>
</head>
<body>
	<h4 align="center"><?php echo strtoupper($name); ?></h4><br><br>
	<p align="right">tanggal pembuatan : <?php echo date("Y-m-d H:i:s"); ?></p> 	
	<table border="1">
 		<thead>
 			<tr class="border_bottom">
	 			<th>Invoice</th>
	 			<th>Tanggal</th>
	 			<th>Pelanggan</th>
				<th>Pembayaran</th>
				<th>Status</th>
	 			<th style="text-align: right;">Ongkir</th>
	 			<th style="text-align: right;">Total Harga</th>
				 <th style="text-align: right;">Total Pendapatan</th>
 			</tr>
 		</thead>
 		<tbody>
 			<?php 
 			$ongkir = 0;
 			$nego = 0;
			$total = 0;
			$total_pendapatan = 0; 
 			foreach ($pemesanan as $data) { ?>
	 			<tr>
	 				<td><?php echo '#'.$data->ID_PEMESANAN; ?></td>
					<td><?php 
						$mydate = strtotime($data->TGL_PESAN);
						echo date('j M Y', $mydate);
					?></td>
	 				<td><?php 
	 					echo $this->Master->get_tabel('pelanggan',array('ID_PELANGGAN' => $data->ID_PELANGGAN),'NAMA_PELANGGAN');
	 				?></td>
					<td><?= $data->SISTEM_BAYAR ?></td>
					<td><?= $data->STATUS_TRANSAKSI ?></td>
	 				<td style="text-align: right;"><?php 
	 					$ongkir = $ongkir+$data->ONGKOS_KIRIM;
	 					echo  $this->Master->rupiah($data->ONGKOS_KIRIM); 
	 				?></td>
					 <td style="text-align: right;">
						 <?php 
							echo $this->Master->rupiah($data->TOTAL_HARGA);
							 $total = $total+$data->TOTAL_HARGA;
                         ?>
	 				</td>
	 				<td style="text-align: right;">
						 <?php 
						 	if($data->STATUS_TRANSAKSI == "Dibatalkan"){
						 		if($data->SISTEM_BAYAR == "Cicilan"){
									$totalharga = 0;
									echo $this->Master->rupiah($totalharga);
								}else{
									$totalharga = $data->TOTAL_HARGA/2;
									echo $this->Master->rupiah($totalharga);
								}
							 }else{
								$totalharga = $data->TOTAL_HARGA;
								echo $this->Master->rupiah($totalharga);
							 }
							 $total_pendapatan = $total_pendapatan+$totalharga;
                         ?>
	 				</td>
	 			</tr>
 			<?php } ?>
 			<tr class="border_top">
 				<td colspan="5" align="center">TOTAL</td>
 				<td style="text-align: right;"><?php echo $this->Master->rupiah($ongkir) ?></td>
 				<td style="text-align: right;"><?php echo $this->Master->rupiah($total) ?></td>
				<td style="text-align: right;"><?php echo $this->Master->rupiah($total_pendapatan) ?></td>
 			</tr>
 		</tbody>
 	</table>
</body>
<script type="text/javascript">
  window.print();
  setTimeout(window.close, 0);

</script>
</html>