<?php 
require_once("db.php");

$sql = "SELECT * FROM barang";
$result = $conn->query($sql);	
$conn->close();		
?>
<html>
<head>
	<link href="style.css" rel="stylesheet" type="text/css" />
	<title>Index</title>
</head>
<body>
	<div class="button_link"><a href="add.php">Tambah Barang</a></div>
	<center><h1><font style="Comic san ms"> Toko Kardi Online Shop </font></h1></center>
	<table class="tbl-qa">	
		<thead>
			 <tr>
				<th class="table-header" width=""> ID </th>
				<th class="table-header" width=""> Nama </th>
				<th class="table-header" width=""> Ukuran </th>
				<th class="table-header" width=""> Bahan </th>
				<th class="table-header" width=""> Harga </th>
				<th class="table-header" width=""> Keterangan </th>
				<th class="table-header" width="" colspan="2"></th>
			  </tr>
		</thead>
		<tbody>		
			<?php
				if ($result->num_rows > 0) {		
					while($row = $result->fetch_assoc()) {
			?>
			<tr class="table-row" id="row-<?php echo $row["id"]; ?>"> 
				<td class="table-row"><?php echo $row["id"]; ?></td>
				<td class="table-row"><?php echo $row["nama"]; ?></td>
				<td class="table-row"><?php echo $row["size"]; ?></td>
				<td class="table-row"><?php echo $row["bahan"]; ?></td>
				<td class="table-row"><?php echo $row["harga"]; ?></td>
				<td class="table-row"><?php echo $row["keterangan"]; ?></td>
				<!-- action -->
				<td class="table-row" colspan="2"><a href="edit.php?id=<?php echo $row["id"]; ?>" class="link"><img title="Edit" src="icon/edit.png"/></a> <a href="delete.php?id=<?php echo $row["id"]; ?>" class="link"><img name="delete" id="delete" title="Delete" onclick="return confirm('Yakin akan menghapus? ')" src="icon/delete.png"/></a> <a href="https://www.facebook.com/sharer/sharer.php?u=http://sambal.ga/barang.php?id=<?php echo $row["id"]; ?>" class="link"><img name="facebook" id="delete" title="facebook" src="icon/fb.png" style="width: 20px;height: 20px;" /></a></td>
			</tr>
			<?php
					}
				}
			?>
		</tbody>
	</table>
</body>
</html>