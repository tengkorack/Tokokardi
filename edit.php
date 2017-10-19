<?php
	require_once("db.php");
	if (isset($_POST['submit'])) {		
		$sql = $conn->prepare("UPDATE barang SET nama=? , size=?, bahan=?, harga=?, keterangan=?  WHERE id=?");
		$nama=$_POST['nama'];
		$size = $_POST['size'];
		$bahan= $_POST['bahan'];
		$harga= $_POST['harga'];
		$kategori= $_POST['kategori'];
		$keterangan= $_POST['keterangan'];
		$sql->bind_param("ssssssi",$nama, $size, $bahan, $harga, $keterangan, $_GET["id"]);	
		if($sql->execute()) {
			$success_message = "Edited Successfully";
		} else {
			$error_message = "Problem in Editing Record";
		}

	}
	$sql = $conn->prepare("SELECT * FROM barang WHERE id=?");
	$sql->bind_param("i",$_GET["id"]);			
	$sql->execute();
	$result = $sql->get_result();
	if ($result->num_rows > 0) {		
		$row = $result->fetch_assoc();
	}
	$conn->close();
?>
<html>
<head>
<link href="style.css" rel="stylesheet" type="text/css" />
<style>
.tbl-qa{border-spacing:0px;border-radius:4px;border:#6ab5b9 1px solid;}
</style>
<title>Edit </title>
</head>
<body>
<?php if(!empty($success_message)) { ?>
<div class="success message"><?php echo $success_message; ?></div>
<?php } if(!empty($error_message)) { ?>
<div class="error message"><?php echo $error_message; ?></div>
<?php } ?>
<form name="frmUser" method="post" action="">
<div class="button_link"><a href="index.php" >Kembali </a></div>
<table border="0" cellpadding="10" cellspacing="0" width="500" align="center" class="tbl-qa">
	<thead>
		<tr>
			<th colspan="2" class="table-header">Edit</th>
		</tr>
	</thead>
	<tbody>
		<tr class="table-row">
			<td><label>Nama Barang</label></td>
			<td><input type="text" name="nama" class="txtField" value="<?php echo $row["nama"]?>"></td>
		</tr>
		<tr class="table-row">
			<td><label>Ukuran</label></td>
			<td><input type="text" name="size" class="txtField" value="<?php echo $row["size"]?>"></td>
		</tr>
		<tr class="table-row">
			<td><label>Bahan</label></td>
			<td><input type="text" name="bahan" class="txtField" value="<?php echo $row["bahan"]?>"></td>
		</tr>
		<tr class="table-row">
			<td><label>Harga</label></td>
			<td><input type="number" name="harga" class="txtField" minlength="1" value="<?php echo $row["harga"]?>"></td>
		</tr>
		<tr class="table-row">
			<td><label>Keterangan</label></td>
			<td><textarea name="keterangan"><?php echo $row["keterangan"]?></textarea></td>
		</tr>
		<tr class="table-row">
			<img src="gambar/<?php echo $row["gambar"]?>" alt="Mountain View" style="width: 500px;    position: absolute;    right: 50px;    top: 150px;">
			<td colspan="2"><input type="submit"  name="submit" value="Submit" class="demo-form-submit"></td>
		</tr>
	</tbody>	
</table>
</form>
</body>
</html>