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
	<p align="right">tanggal pembuatan : <?php echo date("Y-m-d H:i:s"); ?></p> 	<table>
 		<thead>
 			<tr class="border_bottom">
	 			<th>Invoice</th>
	 			<th>Tanggal</th>
	 			<th>Pelanggan</th>
				<th>Pembayaran</th>
				<th>Status</th>
	 			<th style="text-align: right;">Ongkir</th>
	 			<th style="text-align: right;">Total</th>
 			</tr>
 		</thead>
 		<tbody>
 			<?php 
 			$ongkir = 0;
 			$nego = 0;
 			$total = 0;
 			foreach ($pemesanan as $data) { ?>
	 			<tr>
	 				<td><?php echo '#'.$data->ID_PEMESANAN; ?></td>
	 				<td><?php echo $data->TGL_PESAN; ?></td>
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
	 			</tr>
 			<?php } ?>
 			<tr class="border_top">
 				<td colspan="5" align="center">TOTAL HARGA</td>
 				<td style="text-align: right;"><?php echo $this->Master->rupiah($ongkir) ?></td>
 				<td style="text-align: right;"><?php echo $this->Master->rupiah($total) ?></td>
 			</tr>
 		</tbody>
 	</table>
</body>
<script type="text/javascript">
 window.print();
 setTimeout(window.close, 0);

</script>
</html>