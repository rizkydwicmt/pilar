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
	 			<th>Nota</th>
				<th>Resi</th>
	 			<th>Penerima</th>
				<th>Alamat Pengiriman</th>
	 			<th>Tanggal Kirim</th>
				<th>Status Kirim</th>
 			</tr>
 		</thead>
 		<tbody>
 			<?php 
 			$ongkir = 0;
 			$nego = 0;
 			$total = 0;
 			foreach ($transaksi as $data) { ?>
	 			<tr>
	 				<td><?php echo $data->ID_PEMBAYARAN; ?></td>
				 	<td><?php echo $data->NO_RESI ?></td>
	 				<td><?php echo $data->NAMA_PENERIMA; ?></td>
					<td><?php echo $data->ALAMAT_PENERIMA; ?></td>
					<td><?php echo $data->TGL_PENGIRIMAN ?></td>
					<td><?php echo $data->STATUS_TRANSAKSI; ?></td>
	 				
	 			</tr>
 			<?php } ?>
 		</tbody>
 	</table>
</body>
<script type="text/javascript">
//  window.print();
//  setTimeout(window.close, 0);

</script>
</html>