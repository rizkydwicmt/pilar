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
	 			<th>invoice</th>
	 			<th>Tanggal</th>
	 			<th>Pelanggan</th>
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
	 				<td><?php echo '#'.$data->NO_INVOICE; ?></td>
	 				<td><?php echo $data->TGL_TRANSAKSI; ?></td>
	 				<td><?php 
	 					if ($data->ID_CUS != 'C00001') {
	 						echo $this->Master->get_tabel('customer',array('ID_CUS' => $data->ID_CUS),'NAMA_CUS');
	 					}else{
	 						echo "Pelanggan langsung";
	 					} ?></td>
	 				<td style="text-align: right;"><?php 
	 					$ongkir = $ongkir+$data->ONGKIR_PESAN;
	 					echo  $this->Master->rupiah($data->ONGKIR_PESAN); 
	 				?></td>
	 				<td style="text-align: right;">
	 					<?php 
                                echo $this->Master->rupiah($data->TOTAL_HARGA_PESAN);
                                $total = $total+$data->TOTAL_HARGA_PESAN;
                         ?>
	 				</td>
	 			</tr>
 			<?php } ?>
 			<tr class="border_top">
 				<td colspan="3" align="center">TOTAL HARGA</td>
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